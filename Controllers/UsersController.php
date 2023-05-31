<?php

namespace App\Controllers;

use App\Core\Form;

class UsersController extends Controller
{
    public function login()
    {
        $form = new Form();


        $form->startForm()
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
}