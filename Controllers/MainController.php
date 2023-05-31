<?php

namespace App\Controllers;

use App\Functions\Method;

/**
 * Page Home
 */
class MainController extends Controller
{
    public function index(){

        // Pour les tests start
        // Method::dump($params);
        // echo 'ceci est la page d\'accueil' ;
        // end

        $this->render('main/index');
        // $this->render('main/index', [], 'home');
    }
}