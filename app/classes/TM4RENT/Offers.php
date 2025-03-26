<?php

namespace TM4RENT;

use DB;
use Json;
use Session;
use Settings;

class Offers
{

    public const SORTABLE = ['o.created', 'c.name', 'o.price'];
    public const SEARCHABLE = ['created', 'description'];

    public static function get(string $sort = 'o.created', string $order = 'DESC', int $limit = null, int $start = null, string $search = null, ?array $filters = null): array
    {
        if (!in_array($sort, static::SORTABLE)) {
            $sort = static::SORTABLE[0];
        }

        $limits = '';

        if (!is_null($limit) && !is_null($start)) {
            $limits = "LIMIT $start, $limit";
        }

        $like = '';

        $_search = trim(implode(' ', array_filter([$search ?? null, $filters['query'] ?? null])));

        if ($_search) {
            $_like = DB::buildSearch(['o.description', 'c.name', 'c.description'], $_search);
            $like = ($_like) ? " AND ($_like)" : '';
        }

        $where = ['o.deleted IS NULL'];

        if ($user_id = $filters['user_id']) {
            $where[] = "org.user_id = '$user_id'";
        }

        if ($organization_id = $filters['organization_id']) {
            $where[] = "b.organization_id = '$organization_id'";
        }

        if ($filters['categories'] && is_array($filters['categories'])) {
            $category_where = [];

            foreach ($filters['categories'] as $category_id) {
                $siblings = DB::query("SELECT id FROM content_types WHERE id = ? OR parent = ?", $category_id, $category_id);

                foreach ($siblings as $sibling) {
                    $category_where[] = "JSON_CONTAINS(c.type_ids, '{$sibling['id']}', '$')";
                }
            }

            $where[] = '( ' . implode(' OR ', $category_where) . ' )';
        }

        if ($filters['ids'] && is_array($filters['ids'])) {
            $where[] = "o.id IN ('" . implode("','", $filters['ids']) . "')";
        }

        if ($filters['exclude_ids'] ?? is_array($filters['exclude_ids'])) {
            $where[] = "o.id NOT IN ('" . implode("','", $filters['exclude_ids']) . "')";
        }

        if ((float)$filters['price_min'] && (float)$filters['price_max']) {
            $price_min = (float)$filters['price_min'];
            $price_max = (float)$filters['price_max'];
            $where[] = "o.price BETWEEN $price_min AND $price_max";
        }

        if ((float)$filters['price_min'] && !(float)$filters['price_max']) {
            $price_min = (float)$filters['price_min'];
            $where[] = "o.price >= $price_min";
        }

        if (!(float)$filters['price_min'] && (float)$filters['price_max']) {
            $price_max = (float)$filters['price_max'];
            $where[] = "o.price <= $price_max";
        }

        if ((int)$filters['term_min'] && (int)$filters['term_max']) {
            $term_min = (int)$filters['term_min'];
            $term_max = (int)$filters['term_max'];
            $where[] = "o.term_max >= $term_min AND o.term_min <= $term_max";
        }

        if ($filters['exclusive']) {
            $where[] = 'o.exclusive = 1';
        }

        if ($filters['fast_deal']) {
            $where[] = 'o.fast_deal = 1';
        }

        if ($filters['notoriety'] && is_array($filters['notoriety'])) {
            $_notoriety = array_values($filters['notoriety']);
            $or_where = [];
            foreach ($_notoriety as $id) {
                $or_where[] = "JSON_CONTAINS(b.notoriety_ids, '$id', '$')";
            }
            $where[] = '(' . implode(' OR ', $or_where) . ')';
        }

        if ($filters['country'] && is_array($filters['country'])) {
            $where[] = 'o.country_id IN (' . implode(',', $filters['country']) . ')';
        }

        if ($filters['region'] && is_array($filters['region'])) {
            $_region = array_values($filters['region']);
            $or_where = [];
            foreach ($_region as $id) {
                $or_where[] = "JSON_CONTAINS(o.region_ids, '$id', '$')";
            }
            $where[] = '((' . implode(' OR ', $or_where) . ') OR o.region_ids = \'[0]\')';
        }

        if ($filters['application'] && is_array($filters['application'])) {
            $_application = array_values($filters['application']);
            $or_where = [];
            foreach ($_application as $id) {
                $or_where[] = "JSON_CONTAINS(o.application_ids, '$id', '$')";
            }
            $where[] = '(' . implode(' OR ', $or_where) . ')';
        }

        if ($filters['placement'] && is_array($filters['placement'])) {
            $_placement = array_values($filters['placement']);
            $or_where = [];
            foreach ($_placement as $id) {
                $or_where[] = "JSON_CONTAINS(o.placement_ids, '$id', '$')";
            }
            $where[] = '(' . implode(' OR ', $or_where) . ')';
        }

        if ($filters['groups'] && is_array($filters['groups'])) {
            $_groups = array_values($filters['groups']);
            $or_where = [];
            foreach ($_groups as $id) {
                $or_where[] = "JSON_CONTAINS(o.allowed_for_ids, '$id', '$')";
            }
            $where[] = '(' . implode(' OR ', $or_where) . ')';
        }

        if ($filters['brand_id']) {
            $where[] = "b.id = '" . $filters['brand_id'] . "'";
        }

        if ($filters['exclude_brand_id']) {
            $where[] = "b.id != '" . $filters['exclude_brand_id'] . "'";
        }


        $rows = DB::query(
            "
				SELECT
					o.*
				FROM
					offers o
				LEFT JOIN content c on o.content_id = c.id
				LEFT JOIN brands b on c.brand_id = b.id
				LEFT JOIN organizations org on b.organization_id = org.id
				WHERE " . implode(' AND ', $where) . " $like
				ORDER BY $sort $order, o.created DESC
                $limits
			"
        );

        $offers = [];

        foreach ($rows as $row) {
            $offer = new Offer(
                $row['id'],
                $row['content_id'],
                $row['description'],
                $row['price'],
                $row['term_min'],
                $row['term_max'],
                $row['termless'],
                Json::decode($row['allowed_for_ids']),
                Json::decode($row['application_ids']),
                $row['country_id'],
                Json::decode($row['region_ids']),
                Json::decode($row['placement_ids']),
                $row['exclusive'],
                $row['fast_deal'],
                $row['charity'],
                $row['fund_id'],
                $row['charity_percent'],
                $row['charity_sum'],
                $row['contract_accepted'],
                $row['view_count'],
                $row['created'],
                $row['deleted'],
                $row['approved'],
                $row['archived'],
            );
            $offers[] = $offer->toArray();
        }

        return $offers;
    }

}