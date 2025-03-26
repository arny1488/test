<?php

namespace TM4RENT;

use DB, Json;

class Filters
{

    public static function getNotoriety(bool $show_hidden = false): array
    {
        $res = [];

        $where = $show_hidden ? '' : 'WHERE active = 1';

        $rows = DB::query("SELECT * FROM filters_notoriety $where ORDER BY position");

        foreach ($rows as $row) {
            $row['data'] = Json::decode($row['data']);
            $res[] = $row;
        }

        return $res;

    }

    public static function getApplication(bool $show_hidden = false): array
    {
        $res = [];

        $where = $show_hidden ? '' : 'WHERE active = 1';

        $rows = DB::query("SELECT * FROM filters_application $where ORDER BY parent_id, position");

        foreach ($rows as $row) {
            $row['data'] = Json::decode($row['data']);
            $res[] = $row;
        }

        return $res;

    }

    public static function getPlacement(bool $show_hidden = false): array
    {
        $res = [];

        $where = $show_hidden ? '' : 'WHERE active = 1';

        $rows = DB::query("SELECT * FROM filters_placement $where ORDER BY position");

        foreach ($rows as $row) {
            $row['data'] = Json::decode($row['data']);
            $res[$row['id']] = $row;
        }

        return $res;

    }

}