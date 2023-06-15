<?php
namespace MiniPress\app\service\injection;

use MiniPress\app\service\injection\exception\injectionException;

class injection {

    /**
     * Vérifie s'il y a une injection de chaîne de caractères.
     *
     * @param string $string La chaîne de caractères à vérifier
     * @throws InjectionException En cas de détection d'une injection de chaîne de caractères
     * @return void
     */
    function injectionString($string){
        if (!filter_var($string)){
            throw new injectionException();
        }
    }

    /**
     * Vérifie la validité d'une adresse e-mail.
     *
     * @param string $mail L'adresse e-mail à vérifier
     * @return bool True si l'adresse e-mail est valide, False sinon
     */
    function injectionMail($mail){
        return filter_var($mail, FILTER_VALIDATE_EMAIL);
    }
}