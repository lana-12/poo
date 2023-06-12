<?php

namespace App\Controllers;

use App\Functions\Method;
use App\Models\PostsModel;
use App\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        // Method::dump($_SESSION); 
        //Vérifier si admin
        if($this->isAdmin()){
            // echo 'Admin';
            return $this->render('admin/index', [], 'admin');
        }
    }

/**
 * Display list post in array
 *
 * @return void
 */
    public function annonces()
    {
        if($this->isAdmin()){
            //Display all posts
            $postsModel = new PostsModel();
            $posts = $postsModel->findAll();
            // $posts = $postsModel->findBy(['active' => 1]);

            // method::dump($posts);
            $this->render('admin/annonces', compact('posts'), 'admin');
        }
    }

/**
 * Undocumented function
 *
 * @param integer $id
 * @return void
 */
    public function supprimerAnnonce(int $id)
    {
        if ($this->isAdmin()) {
            $post = new PostsModel();
            $post->delete($id);
            //Redirection + message
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $_SESSION['success'] = 'Votre annonce a été supprimé avec succès';
        }
    }

    /**
     * Activer ou désactivé une Annonce
     *
     * @param integer $id
     * @return void
     */
    public function activerAnnonce(int $id)
    {
        if ($this->isAdmin()) {
            $postsModel = new PostsModel();

            $postArray = $postsModel->find($id);

            //Vérifier si récupère un array
            if($postArray){
                $post = $postsModel->hydrate($postArray);

                $post->setActive($post->getActive() ? 0 : 1);

                $post->update($id);
            }


            //Redirection + message
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $_SESSION['success'] = 'Votre annonce a été supprimé avec succès';
        }
    }


    private function isAdmin()
    {
        //Vérifie si connecté et si admin
        if(isset($_SESSION['user']) && in_array("ROLE_ADMIN", $_SESSION['user']['roles'])){
            return true;
        } else{
            $_SESSION['error'] = 'Vous n\'avez pas accès à cette zone';
            header("Location: /");
            exit;

        }
    }


}