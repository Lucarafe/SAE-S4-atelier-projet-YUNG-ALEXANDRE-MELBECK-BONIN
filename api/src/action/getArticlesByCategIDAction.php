<?php

namespace MiniPress\api\action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class getArticlesByCategIDAction
{
    public function __invoke(Request $request, Response $response): Response {


        $articles = \MiniPress\api\models\Article::where('idCategorie', $request->getAttribute('id_categ'))->get();

        if (!$articles) {
            // Catégorie introuvable, retourner une réponse 404
            return $response->withStatus(404);
        }



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
                'titre' => $article->titre,
                'created_at' => $article->created_at,
                'auteur' => $article->auteur,
                'url' => $articleUrl,
            ];
        }

        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type','application/json')
                ->withStatus(200);
    }

}
