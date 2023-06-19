<?php

namespace App\Controllers;

use App\Core\Form;
use App\Core\Validate;
use App\Functions\Method;
use App\Models\PostsModel;
use App\Models\PostLikesModel;


class AnnoncesController extends Controller
{
    public function index()
    {
        $postsModel = new PostsModel();
        $posts = $postsModel->findBy(['active' => 1]);
        // var_dump($posts);

        
        $likeModel = new PostLikesModel();
        
        // $likes = $postModel->count();

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

    public function ajouter()
    {
        //Vérification si connecté
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
            //User est connecté

            //Traiter le form
            //Vérification si champ pas vide
            if(Validate::validate($_POST, ['title', 'content'])){
                //Form est complet
                //Protection contre faille XSS
                //strip_tags, htmlentities, htmlspecialchar
                $title = strip_tags($_POST['title']);
                $content = strip_tags($_POST['content']);
            
                //Instancie notre objet
                $post = new PostsModel();
                // Hydratation
                $post
                    ->setTitle($title)
                    ->setContent($content)
                    ->setUser_id($_SESSION['user']['id'])
                    ->setActive(false);

                $post->create();

                //Redirection + message
                $_SESSION['success'] = 'Votre annonce a été enregistrée avec succès';
                header('Location: /');
                exit;

            } else{
                //Formulaire est incomplet
                // Si manque un champ et envoyer => message error mais les données saisies sont tjs là
                $_SESSION['error'] = !empty($_POST) ? 'Le formulaire est incomplet' : '';
                $title = isset($_POST['title']) ? strip_tags($_POST['title']) : '';
                $content = isset($_POST['content']) ? strip_tags($_POST['content']) : '';

            }
        

            //Create form add post
            $form = new Form;
            $form
                ->startForm()
                ->addLabelFor('title', 'Titre :')
                ->addInput('text', 'title', [
                    'id'=> 'title', 
                    'class'=> 'form-control',
                    'value' => $title
                ])

                ->addLabelFor('content', 'Description :')
                ->addTextArea('content', $content , [
                    'id'=> 'content', 
                    'class'=> 'form-control'
                ])

                ->addButton('submit', 'Enregistrer', ['class'=> 'btn btn-primary'])

                ->endForm();    

            // Method::dump($form);
            $this->render('annonces/ajouter', ['addPostForm'=> $form->create()]);

        } else {
            //User pas connecté
            $_SESSION['error'] = 'Vous devez être connecté(e) pour accéder à cette page';
            header('Location: /?p=users/login');
            exit;
        }
    }

    public function modifier(int $id)
    {
        // echo 'modifier';
        //Vérification si connecté
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){

            //Verifier si annonce existe
            $postsModel = new PostsModel();

            //Récupère id
            $post = $postsModel->find($id);

            //Verification Si annonce n'existe pas + redirection liste annonce
            if(!$post){
                http_response_code(404);
                $_SESSION['error'] = 'L\'annonce recherchée n\'existe pas';
                header('Location: /?p=annonces');
                exit;
            }

            //Vérification si user est propriétaire de l'annonce et donner accès à Admin
            if($post->users_id !== $_SESSION['user']['id'] ){
                if(!in_array("ROLE_ADMIN", $_SESSION['user']['roles'])) {
                    $_SESSION['error'] = 'Vous n\'avez pas accès à cette page';
                    header('Location: /?p=annonces');
                    exit;
                }
            }
            //Traite le formulaire ici
            if(Validate::validate($_POST, ['title', 'content'])){
                //Protection des failles xss
                $title = strip_tags($_POST['title']);
                $content = strip_tags($_POST['content']);

                //Stocker l'annonce
                $postModif = new PostsModel();
                $postModif
                    ->setId($post->id)
                    ->setTitle($title)
                    ->setContent($content)
                ;
                $postModif->update($post->id);

                //Redirection + message
                $_SESSION['success'] = 'Votre annonce a été modifiée avec succès';
                header('Location: /?p=annonces/lire/'.$post->id);
                exit;
            }


            $form = new Form;
            $form
                ->startForm()
                ->addLabelFor('title', 'Titre :')
                ->addInput('text', 'title', [
                    'id' => 'title', 
                    'class' => 'form-control',
                    'value' => $post->title
                ])

                ->addLabelFor('content', 'Description :')
                ->addTextArea('content', $post->content, [
                    'id' => 'content', 
                    'class' => 'form-control'
                ])

                ->addButton('submit', 'Modifier', ['class' => 'btn btn-primary'])

                ->endForm();
            
            $this->render('annonces/modifier', ['updatePostForm' => $form->create()]);

        } else {
            //User pas connecté
            $_SESSION['error'] = 'Vous devez être connecté(e) pour accéder à cette page';
            header('Location: /?p=users/login');
            exit;
        }
    }

}