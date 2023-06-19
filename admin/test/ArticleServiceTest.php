<?php

namespace MiniPress\test;

use Illuminate\Support\Manager;
use MiniPress\app\models\Article;
use MiniPress\app\service\article\ArticleService;
use Illuminate\Database\Capsule\Manager as DB;
use PHPUnit\Framework\TestCase;
require __DIR__."/../src/vendor/autoload.php";


class ArticleServiceTest extends TestCase{

    private static array $articles = [];
public static function setUpBeforeClass(): void
{
    parent::setUpBeforeClass();
    $dataBase = new DB();
    $dataBase->addConnection(parse_ini_file(__DIR__."/../src/conf/minipress.db.conf.ini"));
    $dataBase->setAsGlobal();
    $dataBase->bootEloquent();
    $faker = \Faker\Factory::create('fr_FR');
    
    $article = new Article();
    $article->titre = "Titre de l'article de test";
    $article->resume = "Résumé de l'article de test";
    $article->contenu = "Contenu de l article de test";
    $article->date = "2021-01-01 00:00:00";
    $article->auteur = "Auteur de l'article de test";
    $article->img = "img.jpg";
    $article->idCategorie = 1;
    $article->idAuteur = 1;
    $article->publication = 2;
    $article->save();
    self::$articles = [$article];
}

public function testGetArticles(){
    $articleService = new ArticleService();
    $articles = $articleService->getArticles();
   $this->assertEquals(self::$articles, $articles);
}


}