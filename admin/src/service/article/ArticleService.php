<?php

namespace MiniPress\app\service\article;

use MiniPress\app\models\Article;

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

}
