<?php

namespace App\Controllers;


use Col\Controller;

class BaseController extends Controller
{
    public function ajax($message = '', $data = [], $code = 200)
    {
        $result = array_merge([
            'message' => $message,
            'state' => $code,
            'query_time' => run_time(),
        ], $data);

        return $this->json($result);
    }
}