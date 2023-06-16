<?php

namespace MiniPress\app\action;

use MiniPress\app\service\article\ArticleService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

/**
 * Cette classe représente l'action d'ajouter ou de supprimer la publication d'un article.
 */
class getPublicationSuppressionAction {

    /**
     * Méthode invoquée lors de l'exécution de l'action.
     *
     * @param ServerRequestInterface $request  L'objet de requête du serveur.
     * @param ResponseInterface      $response L'objet de réponse du serveur.
     * @param array                  $args     Les arguments de la route.
     *
     * @return ResponseInterface La réponse du serveur.
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // Récupérer l'action de la publication depuis les paramètres GET
        $action = $_GET['action'];
        // Récupérer l'ID de l'article depuis les arguments de la route
        $id = (int)$args['id'] ?? null;


        $articleService = new ArticleService();
        // Appeler la méthode pour changer la publication de l'article
        $articleService->changerPubli($id, $action);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('articles');

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}
