<?php

namespace MiniPress\app\action;

use MiniPress\app\service\ArticleNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use MiniPress\app\service\ArticleService;
use Slim\Views\Twig;

class getArticlesByCategoryAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $categorie = $args['categorie'];
        $articleService = new ArticleService();

        try {
            $articles = $articleService->getArticlesByCategory($categorie);
        } catch (ArticleNotFoundException $e) {
            $response->getBody()->write("<h1>{$e->getMessage()}");
            return $response;
        }

        $view = Twig::fromRequest($request);

        return $view->render($response, 'ArticlesByCategorie.twig', ['articles' => $articles]);
    }
}
