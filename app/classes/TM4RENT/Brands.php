<?php

namespace TM4RENT;

use DB;
use Json;

class Brands
{

    public const SORTABLE = ['name', 'description'];
    public const SEARCHABLE = ['name', 'description'];

    public static function get(string $sort = 'name', string $order = 'ASC', int $limit = null, int $start = null, string $search = null, string $user_id = null): array
    {
        if (!in_array($sort, static::SORTABLE)) {
            $sort = static::SORTABLE[0];
        }

        $limits = '';

        if (!is_null($limit) && !is_null($start)) {
            $limits = "LIMIT $start, $limit";
        }

        $like = '';

        if ($search) {
            $_like = DB::buildSearch(['b.name', 'b.description'], $search);
            $like = ($_like) ? " AND ($_like)" : '';
        }

        $where = 'b.deleted IS NULL';

        if ($user_id) {
            $where .= " AND o.user_id = '$user_id'";
        }

        $rows = DB::Query(
            "
				SELECT
					b.*
				FROM
					brands b
				LEFT JOIN organizations o ON b.organization_id = o.id 
				WHERE $where $like				
				ORDER BY $sort $order, b.name
                $limits
			"
        );

        $brands = [];

        foreach ($rows as $row) {
            $brand = new Brand(
                $row['id'],
                $row['organization_id'],
                $row['country_id'],
                $row['name'],
                $row['document'],
                $row['description'],
                Json::decode($row['notoriety_ids']),
                $row['licensor'],
                $row['licensee'],
                $row['fund'],
                $row['top'],
                $row['created'],
                $row['deleted'],
                $row['approved'],
                $row['archived'],
            );
            $brands[] = $brand->toArray();
        }

        return $brands;
    }

    public static function total(string $search = null): int
    {
        $like = '';

        if ($search) {
            $_like = DB::buildSearch(['name', 'inn'], $search);
            $like = ($_like) ? " AND ($_like)" : '';
        }

        $where = 'deleted IS NULL';

        return (int)DB::cell("SELECT COUNT(id) FROM brands WHERE $where $like");
    }

}