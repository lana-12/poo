<?php

namespace App\Controllers;


/**
 * Controller principal comme Model.php
 * Sera hériter ds tous les controllers
 */
abstract class Controller 
{
    // protected $template = 'default';

    // ou 
    public function render(string $file, array $datas = [], $template = 'default')
    // public function render(string $file, array $datas = [])
    {
        // var_dump($datas);
        // var_dump($annonces);
        // Extraire le contenu de $datas
        extract($datas);
        // var_dump($annonces);

        // Démarrer le buffer de sortie => toute les données seront transmise à $content pour le mettre ds le "block content"
        // "block content"
        ob_start();

        // A partir d'ici toute sortie est conservée en mémoire 
        // echo "bonjour"; //rafraichir;

        // Création du chemin vers la vue
        require_once ROOT.'/Views/'.$file.'.php';
        
        // Transfert les datas ds le buffer
        // Ce qui se trouve ente ob_start et ob_get_clean est sauvegardé
        $content = ob_get_clean();

        //Template de la page
        // require_once ROOT.'/Views/'.$this->template.'.php';
        require_once ROOT.'/Views/'.$template.'.php';
    }
}