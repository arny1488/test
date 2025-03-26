<?php

namespace TM4RENT;

use DB;

class ContentTypes
{

    public static function get(?int $parent = null): array
    {
        $types = [];

        if (is_int($parent)) {
            $data = ($parent < 0)
                ? DB::query('SELECT * FROM content_types WHERE active = 1 AND parent != 0 ORDER BY parent, position')
                : DB::query('SELECT * FROM content_types WHERE active = 1 AND parent = ? ORDER BY parent, position', $parent);
        } else {
            $data = DB::query('SELECT * FROM content_types WHERE active = 1 ORDER BY parent, position');
        }

        foreach ($data as $row) {
            $type = new ContentType(
                $row['id'],
                $row['position'],
                $row['parent'],
                $row['icon'],
                $row['image'],
                $row['name'],
                $row['title'],
                $row['description'],
            );
            $types[] = $type->toArray();
        }

        return $types;

    }

    public static function getRaw(?int $parent = null): array
    {
        $types = [];

        if (is_int($parent)) {
            $data = ($parent < 0)
                ? DB::query('SELECT * FROM content_types WHERE active = 1 AND parent != 0 ORDER BY parent, position')
                : DB::query('SELECT * FROM content_types WHERE active = 1 AND parent = ? ORDER BY parent, position', $parent);
        } else {
            $data = DB::query('SELECT * FROM content_types WHERE active = 1 ORDER BY parent, position');
        }

        foreach ($data as $row) {
            $types[(int)$row['id']] = $row;
        }

        return $types;

    }

}
