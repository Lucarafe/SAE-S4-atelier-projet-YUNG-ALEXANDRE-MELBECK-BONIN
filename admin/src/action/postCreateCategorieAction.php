<?php

namespace MiniPress\app\action;

use MiniPress\app\service\categorie\CategorieService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

/**
 * Action pour traiter la soumission du formulaire de création de catégorie
 */
class postCreateCategorieAction
{
    /**
     * Exécute l'action pour traiter la soumission du formulaire de création de catégorie
     *
     * @param ServerRequestInterface $request La requête HTTP reçue
     * @param ResponseInterface $response La réponse HTTP à renvoyer
     * @param array $args Les arguments de la route
     * @return ResponseInterface La réponse HTTP redirigeant vers la page des catégories
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // Vérifie si l'utilisateur est connecté
        if(!isset($_SESSION['user'])){
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('articles');
            return $response->withHeader('Location', $url)->withStatus(302);
        }

        $post_data = $request->getParsedBody();
        // Récupère les données soumises dans le formulaire
        $categorieTitre = $post_data['titre'] ?? null;
        $categorieResume = $post_data['resume'] ?? null;

        $categorieService = new CategorieService();
        // Ajoute la catégorie
        $categorieService->addCategorie($categorieTitre, $categorieResume);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('categories');
        // Redirige vers la page des catégories
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}