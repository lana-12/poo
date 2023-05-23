<?php
function dump($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
}

require_once 'class/Compte.php';


//On instancie 
$compte1 = new Compte('Vivi', 500);
$compte1->deposer(20);
$compte1->retirer(600);
dump($compte1);
$compte1->voirSolde();
//Déposer de l'argent