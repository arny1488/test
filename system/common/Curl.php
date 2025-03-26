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
 * @since      File available since Release 2.2
 */

class Curl
{

    private static array $allowedRequestMethods = ["GET", "PUT", "PATCH", "POST", "DELETE"];

    /**
     * @param string $requestMethod
     * @param string $url
     * @param array|null $headers
     * @param array|null $queryParams
     * @param string|null $body
     * @param array|null $auth
     * @param int $cacheTTL
     * @param bool $cachedResultOnFailure
     * @param int $requestTimeout
     * @return string|null
     */
    public static function request(string $requestMethod, string $url, ?array $headers = null, ?array $queryParams = null, ?string $body = null, ?array $auth = null, int $cacheTTL = 0, bool $cachedResultOnFailure = false, int $requestTimeout = 60): ?string
    {
        if (in_array(strtoupper($requestMethod), self::$allowedRequestMethods)) {
            $cache_file = md5($url) . md5(print_r([$headers, $auth], true)) . md5(print_r($queryParams, true)) . md5(print_r($body, true));
            $cache_dir = DASHBOARD_DIR . TEMP_DIR . '/cache/curl/' . strtolower($requestMethod) . '/' . File::hashPath($cache_file, true) . '/';

            if (
                ($cacheTTL > 0) &&
                file_exists($cache_dir . $cache_file) &&
                (time() - @filemtime($cache_dir . $cache_file) < $cacheTTL)
            ) {
                return file_get_contents($cache_dir . $cache_file);
            }

            $request = curl_init();

            curl_setopt_array($request, [
                CURLOPT_URL => $url . ($queryParams ? '?' . http_build_query($queryParams) : ''),
                CURLOPT_CUSTOMREQUEST => strtoupper($requestMethod),
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_TIMEOUT => $requestTimeout,
                CURLINFO_HEADER_OUT => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_SSL_VERIFYPEER => false,
            ]);

            if (in_array(strtoupper($requestMethod), ["PUT", "PATCH", "POST", "DELETE"]) && $body) {
                curl_setopt(
                    $request,
                    CURLOPT_POSTFIELDS,
                    $body
                );
            }

            if ($auth['user'] && $auth['password']) {
                curl_setopt($request, CURLOPT_USERPWD, $auth['user'] . ":" . $auth['password']);
                curl_setopt($request, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            }

            $response = curl_exec($request);
            curl_close($request);

            if (($response === false) && ($cacheTTL > 0) && $cachedResultOnFailure && file_exists($cache_dir . $cache_file)) {
                return file_get_contents($cache_dir . $cache_file);
            }

            if (($response !== false) && ($cacheTTL > 0)) {
                Dir::create($cache_dir);
                file_put_contents($cache_dir . $cache_file, $response);
            }

            return $response ?: '';
        }

        return null;
    }

    /**
     * Perform GET request
     *
     * @param string $url request URL
     * @param array|null $headers request headers
     * @param array|null $queryParams
     * @param array|null $auth
     * @param int $cacheTTL
     * @param bool $cachedResultOnFailure
     * @param int $requestTimeout
     * @return string|null
     */
    public static function get(string $url, ?array $headers = null, ?array $queryParams = null, ?array $auth = null, int $cacheTTL = 0, bool $cachedResultOnFailure = false, int $requestTimeout = 60): ?string
    {
        return self::request("GET", $url, $headers, $queryParams, null, $auth, $cacheTTL, $cachedResultOnFailure, $requestTimeout);
    }

    /**
     * Perform POST request
     *
     * @param string $url request URL
     * @param array|null $headers request headers
     * @param array|null $queryParams
     * @param string|null $body
     * @param array|null $auth
     * @param int $cacheTTL
     * @param bool $cachedResultOnFailure
     * @param int $requestTimeout
     * @return string|null
     */
    public static function post(string $url, ?array $headers = null, ?array $queryParams = null, ?string $body = null, ?array $auth = null, int $cacheTTL = 0, bool $cachedResultOnFailure = false, int $requestTimeout = 60): ?string
    {
        return self::request("POST", $url, $headers, $queryParams, $body, $auth, $cacheTTL, $cachedResultOnFailure, $requestTimeout);
    }

    /**
     * Perform POST request
     *
     * @param string $url request URL
     * @param array|null $headers request headers
     * @param array|null $queryParams
     * @param array|null $bodyParams
     * @param array|null $auth
     * @param int $cacheTTL
     * @param bool $cachedResultOnFailure
     * @param int $requestTimeout
     * @return string|null
     */
    public static function postForm(string $url, ?array $headers = null, ?array $queryParams = null, ?array $bodyParams = null, ?array $auth = null, int $cacheTTL = 0, bool $cachedResultOnFailure = false, int $requestTimeout = 60): ?string
    {
        return self::request("POST", $url, [...($headers ?: []), 'Content-Type: application/x-www-form-urlencoded'], $queryParams, $bodyParams ? http_build_query($bodyParams) : null, $auth, $cacheTTL, $cachedResultOnFailure, $requestTimeout);
    }

    /**
     * Perform GET request
     *
     * @param string $url request URL
     * @param array|null $headers request headers
     * @param array|null $queryParams
     * @param array|null $auth
     * @param int $cacheTTL
     * @param bool $cachedResultOnFailure
     * @param int $requestTimeout
     * @return mixed
     */
    public static function getJson(string $url, ?array $headers = null, ?array $queryParams = null, ?array $auth = null, int $cacheTTL = 0, bool $cachedResultOnFailure = false, int $requestTimeout = 60): mixed
    {
        return Json::decode(self::get($url, [...($headers ?: []), 'Content-Type: application/json'], $queryParams, $auth, $cacheTTL, $cachedResultOnFailure, $requestTimeout));
    }

    /**
     * Perform POST request
     *
     * @param string $url request URL
     * @param array|null $headers request headers
     * @param array|null $queryParams
     * @param array|null $bodyParams
     * @param array|null $auth
     * @param int $cacheTTL
     * @param bool $cachedResultOnFailure
     * @param int $requestTimeout
     * @return mixed
     */
    public static function postJson(string $url, ?array $headers = null, ?array $queryParams = null, ?array $bodyParams = null, ?array $auth = null, int $cacheTTL = 0, bool $cachedResultOnFailure = false, int $requestTimeout = 60): mixed
    {
        return Json::decode(self::post($url, [...($headers ?: []), 'Content-Type: application/json'], $queryParams, $bodyParams ? Json::encode($bodyParams) : null, $auth, $cacheTTL, $cachedResultOnFailure, $requestTimeout));
    }

}
