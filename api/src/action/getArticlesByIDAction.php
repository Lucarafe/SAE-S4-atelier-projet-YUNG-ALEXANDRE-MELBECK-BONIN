<?php

namespace MiniPress\api\action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class getArticlesByIDAction
{
    public function __invoke(Request $request, Response $response, $args): Response  {

        $article = \MiniPress\api\models\Article::find($args['id_a']);

        if(!$article) {
            $response->getBody()->write(json_encode(['message' => 'Article not found']));
            return
                $response->withHeader('Content-Type','application/json')
                    ->withStatus(404);
        }

        $data = [
            'type' => 'resource','article' => [
                'id' => $article->id,
                'titre' => $article->titre,
                'resume' => $article->resume,
                'contenu' => $article->contenu,
                'img' => $article->img,
                'auteur' => $article->auteur,
                'idAuteur' => $article->idAuteur,
                'idCategorie' => $article->idCategorie,
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at,
                'publication'=> $article->publication,
            ],
            'links' => [
                'self' => [
                    'href' => '/api/articles/' . $article->id,
                ],
                'articles_author' => [
                    'href' => '/api/auteurs/' . $article->idAuteur . '/articles',
                ]
            ],
        ];

        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type','application/json')
                ->withHeader('Access-Control-Allow-Origin','*')
                ->withStatus(200);
    }

}
