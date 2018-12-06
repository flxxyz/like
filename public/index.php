<?php

//预定义目录常量
define('DS', DIRECTORY_SEPARATOR, true);
define('PUBLIC_DIR', realpath(__DIR__).DS, true);
define('BASE_DIR', realpath(__DIR__ . '/..').DS, true);
define('APP_DIR', realpath(BASE_DIR.'app').DS, true);
define('VIEW_DIR', realpath(APP_DIR.'Views').DS, true);
define('MODEL_DIR', realpath(APP_DIR.'Models').DS, true);
define('CONTROLLER_DIR', realpath(APP_DIR.'Controllers').DS, true);

//入口文件
require_once __DIR__.'/../bootstrap/app.php';