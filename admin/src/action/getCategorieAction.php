<?php

namespace MiniPress\app\action;

use MiniPress\app\service\categorie\CategorieService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class getCategorieAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $categorieService = new CategorieService();
        $categories = $categorieService->getCategories();

        $view = Twig::fromRequest($request);

        return $view->render($response, 'Categories.twig', ['categories' => $categories]);
    }
}