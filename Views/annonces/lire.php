<?php
$title = $post->title;
use App\Functions\Method;

?>
<article>
    <h2><?= $post->title ?></h2>
    <p><?= Method::dateFormat($post->created_at);  ?></p>
    <p><?= $post->content ?></p>
</article>