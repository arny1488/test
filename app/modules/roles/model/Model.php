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
 * @version    4.0
 * @link       https://dashboard.rgbvision.net
 * @since      File available since Release 1.0
 */

class RolesModel extends Model
{

    public function getRole(int $role_id): ?array
    {
        $sql = "
				SELECT
					roles.id,
					roles.name,
					COUNT(usr.id) AS users
				FROM
					user_roles AS roles
				LEFT JOIN
					users AS usr
					ON usr.role_id = roles.id
				WHERE
					roles.active = 1 AND
					roles.id != 2
				AND 
					roles.id = ?
                GROUP BY
                    roles.id
			";

        if (!$role = DB::row($sql, $role_id)) {
            return null;
        }

        $role['deletable'] = UserRoles::isDeletable($role['id'], $role['users']);
        $role['editable'] = UserRoles::isEditable($role['id']);

        return $role;
    }

    public function saveRole()
    {
        $save = true;

        $type = 'danger';
        $arg = [];

        $Template = Template::getInstance();

        $role_id = Request::post('id');
        $permissions = Request::post('permissions');
        $action = Request::post('action');

        if ($permissions and is_array($permissions))
            $permissions = Json::encode(array_values($permissions));

        if (!is_numeric($role_id)) $save = false;

        if ($role_id == 1 or $role_id == 2) $save = false;

        if (!UserRoles::isEditable($role_id)) $save = false;

        if ($save or $action == 'add') {
            if ($role_id) {
                $sql = "
						UPDATE
							user_roles
						SET
							permissions = '" . $permissions . "'
						" . (Request::post('role_name') ? ", name = '" . Request::post('role_name') . "'" : '') . "
						WHERE
							id = '" . $role_id . "'
					";

                DB::Query($sql);

                $message = $Template->_get('roles_message_edit_success');
                $type = 'success';
            } else {
                $sql = "
							INSERT INTO
								user_roles
							SET
								permissions = '" . $permissions . "'
							" . (Request::post('role_name') ? ", name = '" . Request::post('role_name') . "'" : '') . "
						";

                DB::Query($sql);

                $role_id = DB::getInsertId();

                if ($role_id) {
                    $message = $Template->_get('roles_message_edit_success');
                    $type = 'success';
                    $arg = ['id' => $role_id];
                } else {
                    $message = $Template->_get('roles_message_edit_error');
                }
            }
        } else {
            $message = $Template->_get('roles_message_edit_error');
        }

        Router::response($type === 'success', $message, ABS_PATH . 'roles', $arg);
    }

    public function deleteRole()
    {


        $role_id = Request::get('id');

        $type = 'danger';

        $delete = true;

        if (!$role_id)
            $delete = false;

        $Template = Template::getInstance();

        if ($delete) {
            $role = self::getRole((int)$role_id);

            if ($role['deletable']) {
                $sql = "
						UPDATE
							user_roles
						SET
							active = 0
						WHERE
							id = '" . $role_id . "'
					";

                DB::Query($sql);

                $message = $Template->_get('roles_message_del_success');
                $type = 'success';
            } else {
                $message = $Template->_get('roles_message_del_perm_error');
            }
        } else {
            $message = $Template->_get('roles_message_del_id_error');
        }

        Router::response($type === 'success', $message, '/route/roles');
    }

    public function getAllPermissions(?int $role_id = null): array
    {

        $permissions = [];

        $_permissions = Permissions::getList();

        $role_permissions = self::getRolePermissions($role_id);

        foreach ($_permissions as $category => $permission) {
            $permissions[$category] = [];

            $permissions[$category]['name'] = 'perm_header_' . $category;

            if (is_array($permission['permission'])) {
                foreach ($permission['permission'] as $_permission) {
                    $permissions[$category]['permission'][$_permission] = in_array($_permission, $role_permissions);
                }
            }

            if (isset($permission['icon'])) {
                $permissions[$category]['icon'] = $permission['icon'];
            }

            $permissions[$category]['priority'] = $permission['priority'];
        }

        return Arrays::multiSort($permissions, 'priority');
    }

    public function getRolePermissions(?int $role_id = null): array
    {
        $permissions = [];

        if ($role_id) {
            $_permissions = DB::cell('SELECT permissions FROM user_roles WHERE id = ?', $role_id);
            $permissions = Json::decode($_permissions);
        }

        return $permissions;
    }

    public function getRoleName(int $role_id): string|null
    {
        return DB::cell('SELECT `name` FROM user_roles WHERE id = ?', $role_id);
    }

    public function isDisabled(int $role_id): bool
    {
        return in_array($role_id, [UserRoles::SUPERADMIN, UserRoles::ANONYMOUS], true);
    }
}