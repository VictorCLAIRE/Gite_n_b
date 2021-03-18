<?php
//session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title><?= $title ?></title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/styles.css">

    </head>

    <body>
        <header>
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="index.php">Gîte'n'b</a>
                <div class="justify-content-end">

                    <?php
                    if (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] == true){
                    ?>
                        <ul class="navbar-nav">
                            <li class="nav-item active"><a class="nav-link" href="admin.php">Gestion des gites</a></li>
                            <li class="nav-item active"><a class="nav-link" href="booking.php">All booking des gites</a></li>
                            <li class="nav-item active nav-link">ADMIN : <?=$_SESSION['email_admin_logement']?></a></li>
                            <li class="nav-item active"><a class="nav-link" href="deconnexion.php">Déconnexion</a></li>
                        </ul>
                    <?php
                    }elseif (isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] == true){
                    ?>
                        <ul class="navbar-nav">
                            <li class="nav-item active nav-link">USER : <?=$_SESSION['email_user']?></a></li>
                            <li class="nav-item active"><a class="nav-link" href="deconnexion.php">Déconnexion</a></li>
                        </ul>
                    <?php
                    }else{
                    ?>
                        <ul class="navbar-nav">
                            <li class="nav-item active"><a class="nav-link" href="formulaireConnexion.php">Connexion</a></li>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </nav>
        </header>
        <main class="m-3">
            <div>
                <?= $content ?>
            </div>
        </main>


        <!-- Footer-->
        <footer class="footer">
           <div class=""><small>Copyright © Your Website 2020</small></div>
        </footer>

    </body>
</html>
