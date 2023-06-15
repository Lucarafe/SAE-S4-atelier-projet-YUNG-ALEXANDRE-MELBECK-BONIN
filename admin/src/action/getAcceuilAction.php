<?php

namespace MiniPress\app\action;

use Slim\Routing\RouteContext;

class getAcceuilAction {
    public function __invoke(\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response): \Psr\Http\Message\ResponseInterface {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('connection');
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}