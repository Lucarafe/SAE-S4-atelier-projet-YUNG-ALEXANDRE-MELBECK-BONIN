<?php

namespace gift\api\conf;


use miniPress\api\actions\getCategoriesAction;
use miniPress\api\actions\getArticlesAction;
use miniPress\api\actions\getArticlesByCategIDAction;
use miniPress\api\actions\getArticlesByIDAction;
use miniPress\api\actions\getArticlesByAuteurIDAction;


return function (\Slim\App $app) {
    $app->get('/api/categories', getCategoriesAction::class);
    $app->get('/api/articles', getArticlesAction::class);
    $app->get('/api/categories/{id_categ}/articles',getArticlesByCategIDAction::class);
    $app->get('/api/articles/{id_a}',getArticlesByIDAction::class);
    $app->get('/api/auteurs/{id}/articles', getArticlesByAuteurIDAction::class);

};
