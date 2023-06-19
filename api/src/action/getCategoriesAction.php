<?php

namespace  MiniPress\api\action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetCategoriesAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        $categories = \MiniPress\api\models\Categorie::all();

        $data = [
            'type' => 'collection',
            'count' => count($categories),
            'categories' => [],
        ];

        foreach ($categories as $categorie) {
            $data['categories'][] = [
                'categorie' => [
                    'id' => $categorie->id,
                    'titre' => $categorie->titre,
                    'resume' => $categorie->resume,
                    'created_at' => $categorie->created_at,
                    'updated_at' => $categorie->updated_at,
                ],
                'links' => [
                    'self' => [
                        'href' => '/categories/' . $categorie->id . '/',
                    ],
                ],
            ];
        }

        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type','application/json')
                ->withHeader('Access-Control-Allow-Origin','*')
                ->withStatus(200);
    }
}
