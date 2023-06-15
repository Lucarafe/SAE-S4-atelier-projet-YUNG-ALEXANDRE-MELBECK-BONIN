<?php

namespace MiniPress\app\conf;

use MiniPress\app\action\deconnexionAction;
use MiniPress\app\action\getAcceuilAction;
use MiniPress\app\action\getArticlesAction;
use MiniPress\app\action\getArticlesByCategoryAction;
use MiniPress\app\action\postAuthAction;
use MiniPress\app\action\getCategorieAction;
use MiniPress\app\action\postCreateCategorieAction;
use MiniPress\app\action\getCreateCategorieFormAction;
use MiniPress\app\action\getFormAuthAction;
use MiniPress\app\action\getFormRegisterAction;
use MiniPress\app\action\postRegisterAction;
use MiniPress\app\action\getFormulaireArticleAction;
use MiniPress\app\action\postFormulaireArticleAction;
use MiniPress\app\action\getUserAction;

return function (\Slim\App $app): void {
    $app->get('/', getAcceuilAction::class)
        ->setName('acceuil');
    //route pour les connections
    $app->get('/users/connection', getFormAuthAction::class)
        ->setName('connection');
    $app->get('/users/register', getFormRegisterAction::class)
        ->setName('/users/register');
    $app->post('/users/register', postRegisterAction::class)
        ->setName('register');
    $app->post('/users/connection', postAuthAction::class)
        ->setName('connection');
    $app->get('/users/deconnexion', deconnexionAction::class)
        ->setName('deconnexion');
    $app->post('/articles/create', postFormulaireArticleAction::class)
        ->setName('articleCreate');
    $app->get('/articles/create', getFormulaireArticleAction::class)
        ->setName('formulaireArticle');
    $app->get('/articles/{categorie}', getArticlesByCategoryAction::class)
        ->setName('articlesByCategory');
    $app->get('/articles', getArticlesAction::class)
        ->setName('articles');
    $app->get('/categories/create', getCreateCategorieFormAction::class)
        ->setName('categoriesCreate');
    $app->post('/categories/create', postCreateCategorieAction::class)
        ->setName('categoriesCreate');
    $app->get('/categories', getCategorieAction::class)
        ->setName('categories');
    $app->get('/users', getUserAction::class)
        ->setName('users');
};
