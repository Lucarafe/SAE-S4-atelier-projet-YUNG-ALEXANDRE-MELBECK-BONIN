<?php

namespace MiniPress\app\action;
use MiniPress\app\service\categorie\CategorieService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class getFormulaireArticleAction{

    public function __invoke(Request $rq, Response $rs, $args):Response{

        if(!isset($_SESSION['user'])){
            $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
            $url = $routeParser->urlFor('articles');
            return $rs->withHeader('Location', $url)->withStatus(302);
        }

        $twig = Twig::fromRequest($rq);
        $categorieService = new CategorieService();
        $categories = $categorieService->getCategories();
        return $twig->render($rs, 'FormulaireArticle.twig', [
            'categories' => $categories ]);


    }
}