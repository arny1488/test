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
 * @since      File available since Release 2.0
 */

class Json
{

    /**
     * Convert array to JSON
     *
     * @param array|string|null $value
     * @param int $flags
     * @return string
     */
    public static function encode(array|string|null $value, int $flags = 0): string
    {
        $json = json_encode($value, $flags);

        if ($json === false) {
            $json = json_encode(['jsonError', json_last_error_msg()]);
        }

        if ($json === false) {
            $json = '{"jsonError": "unknown"}';
        }

        return $json;
    }

    /**
     * Convert JSON to array or object
     *
     * @param string|null $string $string JSON string
     * @param bool $object to object flag
     * @return mixed
     */
    public static function decode(?string $string, bool $object = false): mixed
    {
        return json_decode($string ?? 'null', !$object);
    }

    /**
     * Output JSON
     *
     * @param array|string|null $output $array data to output
     * @param bool $shutdown shutdown after output
     * @param int|null $status
     */
    public static function output(array|string|null $output, bool $shutdown = false, ?int $status = null): void
    {
        $json = ($output !== null) ? self::encode($output) : ''; // JSON_UNESCAPED_UNICODE

        $headers = [
            'Content-Disposition: inline; filename="response.json"',
            'Vary: Accept',
            'Content-type: application/json; charset=utf-8',
        ];

        if (OUTPUT_EXPIRE && !defined('NO_CACHE')) {
            $headers[] = 'Cache-Control: private';
            $headers[] = 'Expires: ' . gmdate('r', time() + OUTPUT_EXPIRE_OFFSET);
        } else {
            // Disable browser caching
            $headers[] = 'Cache-Control: private, no-store, no-cache, must-revalidate';
            $headers[] = 'Expires: ' . gmdate('r');
        }

        $Gzip = str_contains($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip');

																

        // Use GZIP compression if accepted
        if ($Gzip && GZIP_COMPRESSION) {
            ob_start('ob_gzhandler');
            $json = gzencode($json, 9);
            $headers[] = 'Content-Encoding: gzip';
        } else {
            ob_start();
        }

									   

        echo $json;

        $headers[] = 'Content-Length: ' . ob_get_length();

        $out = ob_get_clean();

        Response::setHeaders($headers);

        echo $out;

        if ($shutdown) {
            Response::shutDown($status);
        }
    }
}