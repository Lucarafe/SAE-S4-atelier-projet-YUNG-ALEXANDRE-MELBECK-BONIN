<?php
namespace MiniPress\test;
use Illuminate\Support\Manager;
use MiniPress\app\models\Article;
use MiniPress\app\models\Categorie;
use MiniPress\app\models\User;
use MiniPress\app\service\article\ArticleService;
use Illuminate\Database\Capsule\Manager as DB;
use MiniPress\app\service\categorie\CategorieService;
use MiniPress\app\service\user\UserService;
use PHPUnit\Event\Test\AssertionFailed;
use PHPUnit\Framework\TestCase;
require __DIR__."/../src/vendor/autoload.php";

class UserServiceTest extends TestCase{


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

        $user = new User();
        $user->id = 1;
        $user->login = "JusteLeblanc";
        $user->nomUser = "Leblanc";
        $user->prenomUser = "Juste";
        $user->email = "";
        $user->passwd = "";
        $user->save();
        


    }

    public static function tearDownAfterClass(): void
    {
       parent::tearDownAfterClass();
      User::truncate();
    }

    public function testGetUsers(){
        $userService = new UserService();
        $users = $userService->getUsers();
        $this->assertIsArray($users);
        $this->assertEquals(1,$users[0]['id']); 
        $this->assertEquals("Leblanc",$users[0]['nomUser']);
        $this->assertEquals("Juste",$users[0]['prenomUser']);
    }


}