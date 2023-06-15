<?php

namespace MiniPress\app\action;

use MiniPress\app\service\categorie\CategorieService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/**
 * Action pour afficher la liste des catégories
 */
class getCategorieAction
{
    /**
     * Exécute l'action pour afficher la liste des catégories
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $categorieService = new CategorieService();
        // Récupère la liste des catégories
        $categories = $categorieService->getCategories();
        $view = Twig::fromRequest($request);

        // Rend la vue des catégories en passant les données des catégories
        return $view->render($response, 'Categories.twig', ['categories' => $categories]);
    }
}