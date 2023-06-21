<?php

namespace MiniPress\app\action;

use MiniPress\app\service\auth\Auth;
use MiniPress\app\service\auth\exception\AuthException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

/**
 * Action pour traiter la soumission du formulaire de connexion
 */
class postAuthAction {

    /**
     * Exécute l'action pour traiter la soumission du formulaire de connexion
     *
     * @param ServerRequestInterface $request La requête HTTP reçue
     * @param ResponseInterface $response La réponse HTTP à renvoyer
     * @param array $args Les arguments de la route
     * @return ResponseInterface La réponse HTTP redirigeant vers la page des articles
     */
    function __invoke(ServerRequestInterface $request,ResponseInterface $response, array $args): ResponseInterface {
        // Récupère les données soumises dans le formulaire
        $params = $request->getParsedBody();
        $email = $params['email'];
        $psswrd = $params['password'];

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('articles');

        $auth = new Auth();
        try {
            // Authentifie l'utilisateur
            $auth->authenticate($psswrd, $email);
        } catch (AuthException $e){
            // En cas d'erreur d'authentification, redirige vers la page de connexion
            $url = $routeParser->urlFor('connection');
            return $response->withHeader('Location', $url)->withStatus(302);

        }
        // Redirige vers la page des articles
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}