<?php

namespace MiniPress\app\action;

use MiniPress\app\service\categorie\CategorieService;

class getCreateCategorieAction
{
    public function __invoke(\Psr\Http\Message\ServerRequestInterface $rq, \Psr\Http\Message\ResponseInterface $rs, array $args): \Psr\Http\Message\ResponseInterface
    {
        $post_data = $rq->getParsedBody();

        $categorieTitre = $post_data['titre'] ?? null;
        $categorieResume = $post_data['resume'] ?? null;

        $categorieService = new CategorieService();
        $categorieService->addCategorie($categorieTitre, $categorieResume);

        $routeParser = \Slim\Routing\RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('articles');
        return $rs->withHeader('Location', $url)->withStatus(302);
    }
}