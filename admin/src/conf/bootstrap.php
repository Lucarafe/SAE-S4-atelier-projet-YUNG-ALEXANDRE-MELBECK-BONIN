<?php

namespace MiniPress\app\conf;
use Illuminate\Database\Capsule\Manager as DB;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Error\LoaderError;

$app = AppFactory::create();
$app->addErrorMiddleware(true,false,false);

$db = new DB();
$db->addConnection(parse_ini_file(__DIR__ . '/minipress.db.conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

try {
    $twig = Twig::create(__DIR__. '/../views',
        ['cache' => __DIR__. '/../views/cache',
            'auto_reload' => true]);
} catch (LoaderError $e) {

    print $e->getMessage();
    die();
}
$twig->getEnvironment()->addGlobal('session', $_SESSION);
$app->add(TwigMiddleware::create($app, $twig));

return $app;
