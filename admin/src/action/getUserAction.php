<?php

namespace MiniPress\app\action;

use MiniPress\app\service\user\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class getUserAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $userService = new UserService();
        $users = $userService->getUsers();

        $view = Twig::fromRequest($request);

        return $view->render($response, 'Users.twig', ['users' => $users]);
    }
}