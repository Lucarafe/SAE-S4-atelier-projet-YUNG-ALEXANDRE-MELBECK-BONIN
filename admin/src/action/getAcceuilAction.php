<?php

namespace MiniPress\app\action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

/**
 * Action pour l'accueil du site
 */
class getAcceuilAction {
    /**
     * Exécute l'action d'accueil
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('articles');

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}
