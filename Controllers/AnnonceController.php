<?php

namespace App\Controllers;

use App\Models\PostsModel;

class AnnonceController extends Controller
{
    public function index()
    {
        $posts = new PostsModel;
        $posts->findAll();
        
        $datas = ["a, b, c"];
        include_once ROOT.'/Views/annonces/index.php';
    }


}