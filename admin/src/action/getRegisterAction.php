<?php

namespace MiniPress\app\action;

use MiniPress\app\service\auth\Auth;
use MiniPress\app\service\auth\exception\mdpException;
use MiniPress\app\service\injection\exception\injectionException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class getRegisterAction {

    /**
     * @throws injectionException
     */
    public function __invoke(\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response, array $args): \Psr\Http\Message\ResponseInterface {
        $params = $request->getParsedBody();

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('connection');

        $auth = new Auth();

        $email = $params['email'] ?? '';
        $password = $params['password'] ?? '';
        $confirmPassword = $params['confirm-password'] ?? '';

        $errors = [];
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Veuillez saisir une adresse email valide.';
        }
        if (empty($password) || empty($confirmPassword) || $password !== $confirmPassword) {
            $errors[] = 'Les mots de passe ne correspondent pas.';
        }
        if (!$auth->checkPasswordStrength($password, 8)) {
            $errors[] = 'Mot de passe pas assez fort.';
        }

        if (!empty($errors)) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'RegisterForm.twig', ['errors' => $errors]);
        }

        try {
            $auth->register($email, $password, $confirmPassword);
        } catch (mdpException $e) {
            $url = $routeParser->urlFor('register');
        }

        return $response->withHeader('Location', $url)->withStatus(302);

    }
}