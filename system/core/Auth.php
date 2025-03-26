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
 * @version    2.7
 * @link       https://dashboard.rgbvision.net
 * @since      File available since Release 1.0
 */

class Auth
{

    protected function __construct()
    {
        //
    }

    protected static function setConstants(?string $user_id, int $role): void
    {
        define('USERID', $user_id);
        define('USERROLE', $role);
    }

    protected static function setSessionVars(object $user): void
    {
        Session::setvar('user_id', $user->id);
        Session::setvar('user_firstname', $user->firstname);
        Session::setvar('user_lastname', $user->lastname);
        Session::setvar('user_password', $user->password);
        Session::setvar('user_role', (int)$user->role_id);
        Session::setvar('user_email', $user->email);
        Session::setvar('user_ip', IP::getIp());
        Session::setvar('user_avatar', User::getAvatar($user->id));
    }

    // Check if user logged in
    public static function authCheck(): void
    {
        if (!Session::checkvar('user_id')) {
            Session::destroy();

            if (Request::isAjax()) {
                Response::setStatus(401);
                Response::shutDown();
            }

            Router::response(false, '', ABS_PATH . 'login');
        }
    }

    // Restore auth
    public static function authRestore(): void
    {
        if (!self::authSessions() && !self::authCookie()) {
            // Clear Session Data
            Session::delvar('user_id', 'user_password');
            define('USERROLE', 2);
        }
    }

    // Auth by session
    public static function authSessions(): bool
    {
        if (!Session::checkvar('user_id') || !Session::checkvar('user_password') || !Session::checkvar('auth_token')) {
            return false;
        }

        $referer = false;

        if (isset($_SERVER['HTTP_REFERER'])) {
            $http_referer = parse_url($_SERVER['HTTP_REFERER']);
            $referer = (trim($http_referer['host']) === $_SERVER['SERVER_NAME']);
        }

        // Check user in DB if wrong referer or IP changed
        if ($referer === false || Session::getvar('user_ip') !== IP::getIp()) {
            $sql = "
					SELECT COUNT(id)
					FROM
						users
					WHERE
						id = ?
					AND
						password = ?
					LIMIT 1
				";

            $verified = (bool)DB::cell($sql, Session::getvar('user_id'), Session::getvar('user_password'));

            if (!$verified) {
                return false;
            }

            Session::setvar('user_ip', IP::getIp());
        }

        $sql = "
				SELECT
				    usr.id,
					usr.role_id,
					usr.password,
					usr.firstname,
					usr.lastname,
					usr.email,
					usr.blocked,
					usr.deleted,
					usrs.ip,
					role.permissions
				FROM
					users AS usr
				LEFT JOIN
					user_roles AS role
					ON role.id = usr.role_id
				LEFT JOIN
					user_sessions AS usrs
					ON usr.id = usrs.user_id
				WHERE
					usr.id = ?
				AND
					usrs.hash = ?
				LIMIT 1
			";

        if (!$user = Arrays::toObject(DB::row($sql, Session::getvar('user_id'), Session::getvar('auth_token')))) {
            return false;
        }

        if (LOGIN_USER_IP) {
            if (($user->ip !== '' && $user->ip !== IP::getIp())) {
                DB::delete("user_sessions", ["hash" => Secure::sanitize(Cookie::get('auth'))]);
            }

            Cookie::set('auth', '', 0, ABS_PATH, Core::getCookieDomain());
            return false;
        }

        DB::update("users", ["last_activity" => date(DB_DATETIME_FORMAT)], ["id" => Session::getvar('user_id')]);
        DB::update("user_sessions", ["last_activity" => date(DB_DATETIME_FORMAT), "ip" => IP::getIp()], ["user_id" => Session::getvar('user_id'), "hash" => Cookie::get('auth')]);

        self::setSessionVars($user);
        self::setConstants($user->id, (int)$user->role_id);

        Permissions::set(Json::decode($user->permissions ?? '[]'));

        return true;
    }

    // Auth by cookie
    public static function authCookie(): bool
    {
        if (empty(Cookie::get('auth'))) {
            return false;
        }

        $sql = "
				SELECT
					user_id
				FROM
					user_sessions
				WHERE
					hash = ?
				AND
					agent = ?
			";

        $user_id = DB::cell($sql, Cookie::get('auth'), Secure::sanitize($_SERVER['HTTP_USER_AGENT']));

        if (!$user_id || (Cookie::get('auth') !== (md5($_SERVER['HTTP_USER_AGENT']) . md5($user_id)))) {
            Cookie::set('auth', '', 0, Core::getCookieDomain(), ABS_PATH);
            return false;
        }

        $sql = "
				SELECT
				    usr.id,
					usr.role_id,
					usr.password,
					usr.firstname,
					usr.lastname,
					usr.email,
					usr.blocked,
					usr.deleted,
					usrs.ip,
					role.permissions
				FROM
					users AS usr
				LEFT JOIN
					user_roles AS role
					ON role.id = usr.role_id
				LEFT JOIN
					user_sessions AS usrs
					ON usr.id = usrs.user_id
				WHERE
					usr.id = ?
				AND
					usrs.hash = ?
				LIMIT 1
			";

        if (!$user = Arrays::toObject(DB::row($sql, $user_id, Secure::sanitize(Cookie::get('auth'))))) {
            return false;
        }

        if (LOGIN_USER_IP) {
            if (($user->ip !== '' && $user->ip !== IP::getIp())) {
                DB::delete("user_sessions", ["hash" => Secure::sanitize(Cookie::get('auth'))]);
            }

            Cookie::set('auth', '', 0, ABS_PATH, Core::getCookieDomain());
            return false;
        }

        DB::update("users", ["last_activity" => date(DB_DATETIME_FORMAT)], ["id" => $user_id]);
        DB::update("user_sessions", ["last_activity" => date(DB_DATETIME_FORMAT), "ip" => IP::getIp()], ["user_id" => $user_id, "hash" => Cookie::get('auth')]);

        self::setSessionVars($user);
        self::setConstants($user->id,  (int)$user->role_id);

        Permissions::set(Json::decode($user->permissions ?? '[]'));

        return true;
    }


