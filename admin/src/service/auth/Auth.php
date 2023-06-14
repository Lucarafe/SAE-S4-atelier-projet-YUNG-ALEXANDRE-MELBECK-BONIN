<?php
namespace MiniPress\app\service\auth;

use MiniPress\app\models\User;
use MiniPress\app\service\auth\exception\AuthException;
use MiniPress\app\service\auth\exception\mdpException;

class Auth {
    /**
     * @throws AuthException
     */
    function authenticate($psswrd, $mail): void {
        $user = User::where('email', $mail)->first();

        if ($user && password_verify($psswrd, $user->passwd)) {
            $_SESSION['user'] = $user;
        } else {
            throw new AuthException();
        }
    }


    static function checkPasswordStrength(string $pass, int $minimumLength): bool {
        $length = (strlen($pass) < $minimumLength); // longueur minimale
        $digit = preg_match("#[\d]#", $pass); // au moins un digit
        $lower = preg_match("#[a-z]#", $pass); // au moins une minuscule
        $upper = preg_match("#[A-Z]#", $pass); // au moins une majuscule
        if ($length || !$digit || !$lower || !$upper) return false;
        return true;
    }

    /**
     * @throws mdpException
     */
    function register($email, string $mdp1, string $mdp2, $login = "", $nom = "", $prenom = "", $tel = ""): void
    {
        if($mdp1 != $mdp2 || !self::checkPasswordStrength($mdp1, 8)){
            throw new mdpException();
        } else if (!$this->dejaPresent($email)){
            $user = new User();

            $user->login = $login;
            $user->passwd = password_hash($mdp1, PASSWORD_DEFAULT, ['cost' => 12]);
            $user->email = $email;
            $user->nomUser = $nom;
            $user->prenomUser = $prenom;
            $user->tel = $tel;

            $user->save();
        }
    }

    private function dejaPresent($email) {
        return User::where('email', $email)->exists();
    }
}