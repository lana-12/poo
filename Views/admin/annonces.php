<?php
$title = 'Les Annonces';


?>


<h1>Liste des Annonces</h1>

<?php
// var_dump($posts); 

use App\Functions\Method;
?>

<!-- <p id=" demo"></p> -->
<table class=" table table-striped">
    <thead>
        <th>ID</th>
        <th>Titre</th>
        <th>Contenu</th>
        <th>Date de création</th>
        <th>Actif</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <?php foreach ($posts as $post) : ?>

            <tr>
                <td><?= $post->id ?></td>
                <td><?= $post->title ?></td>
                <td><?= Method::getWord($post->content, 20); ?></td>
                <td><?= Method::dateFormat($post->created_at);  ?></td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="customSwitch<?= $post->id ?>" <?= $post->active ? "checked" : "";  ?> data-id="<?= $post->id ?>">
                        <label class="form-check-label" for="customSwitch<?= $post->id;  ?>"></label>
                    </div>

                </td>
                <td>
                    <a href="/?p=annonces/modifier/<?= $post->id ?>" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="/?p=admin/supprimerAnnonce/<?= $post->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Etes-vous sûr de vouloir supprimer cette annonce ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    // rajouter un data set sur input =>
    window.onload = () => {
        let btns = document.querySelectorAll('.form-check-input');

        for (let btn of btns) {
            btn.addEventListener('click', activer)
        }

        function activer() {
            let xmlhttp = new XMLHttpRequest;

            xmlhttp.open('GET', '/?p=admin/activerAnnonce/' + this.dataset.id);


            xmlhttp.send();
        }


}
</script>