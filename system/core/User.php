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

class User
{

    const SUPERUSER = '00000000-0000-0000-0000-000000000000';

    protected static array $sortable_fields = ['lastname', 'phone', 'email', 'role_name', 'last_activity'];

    public static function isDeletable($user_id, $user_role_id): bool
    {
        return (
            // Prevent delete SUPERUSER
            ($user_id !== self::SUPERUSER) &&
            // Prevent self delete
            ($user_id !== USERID) &&
            // Prevent delete SUPERADMIN if current user NOT SUPERADMIN
            ((USERROLE !== UserRoles::SUPERADMIN) && ($user_role_id !== UserRoles::SUPERADMIN)) &&
            Permissions::has('users_delete')
        );
    }

    public static function isEditable($user_id, $user_role_id): bool
    {
        return (
            // Only SUPERUSER can edit own user data
            (($user_id === self::SUPERUSER) && (USERID === self::SUPERUSER)) ||
            // Prevent edit SUPERADMIN if current user NOT SUPERADMIN
            ((USERROLE !== UserRoles::SUPERADMIN) && ($user_role_id == UserRoles::SUPERADMIN)) ||
            Permissions::has('users_edit')
        );
    }

    public static function get(string $id): ?array
    {
        if ($row = DB::row("
				SELECT
					usr.id, usr.country_code, usr.phone, usr.email, usr.firstname, usr.lastname, usr.last_activity, usr.blocked, usr.deleted, usr.settings,
				    role.id AS role_id,
					role.name AS role_name
				FROM
					users AS usr
				LEFT JOIN
					user_roles AS role
					ON usr.role_id = role.id
				WHERE usr.id = ?
				LIMIT 1
			", $id))
        {
            $row['phone'] = Valid::internationalPhone($row['phone'], $row['country_code']);

            $row['last_activity'] = date('c', strtotime($row['last_activity']));

            $row['deletable'] = self::isDeletable($row['id'], $row['role_id']);
            $row['editable'] = self::isEditable($row['id'], $row['role_id']);
            $row['photo'] = self::getAvatar($row['id']);

            return $row;
        }

        return null;
    }

    public static function getList(string $sort = 'lastname', string $order = 'ASC', int $limit = null, int $start = null, string $search = null): array
    {
        if (!in_array($sort, self::$sortable_fields)) {
            $sort = self::$sortable_fields[0];
        }

        $limits = '';

        if (!is_null($limit) && !is_null($start)) {
            $limits = "LIMIT $start, $limit";
        }

        $like = '';

        if ($search) {
            $_like = DB::buildSearch(['usr.firstname', 'usr.lastname', 'usr.phone', 'usr.email', 'role.name'], $search);
            $like = ($_like) ? " AND ($_like)" : '';
        }

        $where = 'usr.id IS NOT NULL';

        if (USERROLE !== UserRoles::SUPERADMIN) {
            $where = 'role.id != ' . UserRoles::SUPERADMIN;
        }

        $rows = DB::query(
            "
				SELECT
					usr.id, usr.country_code, usr.phone, usr.email, usr.firstname, usr.lastname, usr.last_activity, usr.blocked, usr.deleted, usr.settings,
				    role.id AS role_id,
					role.name AS role_name
				FROM
					users AS usr
				LEFT JOIN
					user_roles AS role
					ON usr.role_id = role.id
				WHERE $where $like				
				ORDER BY $sort $order, usr.lastname
                $limits
			"
        );

        $users = [];

        foreach ($rows as $row) {
            $row['phone'] = Valid::internationalPhone($row['phone'], $row['country_code']);

            $row['last_activity'] = date('c', strtotime($row['last_activity']));

            $row['deletable'] = self::isDeletable($row['id'], $row['role_id']);
            $row['editable'] = self::isEditable($row['id'], $row['role_id']);
            $row['avatar'] = self::getAvatar($row['id']);

            $users[] = $row;
        }

        return $users;
    }


    public static function total(string $search = null): int
    {
        $like = '';

        if ($search) {
            $_like = DB::buildSearch(['usr.firstname', 'usr.lastname', 'usr.phone', 'usr.email', 'role.name'], $search);
            $like = ($_like) ? " AND ($_like)" : '';
        }

        $where = 'usr.id IS NOT NULL';

        if (USERROLE !== UserRoles::SUPERADMIN) {
            $where = 'role.id != ' . UserRoles::SUPERADMIN;
        }

        return (int)DB::cell(
            "
            SELECT COUNT(usr.id) 
            FROM users AS usr
			LEFT JOIN user_roles AS role ON usr.role_id = role.id
			WHERE $where $like
        "
        );
    }

    public static function getAvatar(?string $id): string
    {
        if ($file = File::find(DASHBOARD_DIR . UPLOAD_DIR . '/avatars/' . File::hashPath(md5($id) . '_*.jpg'))[0] ?? null) {
            $user_avatar = HOST . ABS_PATH . trim(UPLOAD_DIR, '/') . '/avatars/' . File::hashPath(md5($id), true) . '/' . File::basename($file);
        } else {
            $user_avatar = HOST . ABS_PATH . trim(UPLOAD_DIR, '/') . '/avatars/default.jpg';
        }

        return $user_avatar;
    }

    public static function saveAvatar(string $id, string $photo): bool
    {
        if ($img_decoded = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $photo))) {
            $_tmp_file = DASHBOARD_DIR . TEMP_DIR . UPLOAD_DIR . '/' . md5($id) . '.jpg';
            $_new_file = DASHBOARD_DIR . UPLOAD_DIR . '/avatars/' . File::hashPath(md5($id) . '_' . sprintf('%08x', time()) . '.jpg');

            File::putContents($_tmp_file, $img_decoded);

            if (File::mime($_tmp_file) === 'image/jpeg') {
                // Delete all old avatars
                foreach (File::find(DASHBOARD_DIR . '/uploads/avatars/' . File::hashPath(md5($id) . '_*.jpg')) as $file) {
                    File::delete($file);
                }

                File::rename($_tmp_file, $_new_file);

                if ($id === USERID) {
                    Session::setvar('user_avatar', self::getAvatar($id));
                }

                return true;
            }

            File::delete($_tmp_file);
        }

        return false;
    }

