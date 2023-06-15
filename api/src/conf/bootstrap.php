<?php

namespace MiniPress\api\conf;

use Illuminate\Database\Capsule\Manager as DB;
use Slim\Factory\AppFactory;


$app = AppFactory::create();
$app->addErrorMiddleware(true,false,false);
$app->setBasePath('');
$db = new DB();
$db->addConnection(parse_ini_file(__DIR__ . '/minipress.db.conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

return $app;
