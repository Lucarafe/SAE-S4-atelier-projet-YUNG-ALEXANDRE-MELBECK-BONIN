<?php

namespace MiniPress\app\conf;

use MiniPress\app\action\getAcceuilAction;
use MiniPress\app\action\getArticlesAction;
use MiniPress\app\action\getArticlesByCategoryAction;
use MiniPress\app\action\getFormAuthAction;

return function (\Slim\App $app): void {
    $app->get('/', getAcceuilAction::class)
        ->setName('acceuil');
    //route pour les connections
    $app->get('/connection', getFormAuthAction::class)
        ->setName('connection');
    $app->get('/register', getFormRegisterAction::class)
        ->setName('register');
    $app->post('/register', getRegisterAction::class)
        ->setName('register');
    $app->post('/connection', getAuthAction::class)
        ->setName('connection');
    $app->get('/deconnexion', deconnexionAction::class)
        ->setName('deconnexion');
    $app->get('/articles/{categorie}', getArticlesByCategoryAction::class)
        ->setName('articlesByCategory');
    $app->get('/articles', getArticlesAction::class)
        ->setName('articles');
    $app->get('/categories/create[/]', getCreateCategorieFormAction::class)
        ->setName('categorieForm');
    $app->post('/categories/create[/]', getCreateCategorieAction::class)
        ->setName('categorieCreate');
};
