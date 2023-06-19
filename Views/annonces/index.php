<?php
$title = "Annonces";

?>


<h1>Liste des Annonces</h1>

<?php
// var_dump($posts); 

use App\Functions\Method;

foreach ($posts as $post) : ?>
    <article>
        <h2><?= $post->title ?> <?= $post->id ?></h2>
        <p><?= Method::getWord($post->content, 20) ?><a href="/?p=annonces/lire/<?= $post->id ?>">Lire la suite</a></p>
        <p><?= Method::dateFormat($post->created_at);  ?></p>

        <div class=" ">
            <a href="#" clas="btn btn-link">
                <i class="far fa-thumbs-up"></i>
                <span class="js-likes"><?= $post->like_count ?></span>
                <span class="js-label">j'aime</span>
            </a>

            <a href="#" clas="btn btn-link">
                <i class="far fa-thumbs-down"></i>
                <span class="js-Dislikes"><?= $post->dislike_count ?></span>
                <span class="js-label">je n'aime pas</span>
            </a>
        </div>
    </article>
<?php endforeach; ?>