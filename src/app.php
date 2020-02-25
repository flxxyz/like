<?php

namespace App;

/*
 * A simple Slim based sample application
 *
 * See Slim documentation:
 * http://www.slimframework.com/docs/
 */

use App\Controller\LikeController;
use LeanCloud\Client;
use LeanCloud\Engine\SlimEngine;
use LeanCloud\Storage\CookieStorage;
use Slim\App as SlimApp;

$app = new SlimApp();
// 禁用 Slim 默认的 handler，使得错误栈被日志捕捉
unset($app->getContainer()['errorHandler']);

Client::initialize(
    getenv("LEANCLOUD_APP_ID"),
    getenv("LEANCLOUD_APP_KEY"),
    getenv("LEANCLOUD_APP_MASTER_KEY")
);
// 将 sessionToken 持久化到 cookie 中，以支持多实例共享会话
Client::setStorage(new CookieStorage());
Client::useProduction((getenv("LEANCLOUD_APP_ENV") === "production") ? true : false);

SlimEngine::enableHttpsRedirect();
$app->add(new SlimEngine());

$app->get('/', function () {
    return '<h1>In the end, it\'s not the years in your life that count. It\'s the life in your years.</h1>';
});

$app->get('/get', LikeController::class . ':get');
$app->post('/add', LikeController::class . ':add');

$app->run();
