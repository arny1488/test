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
 * @version    2.5
 * @link       https://dashboard.rgbvision.net
 * @since      File available since Release 1.0
 */

class Settings
{
    protected static ?array $settings = null;
    protected static ?Settings $instance = null;

    protected function __construct()
    {
        $sql = "
				SELECT
					*
				FROM
					settings
			";

        $query = DB::query($sql);

        $settings = [];

        foreach ($query as $_row) {
            $row = Arrays::toObject($_row);
            $settings[$row->type][$row->key] = $row->array
                ? unserialize($row->value, ['allowed_classes' => false])
                : $row->value;
        }

        self::$settings = $settings;
    }

    /**
     * Initialization
     *
     * @return Settings|null
     */
    public static function init(): ?Settings
    {
        if (!isset(self::$instance)) {
            self::$instance = new Settings();
        }

        return self::$instance;
    }

    /**
     * Get value by type and key
     *
     * @param string $type раздел
     * @param string $key ключ
     * @return array|mixed|null
     */
    public static function get(string $type = '', string $key = '')
    {
        if ($key === '' || $type === '') {
            return self::$settings;
        }

        return self::$settings[$type][$key] ?? null;
    }

    /**
     * Set value by type and key
     *
     * @param string $type раздел
     * @param string $key ключ
     * @param array|mixed|null $value значение
     */
    public static function set(string $type, string $key, $value): void
    {
        self::$settings[$type][$key] = $value;
    }

    /**
     * Load user settings
     *
     * @param string $user_id user ID
     */
    public static function loadUserSettings(?string $user_id): void
    {
        $sql = "
				SELECT
					settings
				FROM
					users
				WHERE
					id = ?
				LIMIT 1
			";

        if ($settings = DB::cell($sql, $user_id)) {
            self::$settings['user_settings'] = Json::decode($settings);
        }

        if (isset(self::$settings['user_settings']['user_lang']) && ($user_lang = self::$settings['user_settings']['user_lang']) && Session::checkvar("accept_langs.$user_lang")) {
            Session::setvar('current_language', $user_lang);
            SystemLocale::set($user_lang);
        }

    }

    /**
     * Save user settings
     *
     * @param string $user_id
     */
    public static function saveUserSettings(?string $user_id): void
    {
        if ($user_id && !empty(self::$settings['user_settings'])) {
            DB::update("users", ["settings" => Json::encode(self::$settings['user_settings'])], ["id" => $user_id]);
        }
    }

}