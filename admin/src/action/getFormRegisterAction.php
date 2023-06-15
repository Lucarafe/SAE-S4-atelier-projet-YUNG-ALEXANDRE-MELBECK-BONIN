<?php


namespace MiniPress\app\action;

use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class getFormRegisterAction
{
    public function __invoke(\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response): \Psr\Http\Message\ResponseInterface
    {
        if(!isset($_SESSION['user'])){
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('articles');
            return $response->withHeader('Location', $url)->withStatus(302);
        }

        if ($_SESSION['user']->privile = 0) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('articles');
            return $response->withHeader('Location', $url)->withStatus(302);
        }

        $view = Twig::fromRequest($request);

        return $view->render($response, 'RegisterForm.twig');
    }
}
