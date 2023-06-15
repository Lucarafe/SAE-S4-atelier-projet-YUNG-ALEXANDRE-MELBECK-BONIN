<?php

namespace MiniPress\app\action;

use MiniPress\app\service\user\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

/**
 * Action pour afficher la liste des utilisateurs
 */
class getUserAction
{
    /**
     * Exécute l'action pour afficher la liste des utilisateurs
     *
     * @param ServerRequestInterface $request La requête HTTP reçue
     * @param ResponseInterface $response La réponse HTTP à renvoyer
     * @return ResponseInterface La réponse HTTP contenant la vue rendue de la liste des utilisateurs
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Vérifie si l'utilisateur est connecté
        if(!isset($_SESSION['user'])){
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('articles');
            return $response->withHeader('Location', $url)->withStatus(302);
        }
        // Vérifie si l'utilisateur est administrateur
        if ($_SESSION['user']->privile = 0) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('articles');
            return $response->withHeader('Location', $url)->withStatus(302);
        }

        $userService = new UserService();
        // Récupère les utilisateurs
        $users = $userService->getUsers();

        $view = Twig::fromRequest($request);
        // Rend la vue de la liste des utilisateurs avec les utilisateurs
        return $view->render($response, 'Users.twig', ['users' => $users]);
    }
}