<?php


namespace MiniPress\app\action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

/**
 * Action pour afficher le formulaire d'inscription
 */
class getFormRegisterAction
{

    /**
     * Exécute l'action pour afficher le formulaire d'inscription
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Vérifie si l'utilisateur est connecté
        if(!isset($_SESSION['user'])){
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('articles');
            return $response->withHeader('Location', $url)->withStatus(302);
        }

        // Vérifie si l'utilisateur a le privilège administrateur
        if ($_SESSION['user']->privile = 0) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('articles');
            return $response->withHeader('Location', $url)->withStatus(302);
        }

        $view = Twig::fromRequest($request);
        // Rend la vue du formulaire d'inscription
        return $view->render($response, 'RegisterForm.twig');
    }
}
