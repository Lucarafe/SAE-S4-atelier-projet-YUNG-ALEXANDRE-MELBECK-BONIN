<?php

namespace MiniPress\app\action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

/**
 * Action pour afficher le formulaire de création de catégorie
 */
class getCreateCategorieFormAction
{
    /**
     * Exécute l'action pour afficher le formulaire de création de catégorie
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response):ResponseInterface
    {
        // Vérifie si l'utilisateur est connecté
        if(!isset($_SESSION['user'])){
            // Redirige vers la page des articles s'il n'est pas connecté
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('articles');
            return $response->withHeader('Location', $url)->withStatus(302);
        }
        $view = Twig::fromRequest($request);
        // Rend la vue du formulaire de création de catégorie
        return $view->render($response, 'CreateCategorieForm.twig');
    }
}