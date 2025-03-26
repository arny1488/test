<?php

class Netcom
{
    protected static array $set_opt = [
        CURLOPT_AUTOREFERER => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_HEADER => 1,
        CURLOPT_USERAGENT => 'NetCom/2.0',
        CURLOPT_CONNECTTIMEOUT => 20,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
    ];

    public static bool $debug = false;

    protected static array $cookies = [];
    protected static string $active_cookie = '0';

    protected array $headers;
    protected string $content;
    protected array $info;

    private function __construct(array $headers, string $content, ?array $info = null)
    {
        $this->headers = $headers;
        $this->content = $content;
        $this->info = $info;
    }

    public static function initCookie(string $session_key, string $path_to, bool $is_file = false): void
    {
        static::$active_cookie = $session_key;
        static::setCookie([]);

        if ($is_file) {
            static::setCookie('file', $path_to);
            return;
        } else {
            $init_new_file = function () use ($path_to, $session_key) {
                if (!static::getCookie('file')) {
                    static::setCookie('file', rtrim($path_to, '/') . '/' . md5(random_int(1, time())) . '.ncc');
                }
                return static::getCookie('file');
            };
        }
        static::setOpt([CURLOPT_COOKIEFILE => $init_new_file, CURLOPT_COOKIEJAR => $init_new_file]);
    }

    public static function setCookie(array|string $opt, $value = null): void
    {
        if (is_array($opt)) {
            static::$cookies[static::$active_cookie] = $opt;
        } else {
            static::$cookies[static::$active_cookie][$opt] = $value;
        }
    }

    public static function getCookie(?string $key = null): mixed
    {
        if ($key) {
            return static::$cookies[static::$active_cookie][$key];
        }
        return static::$cookies[static::$active_cookie];
    }

    public static function useCookie(string $session_key): void
    {
        static::$active_cookie = $session_key;
    }

    private function __clone()
    {
    }

    public function toDOM(): ?\DOMXpath
    {
        $doc = new DOMDocument;
        if (!$doc->loadHTML($this->content)) {
            throw new \RuntimeException('Can\'t load DOM');
        }

        return new DOMXpath($doc);
    }

    public function toJSON(): bool|string
    {
        return json_encode($this->content);
    }

    public function toObj()
    {
        return json_decode($this->content, true);
    }

    public function toUtf(): bool|string
    {
        return $this->content = iconv('cp1251', 'utf-8', $this->content);
    }

    public function __toString()
    {
        return $this->get() ?: '{empty response}';
    }

    public function headers(): array
    {
        return $this->headers;
    }

    public function get(): string
    {
        return $this->content;
    }

    public function info(?string $key = null): mixed
    {
        if ($key) {
            return $this->info[$key];
        }
        return $this->info;
    }

    public function dump(): void
    {
        print_r($this->info);
    }

    public static function setOpt(array|string $opt, mixed $value = null): void
    {
        if (is_array($opt)) {
            foreach ($opt as $k => $v) {
                static::$set_opt[$k] = $v;
            }
        } else {
            static::$set_opt[$opt] = $value;
        }
    }

    public static function getOpt(string $key): mixed
    {
        if (static::$set_opt[$key] instanceof Closure) {
            return static::$set_opt[$key]->__invoke();
        }
        return static::$set_opt[$key];
    }

    public static function setProxy($proxy, $type = null, $pass = null): void
    {
        static::setOpt(CURLOPT_PROXY, $proxy);
        if ($type) {
            static::setOpt(CURLOPT_PROXYTYPE, $type === 0 ? CURLPROXY_HTTP : CURLPROXY_SOCKS5);
        }
        if ($pass) {
            static::setOpt(CURLOPT_PROXYUSERPWD, $pass);
        }
    }

    public static function request(string $url, array $headers = [], bool $post_data = false, bool $save_cookie = true): static
    {
        $cUrl = curl_init($url);

        static::setOpt([
            CURLOPT_HTTPHEADER => $headers,
        ]);

        if ($post_data) {
            static::setOpt([
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $post_data,
            ]);
        }

        $response_headers = [];

        curl_setopt(
            $cUrl, CURLOPT_HEADERFUNCTION,
            function ($curl, $header) use (&$response_headers) {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2) // ignore invalid headers
                {
                    return $len;
                }

                $response_headers[strtolower(trim($header[0]))][] = trim($header[1]);

                return $len;
            }
        );

        foreach (array_keys(static::$set_opt) as $key) {
            curl_setopt($cUrl, $key, static::getOpt($key));
        }

        if (static::getCookie('file')) {
            file_put_contents(static::getCookie('file'), static::getCookie('value'));
        }

        $response = curl_exec($cUrl);
        if (static::$debug && $response === false) {
            echo 'CURL error: ' . curl_error($cUrl);
        }
        $info = curl_getinfo($cUrl);
        $content = substr($response, $info['header_size']);

        curl_close($cUrl);

        if ($save_cookie && static::getCookie('file')) {
            static::setCookie('value', file_get_contents(static::getCookie('file')));
        }

        if (static::getCookie('file')) {
            @unlink(static::getCookie('file'));
            static::setCookie('file', null);
        }
        return new static($response_headers, $content, $info);
    }
}