    // Check permissions
    public static function authCheckPermission(): bool
    {
        if (!defined('USERID') || !Permissions::checkAccess('admin_panel')) {
            self::userLogout();
            return false;
        }

        return true;
    }


    // Logout
    public static function userLogout(): void
    {
        Cookie::set('auth', '', time() - 42000, Core::getCookieDomain(), ABS_PATH);
        Cookie::set(session_name(), '', time() - 42000, Core::getCookieDomain(), ABS_PATH);

        Session::destroy();

        if (defined('USERID')) {
            DB::delete('user_sessions', ['hash' => md5($_SERVER['HTTP_USER_AGENT']) . md5(USERID)]);
            Log::log(Log::INFO, 'Auth', "Пользователь завершил сеанс в личном кабинете");
        }
    }

    const LOGIN_SUCCESS = 0;
    const EMPTY_LOGIN = 1;
    const WRONG_LOGIN = 2;
    const WRONG_PASS = 3;
    const WRONG_PASS_MAX_ATTEMPTS = 4;
    const USER_INACTIVE = 5;
    const BLACKLISTED = 6;

    // Login
    public static function userLogin(string $email, string $password, bool $attach_ip = false, bool $keep_in = false, int $sleep = 0): int
    {
        $email = Valid::normalizeEmail($email);
        $password = Secure::sanitize($password);

        sleep($sleep);

        if (Session::checkvar('user_id')) {
            session_unset();
            $_SESSION = [];
        }

        if (DB::exists("SELECT COUNT(*) FROM block_list WHERE email = ? AND ip = ? AND block_end > ?", $email, IP::getIp(), date(DB_DATETIME_FORMAT))) {
            return self::BLACKLISTED;
        }

        if (empty($email)) {
            return self::EMPTY_LOGIN;
        }

        $sql = "
				SELECT
					usr.*,
					role.permissions			       
				FROM
					users AS usr
				INNER JOIN
					user_roles AS role
					ON role.id = usr.role_id
				WHERE
					usr.email = ?
				LIMIT 1
			";

        $user = Arrays::toObject(DB::row($sql, $email));

        if (!$user || !(isset($user->password) && self::verifyPassword($password, $user->salt, $user->password))) {
            DB::query("UPDATE users SET failed_login_count = ? WHERE id = ?", $user->failed_login_count + 1, $user->id);
            if (($user->failed_login_count + 1) >= MAX_LOGIN_ATTEMPTS) {
                DB::insert("block_list", [
                    "email" => $email,
                    "ip" => IP::getIp(),
                    "block_start" => date(DB_DATETIME_FORMAT),
                    "block_end" => date(DB_DATETIME_FORMAT, strtotime('+24 hours')),
                ]);
                return self::WRONG_PASS_MAX_ATTEMPTS;
            }
            return self::WRONG_PASS;
        }

        if ($user->blocked || $user->deleted) {
            return self::USER_INACTIVE;
        }

        $salt = Secure::randomString();

        $password_hash = self::getPasswordHash($password, $salt);

        $time = time();

        $user_ip = $attach_ip ? IP::getIp() : '';

        DB::update("users", [
            "last_activity" => date(DB_DATETIME_FORMAT, $time),
            "password" => $password_hash,
            "salt" => $salt,
            "ip" => $user_ip,
            "failed_login_count" => 0,
        ], ["id" => $user->id]);

        self::setSessionVars($user);
        self::setConstants($user->id, (int)$user->role_id);

        Permissions::set(Json::decode($user->permissions ?? '[]'));

        $expire = $keep_in ? ($time + COOKIE_LIFETIME) : 0;

        $auth = md5($_SERVER['HTTP_USER_AGENT']) . md5($user->id);

        DB::delete('user_sessions', ['hash' => Secure::sanitize($auth)]);

        DB::insert("user_sessions", [
            "user_id" => $user->id,
            "hash" => $auth,
            "ip" => $user_ip,
            "agent" => Secure::sanitize($_SERVER['HTTP_USER_AGENT']),
            "last_activity" => date(DB_DATETIME_FORMAT, $time),
        ]);

        Cookie::set('auth', $auth, $expire, Core::getCookieDomain(), ABS_PATH);
        Session::setvar('auth_token', $auth);

        Log::log(Log::INFO, 'Auth', "Пользователь начал сеанс в личном кабинете");

        unset($user, $permissions, $sql);

        return self::LOGIN_SUCCESS;
    }

    public static function getPasswordHash(string $password, string $salt): string
    {
        return password_hash(hash_hmac("sha256", $password, $salt . PWD_PEPPER), PASSWORD_ARGON2ID) ?: '';
    }

    public static function verifyPassword(string $password, string $salt, string $hash): bool
    {
        return password_verify(hash_hmac("sha256", $password, $salt . PWD_PEPPER), $hash);
    }

}