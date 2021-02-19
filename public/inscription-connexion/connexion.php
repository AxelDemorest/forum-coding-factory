<?php session_start();

require_once '../../database/db.php'; 

if (!empty($_POST)) {

    $errors = array();

    $valid = true;

    if (isset($_POST['formConnexionSubmit'])) {

        $identifiant  = htmlspecialchars(trim($_POST['userId']));
        $password = trim($_POST['password']); // On récupère le password

        if (empty($identifiant)) {
            $errors['identifiant'] = "l'identifiant est incorrect.";
            $valid = false;
        }

        if (empty($password)) {
            $errors['password'] = "Le mot de passe est incorrect.";
            $valid = false;
        }

        if ($valid) {

            $req = $pdo->prepare('SELECT * FROM users WHERE mail = :username OR pseudo = :username');

            $req->execute(['username' => $identifiant]);

            $result = $req->fetch();

            if (empty($result)) {

                $errors['error'] = "Utilisateur ou mot de passe incorrect.";
            } else {

                if (password_verify($password, $result->password)) {

                    $_SESSION['auth'] = $result;

                    header('Location: /forum-coding-factory/public/home/home.php');
                } else {

                    $errors['bddPassword'] = "Utilisateur ou mot de passe incorrect.";
                }
            }
        }
    }
}

if (isset($_SESSION['auth'])) : ?>

    <?php header('Location: /forum-coding-factory/public/account/account.php') ?>

<?php else : ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="connexion.css" rel="stylesheet" />
        <link href="../header/header.css" rel="stylesheet" />
        <link href="../footer/footer.css" rel="stylesheet" />
        <title>Forum - Coding factory</title>
    </head>

    <body class="bg-light">

        <!-- Navbar -->

        <?php

        include "../header/header.php";

        ?>

        <!-- Body -->
        <div class="container-fluid bg-light pb-5 mt-5">
            <div class="row d-flex flex-column align-items-center">
                <div class="col-8">
                    <h1 class="pb-3 text-center">Se connecter</h1>
                    <form method="POST" class="fz-text p-4">
                        <?php if (!empty($errors)) : ?>
                            <div class="alert alert-danger pb-0">
                                <ul>

                                    <?php foreach ($errors as $error) : ?>

                                        <li><?= $error; ?></li>

                                    <?php endforeach; ?>

                                </ul>
                            </div>

                        <?php endif; ?>
                        <div class="mb-3 bg-white rounded border border-2 shadow-sm p-4">
                            <label for="exampleInputEmail1" class="form-label text-muted text-uppercase" style="font-size:12px;opacity:0.5">Email ou nom d'utilisateur</label>
                            <input name="userId" type="text" class="form-control" id="exampleInputEmail1" placeholder="Email ou nom d'utilisateur" value="<?php if (isset($_POST['userId'])) {
                                                                                                                                                                echo $_POST['userId'];
                                                                                                                                                            } ?>" aria-describedby="identifiantHelp" required>
                        </div>
                        <div class="mb-3 bg-white rounded border border-2 shadow-sm p-4">
                            <label for="exampleInputPassword1" class="form-label text-muted text-uppercase" style="font-size:12px;opacity:0.5">Mot de passe</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" aria-describedby="passwordHelp" required>
                            <div id="passwordHelp" class="form-text text-muted mt-3"><a href="">
                                    Mot de passe oublié ?
                                </a></div>
                        </div>
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" disabled>
                            <label class="form-check-label" for="disabledFieldsetCheck">
                                Se rappeler de moi (non-fonctionnel)
                            </label>
                        </div>
                        <input name="formConnexionSubmit" type="submit" class="btn btn-danger" value="Se connecter">
                    </form>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>

    </html>