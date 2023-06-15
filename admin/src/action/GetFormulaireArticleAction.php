<?php

namespace MiniPress\app\action;
use MiniPress\app\service\categorie\CategorieService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class getFormulaireArticleAction{

    public function __invoke(Request $rq, Response $rs, $args):Response{

        $twig = Twig::fromRequest($rq);
        $categorieService = new CategorieService();
        $categories = $categorieService->getCategories();
        return $twig->render($rs, 'FormulaireArticle.twig', [
            'categories' => $categories ]);

    }
}