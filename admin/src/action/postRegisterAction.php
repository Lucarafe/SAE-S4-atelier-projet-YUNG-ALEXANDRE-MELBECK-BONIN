<?php

namespace MiniPress\app\action;

use MiniPress\app\service\auth\Auth;
use MiniPress\app\service\auth\exception\loginException;
use MiniPress\app\service\auth\exception\mdpException;
use MiniPress\app\service\injection\exception\injectionException;
use MiniPress\app\service\injection\injection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

/**
 * Action pour traiter la soumission du formulaire d'inscription
 */
class postRegisterAction {

    /**
     * Exécute l'action pour traiter la soumission du formulaire d'inscription
     *
     * @param ServerRequestInterface $request La requête HTTP reçue
     * @param ResponseInterface $response La réponse HTTP à renvoyer
     * @param array $args Les arguments de la route
     * @return ResponseInterface La réponse HTTP redirigeant vers la page de connexion ou d'inscription
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $params = $request->getParsedBody();

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('connection');

        $auth = new Auth();
        $injection = new injection();

        // Récupère les données soumises dans le formulaire
        $login = $params['login'] ?? '';
        $email = $params['email'] ?? '';
        $password = $params['password'] ?? '';
        $confirmPassword = $params['confirm-password'] ?? '';

        $errors = [];
        // Vérification de l'adresse e-mail
        if (empty($email) || !$injection->injectionMail($email)){
            $errors[] = 'Veuillez saisir une adresse email valide.';
        }

        // Vérification des mots de passe
        if (empty($password) || empty($confirmPassword) || $password !== $confirmPassword) {
            $errors[] = 'Les mots de passe ne correspondent pas.';
        }
        if (!$auth->checkPasswordStrength($password, 8)) {
            $errors[] = 'Mot de passe pas assez fort.';
        }
        try{
            // Vérification de l'injection de code dans le mot de passe
            $injection->injectionString($password);
        } catch (injectionException $e){
            $errors[] = 'Veuillez saisir un mot de passe valide.';
        }
        try{
            // Vérification de l'injection de code dans le login
            $injection->injectionString($login);
        } catch (injectionException $e){
            $errors[] = 'Veuillez saisir un login valide.';
        }

        if (!empty($errors)) {
            // s'il y a une erreur rediriger vers le formulaire
            $view = Twig::fromRequest($request);
            return $view->render($response, 'RegisterForm.twig', ['errors' => $errors]);
        }

        try {
            // ajout de l'utilisateur dans la base
            $auth->register($email, $password, $confirmPassword, $login);
        } catch (mdpException $e) {
            // si le mot de passe est incorecte on redirige vers le formulaire
            $url = $routeParser->urlFor('register');
        } catch (loginException $e){
            // si le loin est incorecte on redirige vers le formulaire
            $url = $routeParser->urlFor('register');
        }

        // redirection vers le bon endroit
        return $response->withHeader('Location', $url)->withStatus(302);

    }
}