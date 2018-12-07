<?php

namespace App\Controllers;


use App\Models\Domain;
use App\Models\User;
use Col\Request;

class LikeController extends BaseController
{
    public function get(Request $request)
    {
        $name = $request->get('user', 'flxxyz');
        $key = $request->get('key');

        $user = User::where([
            'name' => $name,
        ])->find();
        logger()->debug($user);

        $domain = Domain::all();
        logger()->debug($domain);

        $data = [
            'count' => 99999,
            'key' => $key,
            'user' => $user,
            'domain' => $domain,
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