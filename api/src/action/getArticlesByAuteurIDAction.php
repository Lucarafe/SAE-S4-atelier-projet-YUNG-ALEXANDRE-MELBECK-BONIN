<?php

namespace MiniPress\api\action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class getArticlesByAuteurIDAction
{
    public function __invoke(Request $request, Response $response): Response  {
        $articles = \MiniPress\api\models\Article::where('idAuteur', $request->getAttribute('id'))->get();
        $data = [
            'type' => 'collection',
            'count' => count($articles),
            'articles' => [],
        ];
        foreach ($articles as $article) {
            // Construire l'URL pour obtenir l'article complet
            $articleUrl = '/api/articles/' . $article->id;

            // Ajouter les données de l'article à la structure JSON
            $data['articles'][] = [
                'type' => 'collection','article' => [
                    'titre' => $article->titre,
                    'resume' => $article->resume,
                    'created_at' => $article->created_at,
                    'auteur' => $article->auteur,
                ],
                'links' => [
                    'self' => [
                        'href' => '/api/articles/' . $article->id,
                    ],
                ]
            ];
        }
        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type','application/json')
                ->withHeader('Access-Control-Allow-Origin','*')
                ->withStatus(200);
    }

}
