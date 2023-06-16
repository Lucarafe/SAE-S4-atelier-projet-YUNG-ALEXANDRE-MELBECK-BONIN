<?php

namespace MiniPress\app\action;

use MiniPress\app\service\article\ArticleService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/**
 * Action pour afficher la liste des articles
 */
class getArticlesAction
{
    /**
     * Exécute l'action pour afficher la liste des articles
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $articleService = new ArticleService();
        // Récupère la liste des articles
        $articlesPubli = $articleService->getArticles();
        $articlesUser = null;
        if (isset($_SESSION['user'])) $articlesUser = $articleService->getArticlesUser($_SESSION['user']->login);

        $view = Twig::fromRequest($request);

        // Rend la vue des articles en passant les données des articles
        return $view->render($response, 'Articles.twig', ['articles' => $articlesPubli, 'articlesUser' => $articlesUser]);
    }
}
