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
 * @version    1.1
 * @link       https://dashboard.rgbvision.net
 * @since      File available since Release 1.0
 */

class SystemLocale
{

    /**
     * Set locale params
     */
    public static function set(string $locale): void
    {
		switch ($locale) {
			case 'ru':
				@setlocale(LC_ALL, 'ru_RU.UTF-8', 'rus_RUS.UTF-8', 'russian');
				@setlocale(LC_NUMERIC, 'C');
				break;

			default:
				@setlocale(LC_ALL, 'en_US.UTF-8', 'en_US.UTF-8', 'english');
                @setlocale(LC_NUMERIC, 'C');
				break;
		}
	}

    public static function formatDateTime(string $date, int $dateFormat = 0, int $timeFormat = 0): string
    {

        try {
            $_date = new DateTime($date);
        } catch (Exception $exception) {
            return '';
        }

        $formatter = datefmt_create(
            Session::getvar('current_language'),
            $dateFormat,
            $timeFormat,
            TIMEZONE,
            IntlDateFormatter::GREGORIAN
        );

        return datefmt_format($formatter, $_date);
    }
}