    public static function save(?string $id, string $firstname, string $lastname, string $country_code, string $phone, string $email, ?string $pass = null, int $role = 2, ?string $photo = null, bool $send_email = false): ?int
    {
        if ($id) { // Save

            // Check if email or phone already used by another user
            if (self::isEmailUsed($email, $id) || self::isPhoneUsed($phone, $country_code, $id)) {
                return false;
            }

            DB::update(
                "users",
                [
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "country_code" => $country_code,
                    "phone" => $phone,
                    "email" => $email,
                    "role_id" => $role,
                    "updated" => date(DB_DATETIME_FORMAT),
                ],
                [
                    "id" => $id,
                ]
            );

            if ($pass) { // Update pass

                $salt = Secure::randomString();
                $password_hash = password_hash(hash_hmac("sha256", $pass, $salt . PWD_PEPPER), PASSWORD_ARGON2ID);

                DB::update(
                    "users",
                    [
                        "password" => $password_hash,
                        "salt" => $salt,
                    ],
                    [
                        "id" => $id,
                    ]
                );
            }
        } else { // Add

            // Check if email or phone already used by another user
            if (self::isEmailUsed($email) || self::isPhoneUsed($phone, $country_code)) {
                return false;
            }

            // Password required for new users
            if (!$pass) {
                return false;
            }

            $salt = Secure::randomString();
            $password_hash = password_hash(hash_hmac("sha256", $pass, $salt . PWD_PEPPER), PASSWORD_ARGON2ID);

            $id = DB::insertGet(
                "users",
                [
                    "role_id" => $role,
                    "email" => $email,
                    "country_code" => $country_code,
                    "phone" => $phone,
                    "password" => $password_hash,
                    "salt" => $salt,
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "active" => 1,
                    "registered" => date(DB_DATETIME_FORMAT),
                    "reg_ip" => IP::getIp(),
                    "settings" => "{}",
                ],
                "id"
            );
        }

        if ($photo && $id) {
            self::saveAvatar($id, $photo);
        }

        return $id;
    }

    public static function delete(string $id): bool
    {
        return DB::update(
                "users",
                [
                    "blocked" => date(DB_DATETIME_FORMAT),
                    "deleted" => date(DB_DATETIME_FORMAT),
                ],
                [
                    "id" => $id,
                ]
            ) > 0;
    }

    public static function restore(string $id): bool
    {
        return DB::update(
                "users",
                [
                    "blocked" => null,
                    "deleted" => null,
                ],
                [
                    "id" => $id,
                ]
            ) > 0;
    }

    public static function block(string $id): bool
    {
        return DB::update(
                "users",
                [
                    "blocked" => date(DB_DATETIME_FORMAT),
                ],
                [
                    "id" => $id,
                ]
            ) > 0;
    }

    public static function unblock(string $id): bool
    {
        return DB::update(
                "users",
                [
                    "blocked" => null,
                ],
                [
                    "id" => $id,
                ]
            ) > 0;
    }

    public static function isPhoneUsed(string $phone, string $country_code, ?string $exclude_user_id = null): bool
    {
        $statement = DB::statement()->with("country_code = ?", $country_code)->andWith("phone = ?", $phone)->andWith("deleted IS NULL");
        if ($exclude_user_id) {
            $statement->andWith("id != ?", $exclude_user_id);
        }
        return DB::exists("SELECT id FROM users WHERE $statement", ...$statement->values());
    }

    public static function isEmailUsed(string $email, ?string $exclude_user_id = null): bool
    {
        $statement = DB::statement()->with("email = ?", $email)->andWith("deleted = ?", 0);
        if ($exclude_user_id) {
            $statement->andWith("id != ?", $exclude_user_id);
        }
        return DB::exists("SELECT id FROM users WHERE $statement", ...$statement->values());
    }

}