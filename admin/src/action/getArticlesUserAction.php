<?php

namespace MiniPress\app\action;

use MiniPress\app\service\article\ArticleService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;


class getArticlesUserAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
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

        $articleService = new ArticleService();
        // Récupère la liste des articles
        $login = $args['login'] ?? null;
        $articlesPubli = $articleService->getArticlesUser($login);

        $view = Twig::fromRequest($request);

        // Rend la vue des articles en passant les données des articles
        return $view->render($response, 'Articles.twig', ['articles' => $articlesPubli]);
    }
}