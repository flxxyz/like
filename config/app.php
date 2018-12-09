<?php

return [
    'timezone'      => 'PRC',
    'allow_origins' => [
        'https://like.toyou.ren',
        'http://like.toyou.ren',
        'http://127.0.0.1',
    ],
    'allow_methods' => '*',
    'log'           => [
        'dir'    => BASE_DIR . 'log' . DS,
        'format' => 'D H:i:s u',
    ],
    'error_page'    => [
        '404' =>  VIEW_DIR . 'error/404.view.php',
    ],
    // 不允许通过的URL正则
    'not_url' => [
        '/^(192\.168|127\.0)\.[0-9]{1,3}\.[0-9]{1,3}(:[1-6][0-9]{0,4}+|)$/',
        '/^localhost(:[1-6][0-9]{0,4}+|)$/',
        '/^[a-zA-Z0-9\-.]+[a-zA-Z0-9].(app|dev|py)(:[1-6][0-9]{0,4}+|)$/',
    ],
];
