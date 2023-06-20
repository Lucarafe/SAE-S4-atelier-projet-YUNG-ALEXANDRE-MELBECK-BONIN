<?php
namespace MiniPress\test;
use Illuminate\Support\Manager;
use MiniPress\app\models\Article;
use MiniPress\app\models\Categorie;
use MiniPress\app\service\article\ArticleService;
use Illuminate\Database\Capsule\Manager as DB;
use MiniPress\app\service\categorie\CategorieService;
use PHPUnit\Event\Test\AssertionFailed;
use PHPUnit\Framework\TestCase;
require __DIR__."/../src/vendor/autoload.php";
class CategorieServiceTest extends TestCase{

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        //connexion à la base de données de test
        $dataBase = new DB();
        $dataBase->addConnection(parse_ini_file(__DIR__."/../src/conf/test.db.conf.ini"));
        $dataBase->setAsGlobal();
        $dataBase->bootEloquent();
        //utilisation de faker pour génerer des données aléatoires
        $faker = \Faker\Factory::create('fr_FR');
        
        //création de deux catégories de test
        $categorie = new Categorie();
        $categorie->id = 1;
        $categorie->titre = $faker->sentence(1);
        $categorie->resume = $faker->sentence(6, true);
        $categorie->save();

        $categorie1 = new Categorie();
        $categorie1->id = 2;
        $categorie1->titre = $faker->sentence(1);
        $categorie1->resume = $faker->sentence(6, true);
        $categorie1->save();
        
    }

    //méthode qui s'exécute après les tests et qui supprime les articles insérer dans la base de données de test
    public static function tearDownAfterClass(): void
    {
       parent::tearDownAfterClass();
      Categorie::truncate();
    }


//Test de la méthode getCategories 
    public function testGetCategories(){
        $categorieService = new CategorieService();
        //récupération des catégories
        $categories = $categorieService->getCategories();
        //vérification que les catégories sont bien récupérées
        $this->assertEquals(1, $categories[0]['id']);
        $this->assertEquals(2, $categories[1]['id']);
        //vérification que le nombre de catégories est bien de 2
        $this->assertCount(2, $categories);
    }

    //Test de la méthode addCategorie
    public function testAddCategorie(){
        $categorieService = new CategorieService();
        //ajout d'une catégorie
        $categorieService->addCategorie("test", "test");
        //On récupère la catégorie que l'on vient d'ajouter
        $categorie = Categorie::where('titre', 'test')->first();
        //vérification que la catégorie a bien été ajoutée
        $this->assertEquals("test", $categorie->titre);
        $this->assertEquals("test", $categorie->resume);
    }


}