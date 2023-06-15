<?php

namespace MiniPress\app\action;
use MiniPress\app\service\categorie\CategorieService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

/**
 * Action pour afficher le formulaire d'ajout d'article
 */
class getFormulaireArticleAction{

    /**
     * Exécute l'action pour afficher le formulaire d'ajout d'article
     *
     * @param Request $request
     * @param Response $response
     * @param array $args Les arguments de la route (le cas échéant)
     * @return Response La réponse HTTP contenant la vue rendue du formulaire d'ajout d'article
     */
    public function __invoke(Request $request, Response $response, array $args):Response{
        // Vérifie si l'utilisateur est connecté
        if(!isset($_SESSION['user'])){
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('articles');
            return $response->withHeader('Location', $url)->withStatus(302);
        }

        $twig = Twig::fromRequest($request);
        $categorieService = new CategorieService();
        // Récupère les catégories d'articles
        $categories = $categorieService->getCategories();
        // Rend la vue du formulaire d'ajout d'article avec les catégories
        return $twig->render($response, 'FormulaireArticle.twig', [
            'categories' => $categories ]);


    }
}