<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="/styles/style.css"> -->

    <!-- <title>La POO</title> -->
    <!-- ?? = si null -->
    <title><?= $title ?? "POO" ?></title>
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">POO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/?p=annonces">Liste des Annonces</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">

                        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['id']) ) : ?>

                            <li class="nav-item">
                                <a class="nav-link" href="/?p=users/login/profil">Mon Espace</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/?p=users/logout">Déconnexion</a>
                            </li>

                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/?p=users/login">Connexion</a>
                            </li>

                        <?php endif ?>
                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <?= $content ?>
        </div>
    </main>


    <hr class="separator">
    <footer class="container-fluid col-12 footerContact  ">
        <div class="row">
            <div class="col-12 ">
                <p class="text-center copyright">Copyright @ 2023 All rights reserved by :
                    <a href="mailto:giacomettivirginie@gmail.com" alt="Contactez-moi par mail" title="Contactez-moi par mail"><strong>Virginie Giacometti</strong></a>
                </p>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="/javascript/script.js"></script> -->

</body>

</html>