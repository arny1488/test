<?php

namespace TM4RENT;

use DB;

class Users
{

    public const SORTABLE = ['id', 'lastname', 'phone', 'email'];
    public const SEARCHABLE = ['u.firstname', 'u.lastname', 'u.phone', 'u.email'];

    static array $role_ids = [];
    static string $item_class = 'TM4RENT\User';

    public static function get(string $sort = 'id', ?string $order = 'ASC', ?int $limit = null, ?int $start = null, ?string $search = null, ?array $role_ids = null, ?array $exclude_ids = null): array
    {
        if (!in_array($sort, static::SORTABLE)) {
            $sort = static::SORTABLE[0];
        }

        $order = in_array(strtoupper($order), ['ASC', 'DESC']) ? $order : 'ASC';

        $limits = '';

        if (!is_null($limit) && !is_null($start)) {
            $limits = "LIMIT $start, $limit";
        }

        $like = '';

        if ($search) {
            $_like = DB::buildSearch(static::SEARCHABLE, $search);
            $like = $_like ? "AND ($_like)" : '';
        }

        $statement = DB::statement()->with("u.`deleted` IS NULL");

        if (!empty($role_ids)) {
            $statement->andIn("u.`role_id` IN (?*)", $role_ids);
        } elseif (!empty(static::$role_ids)) {
            $statement->andIn("u.`role_id` IN (?*)", static::$role_ids);
        }

        if (!empty($exclude_ids)) {
            $statement->andIn("u.`id` NOT IN (?*)", $exclude_ids);
        }

        $rows = DB::query(
            "
            SELECT u.*, role.name AS role_name
            FROM `users` u
            LEFT JOIN user_roles AS role ON u.role_id = role.id
            WHERE $statement $like
            ORDER BY u.$sort $order, `id` DESC
            $limits
        ",
            ...$statement->values()
        );

        $res = [];

        foreach ($rows as $row) {
            $item = new static::$item_class(
                $row['id'],
                $row['organization_id'],
                $row['role_id'],
                $row['email'],
                $row['email_verified'],
                $row['country_code'],
                $row['phone'],
                $row['phone_verified'],
                $row['password'],
                $row['salt'],
                $row['hash'],
                $row['hash_expire'],
                $row['verification_code'],
                $row['verification_code_expire'],
                $row['lastname'],
                $row['firstname'],
                $row['patronymic'],
                $row['ip'],
                $row['last_activity'],
                $row['updated'],
                $row['reg_ip'],
                $row['registered'],
                $row['blocked'],
                $row['deleted'],
                $row['failed_login_count'],
                $row['settings'],
                $row['data']
            );
            $res[] = [
                ...$item->toArray(),
                'fullname' => $item->getFullName(),
                'role_name' => $row['role_name'],
            ];
        }

        return $res;
    }

    public static function total(?string $search = null): int
    {
        $like = '';

        if ($search) {
            $_like = DB::buildSearch(static::SEARCHABLE, $search);
            $like = $_like ? " AND ($_like)" : '';
        }

        $statement = DB::statement()->with("u.`deleted` IS NULL")->andIn("u.`role_id` IN (?*) $like", static::$role_ids);

        return (int)DB::cell(
            "
            SELECT COUNT(`id`) FROM `users` u
            WHERE $statement
        ",
            ...$statement->values()
        );
    }

}