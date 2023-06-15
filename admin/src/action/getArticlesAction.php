<?php

namespace MiniPress\app\action;

use MiniPress\app\service\ArticleService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class getArticlesAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $articleService = new ArticleService();
        $articles = $articleService->getArticles();

        $view = Twig::fromRequest($request);

        return $view->render($response, 'Articles.twig', ['articles' => $articles]);
    }
}
