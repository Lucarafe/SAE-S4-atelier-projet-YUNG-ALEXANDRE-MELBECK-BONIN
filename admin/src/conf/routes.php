<?php

namespace MiniPress\app\conf;

use MiniPress\app\action\getAcceuilAction;
use MiniPress\app\action\getFormAuthAction;

return function (\Slim\App $app): void {
    $app->get('/', getAcceuilAction::class)
        ->setName('acceuil');
    //route pour les connections
    $app->get('/connection', getFormAuthAction::class)
        ->setName('connection');
    //$app->post('/connection', getAuthAction::class)
    //    ->setName('connection');

};
