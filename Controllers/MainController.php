<?php

namespace App\Controllers;

use App\Functions\Method;

class MainController extends Controller
{
    public function index(){

        // Method::dump($params);
        echo 'ceci est la page d\'accueil' ;
    }
}