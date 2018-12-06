<?php

//引入自动加载文件
require_once __DIR__ . '/../vendor/autoload.php';

define('DS', DIRECTORY_SEPARATOR, true);
define('BASE_DIR', realpath(__DIR__ . '/..').DS, true);
define('APP_DIR', realpath(BASE_DIR.'app').DS, true);
define('VIEW_DIR', realpath(APP_DIR.'Views').DS, true);
define('MODEL_DIR', realpath(APP_DIR.'Models').DS, true);
define('CONTROLLER_DIR', realpath(APP_DIR.'Controllers').DS, true);

use Col\{
    Route,
    Lib\Config
};

ini_set('date.timezone', Config::get('app', 'timezone'));

Route::make(\request());

require_once BASE_DIR . 'route/web.php';

Route::end();
