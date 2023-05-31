<?php

namespace App\Controllers;

use App\Models\PostsModel;


class AnnoncesController extends Controller
{
    public function index()
    {
        $postsModel = new PostsModel();
        $posts = $postsModel->findBy(['active' => 1]);
        // var_dump($posts);

        // 1 méthode
        // include_once ROOT.'/Views/annonces/index.php';

        // 2 méthodes
        // $this->render('annonces/index',['posts'=> $posts]);
        
        // 3 méthodes
        $this->render('annonces/index', compact('posts'));
    }


    public function lire(int $id)
    {
        $postModel = new PostsModel();

        $post = $postModel->find($id);

        $this->render('annonces/lire', compact('post'));
    }
}