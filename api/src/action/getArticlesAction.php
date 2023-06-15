<?php

namespace MiniPress\api\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class getArticlesAction
{    public function __invoke(Request $request, Response $response): Response  {
    $articles = \MiniPress\api\models\Article::all();
$data = [
        'type' => 'collection',
        'count' => count($articles),
        'articles' => [],
    ];

foreach ($articles as $article) {
    //seuls ses titres, date de création et auteur sont retournés, accompagnés de l’url permettant d’obtenir l’article complet.
    $data['articles'][] = [
        'article' => [
            'titre' => $article->titre,
            'created_at' => $article->created_at,
            'auteur' => $article->auteur,
            'url' => '/api/articles/' . $article->id,
        ],
        ];
}

    $response->getBody()->write(json_encode($data));
    return
        $response->withHeader('Content-Type','application/json')
            ->withStatus(200);


    }

}
