<?php

namespace MiniPress\app\action;

use Slim\Views\Twig;

class getFormAuthAction {

    function __invoke(\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response, array $args): \Psr\Http\Message\ResponseInterface {
        $view = Twig::fromRequest($request);

        return $view->render($response, 'AuthForm.twig');
    }

}