<?php

namespace MiniPress\app\action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/**
 * Action pour afficher le formulaire d'authentification
 */
class getFormAuthAction {

    /**
     * Exécute l'action pour afficher le formulaire d'authentification
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $view = Twig::fromRequest($request);
        // Rend la vue du formulaire d'authentification
        return $view->render($response, 'AuthForm.twig');
    }

}