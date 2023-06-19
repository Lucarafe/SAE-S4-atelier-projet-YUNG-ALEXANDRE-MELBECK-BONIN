<?php

namespace MiniPress\test;

use Illuminate\Support\Manager;
use MiniPress\app\models\Article;
use MiniPress\app\service\article\ArticleService;
use Illuminate\Database\Capsule\Manager as DB;
use PHPUnit\Framework\TestCase;


class ArticleServiceTest extends TestCase{

    private static array $articles = [];
public static function setUpBeforeClass(): void
{
    parent::setUpBeforeClass();
    $dataBase = new DB();
    $dataBase->addConnection(parse_ini_file(__DIR__."src/conf/minipress.db.conf.ini.dist"));
    $dataBase->setAsGlobal();
    $dataBase->bootEloquent();
    $faker = \Faker\Factory::create('fr_FR');
    
    $article = new Article();
    $article->titre = $faker->word();
    $article->resume = $faker->paragraph(2);
    $article->contenu = $faker->paragraph(5);
    $article->date = $faker->date();
    $article->auteur = $faker->name();
    $article->save();
    self::$articles = [$article];
}

public function testGetArticles(){
    $articleService = new ArticleService();
    $articles = $articleService->getArticles();
   $this->assertEquals(self::$articles, $articles);
}


}