<?php


namespace MiniPress\app\action;

use Slim\Views\Twig;

class getFormRegisterAction
{
    public function __invoke(\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response): \Psr\Http\Message\ResponseInterface
    {
        $view = Twig::fromRequest($request);

        return $view->render($response, 'RegisterForm.twig');
    }
}
