<?php
namespace MiniPress\app\service\auth;

use MiniPress\app\models\User;
use MiniPress\app\service\auth\exception\AuthException;
use MiniPress\app\service\auth\exception\loginException;
use MiniPress\app\service\auth\exception\mdpException;

class Auth {

    /**
     * Authentifie l'utilisateur en vérifiant les informations d'identification.
     *
     * @param string $psswrd Le mot de passe saisi
     * @param string $mail L'adresse e-mail de l'utilisateur
     * @throws AuthException Si l'authentification échoue
     * @return void
     */
    function authenticate($psswrd, $mail): void {
        $user = User::where('email', $mail)->first();

        if ($user && password_verify($psswrd, $user->passwd)) {
            $_SESSION['user'] = $user;
        } else {
            throw new AuthException();
        }
    }

    /**
     * Vérifie la force du mot de passe.
     *
     * @param string $pass Le mot de passe à vérifier
     * @param int $minimumLength La longueur minimale requise pour le mot de passe
     * @return bool True si le mot de passe est suffisamment fort, False sinon
     */
    static function checkPasswordStrength(string $pass, int $minimumLength): bool {
        $length = (strlen($pass) < $minimumLength); // longueur minimale
        $digit = preg_match("#[\d]#", $pass); // au moins un digit
        $lower = preg_match("#[a-z]#", $pass); // au moins une minuscule
        $upper = preg_match("#[A-Z]#", $pass); // au moins une majuscule
        if ($length || !$digit || !$lower || !$upper) return false;
        return true;
    }

    /**
     * Enregistre un nouvel utilisateur.
     *
     * @param string $email L'adresse e-mail de l'utilisateur
     * @param string $mdp1 Le premier mot de passe saisi
     * @param string $mdp2 Le deuxième mot de passe saisi
     * @param string $login Le login de l'utilisateur
     * @throws mdpException Si les mots de passe ne correspondent pas ou ne sont pas suffisamment forts
     * @throws loginException Si le login est déjà utilisé par un autre utilisateur
     * @return void
     */
    function register($email, string $mdp1, string $mdp2, $login): void
    {
        if($mdp1 != $mdp2 || !self::checkPasswordStrength($mdp1, 8)){
            throw new mdpException();
        } else if (!$this->dejaPresent($email)){
            if($this->LoginPresent($login)) throw new loginException();
            $user = new User();

            $user->login = $login;
            $user->passwd = password_hash($mdp1, PASSWORD_DEFAULT, ['cost' => 12]);
            $user->email = $email;

            $user->save();
        }
    }

    /**
     * Vérifie si l'adresse e-mail est déjà utilisée par un utilisateur existant.
     *
     * @param string $email L'adresse e-mail à vérifier
     * @return bool True si l'adresse e-mail existe déjà, False sinon
     */
    private function dejaPresent($email) {
        return User::where('email', $email)->exists();
    }

    /**
     * Vérifie si le login est déjà utilisé par un autre utilisateur.
     *
     * @param string $log Le login à vérifier
     * @return bool True si le login existe déjà, False sinon
     */
    private function LoginPresent($log) {
        return User::where('login', $log)->exists();
    }
}