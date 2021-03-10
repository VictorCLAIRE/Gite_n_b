<?php

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title><?= $title ?></title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>

    <body>
        <header>
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <a class="navbar-brand" href="index.php">Gîte'n'b</a>
                    <div class="collapse navbar-collapse"" id="">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active"><a class="nav-link" href="#">Connexion utilisateur</a></li>
                            <li class="nav-item active"><a class="nav-link" href="admin.php">Connexion admin</a></li>
                            <li class="nav-item active"><a class="nav-link" href="#contact">Contact</a></li>
                        </ul>
                    </div>
            </nav>
        </header>
        <main class="m-3">
            <div>
                <?= $content ?>
            </div>
        </main>


        <!-- Footer-->
        <footer class="">
           <div class=""><small>Copyright © Your Website 2020</small></div>
        </footer>

    </body>
</html>
