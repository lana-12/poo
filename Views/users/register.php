<?php
$title = 'S\'inscrire';

if (!empty($_SESSION['error'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error'];
        unset($_SESSION['error']); ?>
    </div>
<?php endif; 
if (!empty($_SESSION['errorFormat'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['errorFormat'];
        unset($_SESSION['errorFormat']); ?>
    </div>
<?php endif; 

?>

<h1>Inscription</h1>

<?= $registerForm ?>
<a href="./?p=users/login">Déjà inscrit - Me connecter</a>