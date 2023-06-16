<?php

namespace MiniPress\app\action;

use MiniPress\app\service\article\ArticleService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;


class getPublicationSuppressionAction {

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $action = $_GET['action'];
        $id = (int)$args['id'] ?? null;

        $articleService = new ArticleService();
        $articleService->changerPubli($id, $action);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('articles');

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}
