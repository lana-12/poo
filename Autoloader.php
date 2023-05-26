<?php

namespace App;

class Autoloader
{
    static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class)
    {
        //Retirer App\
        $class = str_replace(__NAMESPACE__.'\\', '', $class);

        //Remplacement des \ par des /
        $class = str_replace('\\', '/', $class);

        // Vérification si file_exists + création du chemin
        $file = __DIR__ . '/' . $class . '.php';

        if(file_exists($file)){
            require_once $file;
        } else {
            echo'oups';
            // die; // permet de ne rien afficher pour eviter les erreurs.
        }

    }
}