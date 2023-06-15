<?php

namespace MiniPress\app\action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

/**
 * Action pour gérer la déconnexion de l'utilisateur
 */
class getDeconnexionAction {
    /**
     * Exécute l'action de déconnexion de l'utilisateur
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response):ResponseInterface {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('articles');
        // Supprime la session de l'utilisateur
        unset($_SESSION['user']);
        // Redirige vers la page des articles
        return $response->withHeader('Location', $url)->withStatus(302);
    }

}