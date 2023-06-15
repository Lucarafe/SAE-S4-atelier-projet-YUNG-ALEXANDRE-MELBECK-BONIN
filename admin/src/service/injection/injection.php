<?php
namespace MiniPress\app\service\injection;

use MiniPress\app\service\injection\exception\injectionException;

class injection {
    /**
     * @throws injectionException
     */
    function injectionString($string){
        if (!filter_var($string)){
            throw new injectionException();
        }
    }

    function injectionMail($mail){
        return filter_var($mail, FILTER_VALIDATE_EMAIL);
    }
}