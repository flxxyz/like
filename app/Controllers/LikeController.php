<?php

namespace App\Controllers;


class LikeController extends BaseController
{
    public function get()
    {
        $data = [
            'count' => 99999,
        ];

        return $this->ajax('获取💗💗成功', $data);
    }

    public function add()
    {
        $data = [
            'count' => 100000,
        ];

        return $this->ajax('😘爱你哟', $data);
    }
}