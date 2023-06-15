<?php

namespace MiniPress\app\action;

use MiniPress\app\service\user\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class getUserAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
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

        $userService = new UserService();
        $users = $userService->getUsers();

        $view = Twig::fromRequest($request);

        return $view->render($response, 'Users.twig', ['users' => $users]);
    }
}