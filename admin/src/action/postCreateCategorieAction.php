<?php

namespace MiniPress\app\action;

use MiniPress\app\service\categorie\CategorieService;
use Slim\Routing\RouteContext;

class postCreateCategorieAction
{
    public function __invoke(\Psr\Http\Message\ServerRequestInterface $rq, \Psr\Http\Message\ResponseInterface $rs, array $args): \Psr\Http\Message\ResponseInterface
    {
        if(!isset($_SESSION['user'])){
            $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
            $url = $routeParser->urlFor('articles');
            return $rs->withHeader('Location', $url)->withStatus(302);
        }

        $post_data = $rq->getParsedBody();

        $categorieTitre = $post_data['titre'] ?? null;
        $categorieResume = $post_data['resume'] ?? null;

        $categorieService = new CategorieService();
        $categorieService->addCategorie($categorieTitre, $categorieResume);

        $routeParser = \Slim\Routing\RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('categories');
        return $rs->withHeader('Location', $url)->withStatus(302);
    }
}