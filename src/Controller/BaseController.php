<?php

namespace App\Controller;

abstract class BaseController
{
    protected $response;

    protected $query = [];

    protected $body = [];

    protected $referer = [
        'scheme' => 'http',
        'host' => ''
    ];

    protected static $not_url = [
        '/^(192\.168|127\.0)\.[0-9]{1,3}\.[0-9]{1,3}(:[1-6][0-9]{0,4}+|)$/',
        '/^localhost(:[1-6][0-9]{0,4}+|)$/',
        '/^[a-zA-Z0-9\-.]+[a-zA-Z0-9].(app|dev|py)(:[1-6][0-9]{0,4}+|)$/',
    ];

    public function query($key = '', $default = '')
    {
        return $this->query[$key] ?? $default;
    }

    public function body($key = '', $default = '')
    {
        return $this->body[$key] ?? $default;
    }

    public function checkReferer(&$code)
    {
        $_SERVER['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'] ?? '';
        if (!$_SERVER['HTTP_REFERER']) {
            // logger()->err('有二五仔直接请求来了！ key=' . $key);
            $code = 400;
            return true;
        }

        $this->referer = parse_url($_SERVER['HTTP_REFERER']);
        foreach (self::$not_url as $value) {
            if (preg_match($value, $this->referer['host'], $match)) {
                // logger()->err('这个二五仔来的位置被限制了 key=' . $key);
                $code = 401;
                return true;
            }
        }

        return false;
    }

    public function json($message = '', $data = [], $allow_domain, $state = 200)
    {
        $origin = $allow_domain ? ($this->referer['scheme'] . '://' . $allow_domain): '*';
        header('Access-Control-Allow-Origin: ' . $origin);

        return $this->response->withJson(array_merge([
            'message' => $message,
            'state' => $state,
            'query_time' => query_time(),
        ], $data));
    }
}
