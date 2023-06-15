<?php

namespace MiniPress\app\service\article;

use MiniPress\app\models\Article;
use MiniPress\app\service\auth\exception\ArticleAddFailException;

class ArticleService
{

    public function getArticles(): array
    {
        return Article::orderBy('created_at', 'desc')->get()->toArray();
    }


    public function getArticlesByCategory($categorie)
    {
        return Article::whereHas('categorie', function ($query) use ($categorie) {
            $query->where('titre', '=', $categorie);
        })->orderBy('created_at', 'desc')->get();
    }

    public function addArticle(array $article){
      
        $art = new Article();
        $art->titre = $article['titre'];
        $art->resume = $article['resume'];
        $art->contenu = $article['contenu'];
        $art->idCategorie = $article['categorie'];
        $art->img = "";
        $art->auteur = $article['auteur'];
        $art->save();
        }
    
    

}
