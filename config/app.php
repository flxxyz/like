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
];
