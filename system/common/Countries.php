<?php

class Countries
{

    public static function getList(bool $active_only = true, bool $default_first = true, bool $codes = false): array
    {

        $data = DB::query("
            SELECT * FROM `countries` 
            WHERE `active` IN (" . ($active_only ? '1' : '0,1') . ") AND `alpha2` IS NOT NULL " . ($codes ? 'AND `phone_code` IS NOT NULL' : '') . "
            ORDER BY " . ($default_first ? "`default` DESC," : '') . " `alpha2`"
        );

        $countries = [];

        foreach ($data as $row) {
            $row['data'] = Json::decode($row['data']) ?? [];
            $countries[$row['id']] = $row;
        }

        return $countries;

    }

    public static function get(int $id): array
    {

        $row = DB::row("
            SELECT * FROM `countries` 
            WHERE id = $id AND `alpha2` IS NOT NULL
            LIMIT 1
        ");

        $row['data'] = Json::decode($row['data']) ?? [];

        return $row;

    }

    public static function getByCode(string $code): array
    {

        $row = DB::row("
            SELECT * FROM `countries` 
            WHERE alpha2 = ?
            LIMIT 1
        ", $code);

        $row['data'] = Json::decode($row['data']) ?? [];

        return $row;

    }

    public static function getRegionList(): array
    {

        $data = DB::query("
            SELECT * FROM `regions`
            ORDER BY name_with_type
        ");

        $regions = [];

        foreach ($data as $row) {
            $row['data']['ru'] = $row['name_with_type'];
            $regions[$row['country_id']][] = $row;
        }

        return $regions;

    }

}