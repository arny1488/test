<?php

namespace TM4RENT;

use DB;
use Json;

class Contents
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
            $_like = DB::buildSearch(['c.name', 'c.description'], $search);
            $like = ($_like) ? " AND ($_like)" : '';
        }

        $where = 'c.deleted IS NULL';

        if ($user_id) {
            $where .= " AND o.user_id = '$user_id'";
        }

        $rows = DB::Query(
            "
				SELECT
					c.*
				FROM
					content c
				LEFT JOIN brands b ON c.brand_id = b.id 
				LEFT JOIN organizations o ON b.organization_id = o.id 
				WHERE $where $like				
				ORDER BY $sort $order, name
                $limits
			"
        );

        $contents = [];

        foreach ($rows as $row) {
            $content = new Content(
                $row['id'],
                $row['brand_id'],
                Json::decode($row['type_ids']),
                $row['name'],
                $row['description'],
                $row['document'],
                $row['created'],
                $row['deleted'],
                $row['approved'],
                $row['archived'],

            );
            $contents[] = $content->toArray();
        }

        return $contents;
    }

    public static function total(string $search = null): int
    {
        $like = '';

        if ($search) {
            $_like = DB::buildSearch(['name', 'inn'], $search);
            $like = ($_like) ? " AND ($_like)" : '';
        }

        $where = 'deleted IS NULL';

        return (int)DB::cell("SELECT COUNT(id) FROM content WHERE $where $like");
    }

}