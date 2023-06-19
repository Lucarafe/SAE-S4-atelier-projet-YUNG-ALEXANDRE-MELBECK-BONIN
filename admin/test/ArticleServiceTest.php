<?php

namespace MiniPress\test;

use Illuminate\Support\Manager;
use MiniPress\app\models\Article;
use MiniPress\app\service\article\ArticleService;
use Illuminate\Database\Capsule\Manager as DB;
use PHPUnit\Framework\TestCase;
require __DIR__."/../src/vendor/autoload.php";


class ArticleServiceTest extends TestCase{

public static function setUpBeforeClass(): void
{
    parent::setUpBeforeClass();
    $dataBase = new DB();
    $dataBase->addConnection(parse_ini_file(__DIR__."/../src/conf/minipress.db.conf.ini"));
    $dataBase->setAsGlobal();
    $dataBase->bootEloquent();
    $faker = \Faker\Factory::create('fr_FR');
    
    $article = new Article();
    $article->id = 1;
    $article->titre = "Titre de l'article de test";
    $article->resume = "Résumé de l'article de test";
    $article->contenu = "Contenu de l article de test";
    $article->auteur = "Auteur de l'article de test";
    $article->img = "img.jpg";
    $article->idCategorie = 1;
    $article->idAuteur = 1;
    $article->publication = 1;
    $article->save();

    $article1 = new Article();
    $article1->id = 2;
    $article1->titre = "Titre de l'article de test";
    $article1->resume = "Résumé de l'article de test";
    $article1->contenu = "Contenu de l article de test";
    $article1->auteur = "Auteur de l'article de test";
    $article1->img = "img.jpg";
    $article1->idCategorie = 2;
    $article1->idAuteur = 2;
    $article1->publication = 1;
    $article1->save();
}

public static function tearDownAfterClass(): void
{
    parent::tearDownAfterClass();
    Article::truncate();
}

public function testGetArticles(){
    $articleService = new ArticleService();
    $articles = $articleService->getArticles();
    $this->assertEquals(1, $articles[0]['id']);
}

public function testGetArticlesByCategory(){
    $articleService = new ArticleService();
    $articles = $articleService->getArticlesByCategory(1);
    $this->assertEquals(1, $articles[0]['id']);
    $this->assertEquals(1, $articles[0]['idCategorie']);
    $this->assertEquals(1,count($articles));
}
}