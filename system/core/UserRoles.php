<?php

/**
 * This file is part of the dashboard.rgbvision.net package.
 *
 * (c) Alex Graham <contact@rgbvision.net>
 *
 * @package    dashboard.rgbvision.net
 * @author     Alex Graham <contact@rgbvision.net>
 * @copyright  Copyright 2017-2022, Alex Graham
 * @license    https://dashboard.rgbvision.net/license.txt MIT License
 * @version    2.19
 * @link       https://dashboard.rgbvision.net
 * @since      File available since Release 1.0
 */

class UserRoles
{

    const SUPERADMIN = 1;
    const ANONYMOUS = 2;

    protected static array $sortable_fields = ['id', 'name', 'users'];

    public static function isDeletable($user_role_id, $count): bool
    {
        return !(
            ($user_role_id === self::SUPERADMIN) ||
            ($user_role_id === self::ANONYMOUS) ||
            ($count > 0) ||
            !Permissions::has('roles_delete')
        );
    }

    public static function isEditable($user_role_id): bool
    {
        return (
            ((USERROLE !== self::SUPERADMIN) && ($user_role_id === self::SUPERADMIN)) ||
            ((USERROLE !== self::SUPERADMIN) && ($user_role_id === self::ANONYMOUS)) ||
            Permissions::has('roles_edit')
        );
    }

    public static function getList(string $sort = 'id', string $order = 'ASC', int $limit = null, int $start = null, string $search = null): array
    {

        if (!in_array($sort, self::$sortable_fields)) {
            $sort = self::$sortable_fields[0];
        }

        $limits = (!is_null($limit) && !is_null($start)) ? "LIMIT $start, $limit" : '';

        $like = '';

        if ($search) {
            $_like = DB::buildSearch(['role.name'], $search);
            $like = ($_like) ? " AND ($_like)" : '';
        }

        $where = (USERROLE === self::SUPERADMIN)
            ? 'role.id != ' . self::ANONYMOUS
            : 'role.id NOT IN (' . self::ANONYMOUS . ',' . self::SUPERADMIN . ')';

        $res = [];

        $rows = DB::Query("
            SELECT 
                role.*,
				COUNT(usr.id) AS users
            FROM
                user_roles role
            LEFT JOIN
                users AS usr
                ON usr.role_id = role.id AND usr.deleted = 0            
            WHERE $where $like
            GROUP BY role.id
            ORDER BY $sort $order, role.id
            $limits
        ");

        foreach ($rows as $row) {
            $row['deletable'] = self::isDeletable($row['role_id'], $row['users']);
            $row['editable'] = self::isEditable($row['role_id']);
            $res[] = $row;
        }

        return $res;
    }

}