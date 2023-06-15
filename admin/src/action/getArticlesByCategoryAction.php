<?php

namespace MiniPress\app\action;

use MiniPress\app\service\article\ArticleService;
use MiniPress\app\service\article\exception\ArticleNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/**
 * Action pour afficher la liste des articles d'une catégorie donnée
 */
class getArticlesByCategoryAction
{
    /**
     * Exécute l'action pour afficher la liste des articles d'une catégorie donnée
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $categorie = $args['categorie'];
        $articleService = new ArticleService();

        try {
            // Récupère la liste des articles de la catégorie spécifiée
            $articles = $articleService->getArticlesByCategory($categorie);
        } catch (ArticleNotFoundException $e) {
            $response->getBody()->write("<h1>{$e->getMessage()}");
            return $response;
        }

        $view = Twig::fromRequest($request);

        // Rend la vue des articles de la catégorie en passant les données des articles
        return $view->render($response, 'ArticlesByCategorie.twig', ['articles' => $articles]);
    }
}
