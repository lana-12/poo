<?php

use App\Autoloader;
use App\Functions\Method;
use App\Models\PostsModel;
use App\Models\UsersModel;

// function dump($variable)
// {
//     echo '<pre>';
//     var_dump($variable);
//     echo '</pre>';
// }

//Importer le autoloader
require_once 'Autoloader.php';
Autoloader::register();


$model = new PostsModel;

// Method::dump($model->findAll());
// Method::dump($model->findBy(['id'=> 2]));
// Method::dump($model->find(2));


//Insertion d'un array par hydratation, par exemple en POST
// $datas=[
//     'title' => 'Ma Maison',
//     'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla, blanditiis dignissimos! Obcaecati repellat illum nisi rem non at, vitae explicabo officia quae enim sapiente odio iure dolorum, velit perspiciatis saepe?',
//     'active'=> 0,
// ];
// $post = $model->hydrate($datas);
// $model->create($post);

// Insertation avec methode create
$post = $model
    ->setTitle('Mon Jardin Modifié')
    ->setContent('Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla, blanditiis dignissimos! Obcaecati repellat illum nisi rem non at, vitae explicabo officia quae enim sapiente odio iure dolorum, velit perspiciatis saepe?')
    ->setActive(1);

$model->create($post);
$model->update(7, $post);
$model->delete(7);

Method::dump($post);

$modelUser = new UsersModel();
$user = $modelUser
    ->setEmail('exemple@exemple.fr')
    ->setPassword(password_hash('exemple', PASSWORD_BCRYPT))
    //ou
    ->setPassword(password_hash('exemple', PASSWORD_ARGON2I))
    ->setLastname('Vivi');

$modelUser->create($user);
Method::dump($user);

