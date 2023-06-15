<?php

namespace MiniPress\api\conf;


use MiniPress\api\action\getCategoriesAction;
use MiniPress\api\action\getArticlesAction;
use MiniPress\api\action\getArticlesByCategIDAction;
use MiniPress\api\action\getArticlesByIDAction;
use MiniPress\api\action\getArticlesByAuteurIDAction;


return function (\Slim\App $app) {
    $app->get('/api/categories', getCategoriesAction::class);
    $app->get('/api/articles', getArticlesAction::class);
    $app->get('/api/categories/{id_categ}/articles',getArticlesByCategIDAction::class);
    $app->get('/api/articles/{id_a}',getArticlesByIDAction::class);
    $app->get('/api/auteurs/{id}/articles', getArticlesByAuteurIDAction::class);

};
