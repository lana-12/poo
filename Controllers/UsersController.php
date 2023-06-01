<?php

namespace App\Controllers;

use App\Core\Form;
use App\Functions\Method;
use App\Models\Model;
use App\Models\UsersModel;

class UsersController extends Controller
{
    /**
     * Connexion User
     *
     * @return void
     */
    public function login()
    {
        //Vérification si form est complet
        if(Form::validate($_POST, ['email', 'password'])){
            //Form est vérifié
            //Récupérer le user avec son email
            $usersModel = new UsersModel();

            $userArray = $usersModel->findOneByEmail(strip_tags($_POST['email']));

            //Vérification
            if(!$userArray){
                $_SESSION['error']= 'L\'adresse e-mail et/ou le Mot de passe est incorrect';
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }

            // User existe
            $user = $usersModel->hydrate($userArray);
            
            //Verification Password est ok
            if(password_verify($_POST['password'], $user->getPassword()) ){
                //Pass est bon 
                $user->setSession();
                header('Location: /');
                exit;
            } else {
                //Mauvais mot de pass
                $_SESSION['error']= 'L\'adresse e-mail et/ou le Mot de passe est incorrect';
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
            
        }

        $form = new Form();

        $form
            ->startForm()
            ->addLabelFor('email', 'E-mail :')
            ->addInput('email', 'email', ['id'=>'email', 'class'=> 'form-control'])

            ->addLabelFor('password', 'Mot de passe :')
            ->addInput('password', 'password', ['id'=> 'password', 'class'=> 'form-control'])

            ->addButton('submit','Me connecter', ['class'=> 'btn btn-primary'])
            ->endForm();

            // var_dump($form); // voir dans la console
            //echo $form->create();

            $this->render('users/login', ['loginForm'=> $form->create()]);
    }

    /**
     * Inscription User
     *
     * @return void
     */
    public function register()
    {
        //On peut vérifier si qqle chose a été envoyé
        // Method::dump($_POST);

        
        //Vérification si formulaire est valide
        if(Form::validate($_POST, ['email', 'password'])){
            //echo 'valide'; // Le form est valide

            //Nettoyer email
            $email = strip_tags($_POST['email']);

            //Verifier si email existe + format



            //Verifier si MDP a bien le format

            //Crypter le MDP
            $pass= password_hash($_POST['password'], PASSWORD_BCRYPT);

            // echo $pass;
            
            //Hydrater objet
            $user = new UsersModel();

            if(Form::emailUnique($user, $email)){
                // E-mail existe
                // Method::dump('existeeeee');
                $_SESSION['error'] = 'Cet email existe déjà, Veuillez saisir un autre e-mail';
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
        
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    // Method::dump('errorFormat');

                    $_SESSION['errorFormat'] = 'L\'adresse email est incorrecte';
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit;
                } 

            // E-mail n'existe pas
            $user
                ->setEmail($email)
                ->setPassword($pass);

            // Method::dump($user);
            
            // Enregistrer User
            $user->create();

                
            // }
        } 

        //Faire le form en premier
        $form = new Form();

        $form
            ->startForm()
            ->addLabelFor('email', 'Email :')
            ->addInput('email', 'email', ['id'=>'email', 'class'=>'form-control'])

            ->addLabelFor('password', 'Mot de passe :')
            ->addInput('password', 'password', ['id'=>'password', 'class'=>'form-control'])

            ->addButton('submit', 'M\'inscrire', ['class' => 'btn btn-primary'])
            ->endForm();

// Method::dump($form);

        $this->render('users/register', ['registerForm'=> $form->create()]);
    }

    /**
     * Déconnexion de user
     *
     * @return void
     */
    public function logout()
    {
        if(isset($_SESSION['user'])){
            //On supp la session['user']
            unset($_SESSION['user']);

        // Redirection
        // Soit vers home
            // header("Location: /");

        // Soit user reste sur la même page
            header("Location: ".$_SERVER['HTTP_REFERER']);
            
        exit;
        }
    }
}