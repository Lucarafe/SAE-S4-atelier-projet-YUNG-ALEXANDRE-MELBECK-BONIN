<?php

namespace MiniPress\app\conf;

use MiniPress\app\action\deconnexionAction;
use MiniPress\app\action\getAcceuilAction;
use MiniPress\app\action\getArticlesAction;
use MiniPress\app\action\getArticlesByCategoryAction;
use MiniPress\app\action\getAuthAction;
use MiniPress\app\action\getCategorieAction;
use MiniPress\app\action\getCreateCategorieAction;
use MiniPress\app\action\getCreateCategorieFormAction;
use MiniPress\app\action\getFormAuthAction;
use MiniPress\app\action\getFormRegisterAction;
use MiniPress\app\action\getRegisterAction;
use MiniPress\app\action\getFormulaireArticleAction;
use MiniPress\app\action\postFormulaireArticleAction;
use MiniPress\app\action\getUserAction;

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
    $app->post('/formulaire', postFormulaireArticleAction::class)->setName('articleCreate');
    $app->get('/formulaire', getFormulaireArticleAction::class)->setName('formulaireArticle');
    $app->get('/categories', getCategorieAction::class)
        ->setName('categories');
    $app->get('/users', getUserAction::class)
        ->setName('users');
};
