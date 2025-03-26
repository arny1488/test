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
 * @version    3.0
 * @link       https://dashboard.rgbvision.net
 * @since      File available since Release 2.0
 */

class Log
{

    const INFO = 0;
    const WARNING = 1;
    const ERROR = 2;

    public const SEARCHABLE = ['l.timestamp', 'l.type', 'l.module', 'u.firstname', 'u.lastname', 'l.ip', 'l.message'];
    public const SORTABLE = ['timestamp', 'type', 'module', 'user', 'ip', 'message'];

    private static array $log_types = [
        'info' => self::INFO,
        'warning' => self::WARNING,
        'error' => self::ERROR,
    ];

    public function __construct()
    {
    }

    public static function log(int $type, string $module, string $message): bool
    {
        if (in_array($type, self::$log_types)) {
            $_type = array_search($type, self::$log_types, true);

            File::putContents(
                DASHBOARD_DIR . TEMP_DIR . '/logs/' . gmdate('Y-m-d') . '.log',
                "[" . gmdate(DB_DATETIME_FORMAT) . " GMT] [$_type] [$module] [USERID: " . (defined('USERID') ? USERID : 'NONE') . "] [" . IP::getIp() . "] $message" . PHP_EOL,
                true,
                true
            );

            $id = (int)DB::query(
                "INSERT INTO logs (`type`, `module`, `user_id`, `ip`, `timestamp`, `message`) VALUES (?, ?, ?, ?, NOW(), ?)",
                $_type,
                $module,
                defined('USERID') ? USERID : null,
                IP::getIp(),
                $message
            );

            DB::clearCache('logs');

            return ($id > 0);
        }

        return false;
    }

    public static function get(string $sort = 'timestamp', string $order = 'DESC', int $limit = null, int $start = null, string $search = null): array
    {
        if (!defined('USERID') || !defined('USERROLE')) {
            return [];
        }

        if (!in_array($sort, self::SORTABLE)) {
            $sort = self::SORTABLE[1];
        }

        $limits = '';

        if (!is_null($limit) && !is_null($start)) {
            $limits = "LIMIT $start, $limit";
        }

        $where = '';

        if (USERROLE === UserRoles::SUPERADMIN) {
            $where = 'l.id IS NOT NULL';
        } else {
            return [];
        }

        $like = '';

        if ($search) {
            $_like = DB::buildSearch(self::SEARCHABLE, $search);
            $like = ($_like) ? "AND ($_like)" : '';
        }

        $rows = DB::query(
            "
            SELECT l.*, CONCAT_WS(' ', u.firstname, u.lastname) AS user
            FROM logs l
            LEFT JOIN users u on l.user_id = u.id
            WHERE $where $like
            ORDER BY $sort $order, `timestamp` DESC
            $limits
        "
        );

        $res = [];

        foreach ($rows as $row) {
            $res[] = $row;
        }

        return $res;
    }

    public static function total(string $search = null): int
    {
        if (!defined('USERID') || !defined('USERROLE')) {
            return 0;
        }

        $where = '';

        if (USERROLE === UserRoles::SUPERADMIN) {
            $where = 'l.id IS NOT NULL';
        } else {
            return 0;
        }

        $like = '';

        if ($search) {
            $_like = DB::buildSearch(self::SEARCHABLE, $search);
            $like = ($_like) ? " AND ($_like)" : '';
        }

        return (int)DB::cell(
            "
            SELECT COUNT(l.id) FROM logs l
            LEFT JOIN users u on l.user_id = u.id
            WHERE $where $like
        "
        );
    }

}