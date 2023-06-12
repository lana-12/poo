<?php 
$title = "Annonces";

?>


<h1>Liste des Annonces</h1>

<?php 
// var_dump($posts); 

use App\Functions\Method;

foreach($posts as $post) : ?>
    <article>
        <h2><?= $post->title ?></h2>
        <p><?= Method::getWord($post->content, 20) ?><a href ="/?p=annonces/lire/<?= $post->id ?>">Lire la suite</a></p>
        <p><?= Method::dateFormat($post->created_at);  ?></p>
    </article>
<?php endforeach; ?>

