<?php

namespace MiniPress\app\action;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class getFormulaireArticleAction{

    public function __invoke(Request $rq, Response $rs, $args):Response{

        $twig = Twig::fromRequest($rq);
        return $twig->render($rs, 'FormulaireArticle.twig');
    }
}