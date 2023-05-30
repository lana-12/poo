<?php

use App\Autoloader;
use App\Core\Main;

//Définir une const contenant le dossier racine du projet, le chemin d'accès
define('ROOT', dirname(__DIR__));

//Importer l'autoloader
require_once ROOT.'/Autoloader.php';
// require_once 'Autoloader.php';
Autoloader::register();

//Instancie une class main (notre router)
$app = new Main();

//On démarre l'application
$app->start();