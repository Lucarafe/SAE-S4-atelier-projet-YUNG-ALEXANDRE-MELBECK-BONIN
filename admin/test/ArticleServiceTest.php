<?php

namespace MiniPress\test;

use Illuminate\Support\Manager;
use MiniPress\app\models\Article;
use MiniPress\app\models\Categorie;
use MiniPress\app\service\article\ArticleService;
use Illuminate\Database\Capsule\Manager as DB;
use PHPUnit\Event\Test\AssertionFailed;
use PHPUnit\Framework\TestCase;
require __DIR__."/../src/vendor/autoload.php";


class ArticleServiceTest extends TestCase{
//méthode qui s'exécute avant les tests
public static function setUpBeforeClass(): void
{
    parent::setUpBeforeClass();
    //création de la base de données de test
    $dataBase = new DB();
    $dataBase->addConnection(parse_ini_file(__DIR__."/../src/conf/test.db.conf.ini"));
    $dataBase->setAsGlobal();
    $dataBase->bootEloquent();
    //utilisation de faker pour génerer des données aléatoires
    $faker = \Faker\Factory::create('fr_FR');

    $categorie = new Categorie();
    $categorie->id = 1;
    $categorie->titre = "Actualités";
    $categorie->resume = $faker->sentence(6, true);
    $categorie->save();

    $categorie1 = new Categorie();
    $categorie1->id = 2;
    $categorie1->titre = "Tutoriels";
    $categorie1->resume = $faker->sentence(6, true);
    $categorie1->save();
    
    //création de deux articles de test
    $article = new Article();
    $article->id = 1;
    $article->titre = $faker->sentence(1);
    $article->resume = $faker->sentence(6, true);
    $article->contenu = $faker->sentence(20, true);
    $article->auteur = "Juste Leblanc";
    $article->img = $faker->imageUrl(640, 480, 'cats');
    $article->idCategorie = 1;
    $article->idAuteur = 1;
    $article->publication = 1;
    $article->save();

    $article1 = new Article();
    $article1->id = 2;
    $article1->titre = $faker->sentence(1);
    $article1->resume = $faker->sentence(6, true);
    $article1->contenu = $faker->sentence(20, true);
    $article1->auteur = "Juste Leblanc";
    $article1->img = $faker->imageUrl(640, 480, 'cats');
    $article1->idCategorie = 2;
    $article1->idAuteur = 2;
    $article1->publication = 0;
    $article1->save();
    
}

//méthode qui s'exécute après les tests et qui vide la base de données
public static function tearDownAfterClass(): void
{
   parent::tearDownAfterClass();
    Article::truncate();
    Categorie::truncate();
}

//Test de la méthode getArticles qui récupere les articles publiés
public function testGetArticles(){
    $articleService = new ArticleService();
    $articles = $articleService->getArticles();
    //On test qu'on récupère bien l'article 1
    $this->assertEquals(1, $articles[0]['id']);
    //il n'y a qu'un seul article publié l'article 2 n'est pas publié
    $this->assertEquals(1, count($articles));
}

//Test de la méthode getArticlesAdmin qui récupere tous les articles
public function testGetArticlesAdmin(){
    $articleService = new ArticleService();
    $articles = $articleService->getArticlesAdmin();
    //On test qu'on récupère bien les deux articles
    $this->assertEquals(1, $articles[0]['id']);
    $this->assertEquals(2, $articles[1]['id']);
    $this->assertEquals(2, count($articles));
}

//Test de la méthode getArticle qui récupere les articles d'une catégorie
public function testGetArticlesByCategory(){
    $articleService = new ArticleService();
    //On récupère les articles de la catégorie Actualités qui a un id de 1
    $articles = $articleService->getArticlesByCategory("Actualités");
    //L'article 1 est dans la catégorie Actualités car son idCategorie est égal à 1
    $this->assertEquals(1, $articles[0]['id']);
    //il n'y a qu'un seul article dans la catégorie Actualités car l'article 2 à un idCategorie égal à 2
    $this->assertEquals(1, count($articles));
    //On récupère les articles de la catégorie Tutoriels qui a un id de 2
    $articles2 = $articleService->getArticlesByCategory("Tutoriels");
    //L'article 2 est dans la catégorie Tutoriels car son idCategorie est égal à 2
    $this->assertEquals(2, $articles2[0]['id']);
    //il n'y a qu'un seul article dans la catégorie Tutoriels car l'article 1 à un idCategorie égal à 1
    $this->assertEquals(1, count($articles2));
}

//On test la addArticle qui ajoute un article dans la base de données
public function testAddArticle(){
$articleService = new ArticleService();
//On créer un article avec les bonnes données
    $articles = [
        'titre' => "Test add article",
        'resume' => "Résumé de l'article de test",
        'contenu' => "Contenu de l article de test",
        'auteur' => "Auteur",
        'img' => "img.jpg",
        'categorie' => 1,
        'idAuteur' => 1,
    ];
    //On ajoute l'article
    $articleService->addArticle($articles);
    //On récupère l'article qui à un id incrémenter donc il est supérieur à l'article 2 donc son id est 3
     $this->assertEquals(3,$articleService->getArticlesAdmin()[2]['id']);
}

//On test la méthode getArticleUser qui récupère les articles d'un auteur
public function testGetArticlesUser(){
    $articleService = new ArticleService();
    //On récupère les articles de l'auteur Juste Leblanc
    $articles = $articleService->getArticlesUser("Juste Leblanc");
    //L'article 1 et l'article 2 est écrit par Juste Leblanc
    $this->assertEquals(1, $articles[0]['id']);
    $this->assertEquals(2, $articles[1]['id']);
    //il y a deux articles écrit par Juste Leblanc
    $this->assertEquals(2, count($articles));
}

public function testchangerPubli(){
    $articleService = new ArticleService();
    //On récupère les artciles
    $article = $articleService->getArticlesAdmin();
    //On test que l'article 2 n est pas publié
    $this->assertEquals(0, $article[1]['publication']);
    //On change la publication de l'article 2
    $articleService->changerPubli($article[1]['id'],1);

    $article = $articleService->getArticlesAdmin();
    //On test que l'article 2 est publié
    $this->assertEquals(1, $article[1]['publication']);
}

}