<?php

namespace App\Core;

use App\Controllers\MainController;
use App\Functions\Method;

class Main 
{
    public function start()
    {
        // echo'C\'est ok';

        // https//mon-site.test/controller/method/parametres
        // https//mon-site.test/annonces/details/brouette
        // Réécrire les url
            // https//mon-site.test/index.php?p=annonces/details/brouette

    // $_GET affiche rien mais ds network il y a l'url
    //Solution trouvé pour continuer le tuto => Ecrire ds URL
    // http://localhost:8000/?p=annonce/ppolo
    // Method::dump($_GET);
//POUR CHAQUE DUMP FAIRE DES TESTS AVEC URL
    //Eviter le duplicate content
    //Retirer le trailing slash éventuel sur url
    // Récupère l'url
        $uri = $_SERVER['REQUEST_URI'];
        // Method::dump($uri);
        // Method::dump($_SERVER);

        // //Vérification que uri n'est pas vide et se termine pas un slash
        if(!empty($uri) && $uri != '/' && $uri[-1] === "/"){
            // Enlever le "/"
            $uri = substr($uri, 0, -1);

            //Envoie un code de redirection permanente
            http_response_code(301);

            //Redirection vers URL sans /
            header('Location: '.$uri);
        }
    
    //Gérer les paramètres p=controller/method/parametre
    //Séparer les parametres ds un array
    // Le premier params = Controller
    // Les suivants = Method du controller
    $params = [];
    if(isset($_GET['p'])){
        $params = explode('/', $_GET['p']);
        // Method::dump($params);
    }    

    //Verif si au moins 1 params
    if(isset($params[0]) != ""){
        // Method::dump($params);
            // die;

       //Démonter le array

       //Récuperer le nom du controller à instancier c'est le premier parametre
       //Namespace complet + Mettre Maj la première Lettre + ajouter Controller 
        //Retirer le 1 index ->array_shift
        $controller = "\\App\\Controllers\\".ucfirst(array_shift($params)).'Controller';
        // Method::dump($controller);die;
        // Method::dump($params);die; //=> display array mais index[0] est enlevé

        //Vérifier si Controller existe

    // Instancie le controleur
        $controller = new $controller();

        //Si encore des params appeller la methode sinon methode index
        $action = (isset($params[0])) ? array_shift($params) : 'index';

        //Vérification si method existe
        if(method_exists($controller, $action)){
            // Verifier s'il reste des params on les passe à la method
            (isset($params[0])) ? $controller->$action($params) : $controller->$action();
        }else{
            http_response_code(404);
            echo "La page recherchée n'existe pas";
        }

    }else{
        //Si pas de params on instancie le Controller par default
        $controller = new MainController();

        //Appel la method du controller
        $controller->index();
    }

    

    }
}