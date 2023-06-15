<?php

namespace MiniPress\app\action;

use MiniPress\app\service\auth\Auth;
use MiniPress\app\service\auth\exception\AuthException;
use MiniPress\app\service\injection\exception\injectionException;
use Slim\Routing\RouteContext;


class getAuthAction {

    function __invoke(\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response, array $args): \Psr\Http\Message\ResponseInterface {
        $params = $request->getParsedBody();
        $email = $params['email'];
        $psswrd = $params['password'];

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('articles');

        $auth = new Auth();
        try {
            $auth->authenticate($psswrd, $email);
        } catch (AuthException $e){
            $url = $routeParser->urlFor('connection');
        }

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}