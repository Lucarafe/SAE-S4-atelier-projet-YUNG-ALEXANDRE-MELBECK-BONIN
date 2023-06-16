<?php

namespace MiniPress\app\service\article;

use MiniPress\app\models\Article;

class ArticleService
{

    /**
     * Récupère tous les articles.
     *
     * @return array Les articles sous forme de tableau
     */
    public function getArticles(): array
    {
        return Article::where('publication', 1)->orderBy('created_at', 'desc')->get()->toArray();
    }


    /**
     * Récupère les articles d'une catégorie spécifique.
     *
     * @param string $categorie La catégorie des articles à récupérer
     */
    public function getArticlesByCategory($categorie)
    {
        return Article::whereHas('categorie', function ($query) use ($categorie) {
            $query->where('titre', '=', $categorie);
        })->orderBy('created_at', 'desc')->get();
    }

    /**
     * Ajoute un nouvel article.
     *
     * @param array $article Les données de l'article à ajouter
     * @return void
     */
    public function addArticle(array $article){

        $art = new Article();
        $art->titre = $article['titre'];
        $art->resume = $article['resume'];
        $art->contenu = $article['contenu'];
        $art->idCategorie = $article['categorie'];
        $art->img = "";
        $art->auteur = $article['auteur'];
        $art->idAuteur = $article['idAuteur'];
        $art->save();
    }

    function getArticlesUser($login){
        return Article::where('auteur', $login)->orderBy('created_at', 'desc')->get()->toArray();
    }
    function changerPubli($id, $publi){
        $article = Article::find($id);
        $article->publication = $publi;
        $article->save();
    }
}
