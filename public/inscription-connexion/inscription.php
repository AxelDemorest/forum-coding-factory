    <!-- Traitement du formulaire en php -->
    <?php

    if (isset($_SESSION['auth'])) {

        header('Location: /forum-coding-factory/public/account/account.php');

        exit;
    }

    if (!empty($_POST)) {

        require_once '../../database/db.php';

        $errors = array();

        $valid = true;

        if (isset($_POST['formSubmit'])) {

            $pseudo  = htmlspecialchars(trim($_POST['pseudo'])); // On récupère le nom
            $mail = htmlspecialchars(strtolower(trim($_POST['email']))); // On récupère le mail
            $password = trim($_POST['password']); // On récupère le mot de passe 
            $confirmPassword = trim($_POST['confirmPassword']); //  On récupère la confirmation du mot de passe
            $age = $_POST['age']; //  On récupère l'âge
            $position = $_POST['position']; //  On récupère la position
            $status = $_POST['status']; //  On récupère le statut
            $nom = $_POST['nom']; //  On récupère le nom
            $prenom = $_POST['prenom']; //  On récupère le prénom

            // On vérifie le nom d'utilisateur
            if ((empty($pseudo) || !preg_match('/^[a-zA-Z0-9_]{3,16}$/', $pseudo))) {
                $errors['pseudo'] = "Le nom d'utilisateur est incorrect.";
                $valid = false;
            } else {

                $req = $pdo->prepare('SELECT id FROM users WHERE pseudo = ?');

                $req->execute([$pseudo]);

                $user = $req->fetch();

                if ($user) {
                    $errors['usePseudo'] = 'Ce nom d\'utilisateur est déjà utilisé.';
                    $valid = false;
                }
            }

            // On vérifie l'adresse email
            if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $errors['mail'] = "L'email est incorrect.";
                $valid = false;
            } else {

                $req = $pdo->prepare('SELECT id FROM users WHERE mail = ?');

                $req->execute([$mail]);

                $user = $req->fetch();

                if ($user) {
                    $errors['useEmail'] = 'Cet email est déjà utilisé.';
                    $valid = false;
                }
            }

            // On vérifie le mot de passe et le mot de passe de confirmation
            if (empty($password)) {
                $errors['password'] = "Le mot de passe est incorrect.";
                $valid = false;
            } else {

                if (empty($confirmPassword)) {
                    $errors['emptyConfirmPassword'] = "La confirmation du mot de passe est incorrect.";
                    $valid = false;
                } else {
                    if ($password != $confirmPassword) {
                        $errors['confirmPassword'] = "Les deux mots de passe sont différents.";
                        $valid = false;
                    }
                }
            }

            // On vérifie l'âge
            if (empty($age)) {
                $errors['age'] = "L'âge est incorrect.";
                $valid = false;
            }

            // On vérifie la position
            if (empty($position)) {
                $errors['position'] = "Le choix de l'école est incorrect.";
                $valid = false;
            }

            // On vérifie le status
            if (empty($status)) {
                $errors['status'] = "Le choix du statut est incorrect.";
                $valid = false;
            }

            // On vérifie le nom
            if (empty($nom)) {
                $errors['nom'] = "Le nom est incorrect.";
                $valid = false;
            }

            // On vérifie le prénom
            if (empty($prenom)) {
                $errors['prenom'] = "Le prénom est incorrect.";
                $valid = false;
            }

            // Si $valid = true, on envoie tout dans la base de donnée
            if ($valid && empty($errors)) {

                $req = $pdo->prepare("
                        INSERT INTO users(nom,prenom,pseudo,mail,password,age,position,status,rank)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
                    ");

                $password = password_hash($password, PASSWORD_BCRYPT);

                $req->execute([$nom, $prenom, $pseudo, $mail, $password, $age, $position, $status, 0]);

                $req2 = $pdo->prepare("SELECT * FROM users WHERE mail = ?");

                $req2->execute(array($mail));

                $userConnexion = $req2->fetch();

                $_SESSION['auth'] = $userConnexion;

                header('Location: /forum-coding-factory/public/home/home.php');

                exit;
            }
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="inscription.css" rel="stylesheet" />
        <link href="../header/header.css" rel="stylesheet" />
        <link href="../footer/footer.css" rel="stylesheet" />
        <title>Forum - Coding factory</title>
        <style>
            #demo {
                color: #495057;
                background-color: #fff;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
                padding: 5px 10px;
                margin-left: 5px;
            }

            #customRange2::-webkit-slider-thumb {
                background-color: #dc3545;
            }

            #customRadioInline1:checked~.custom-control-label::before,
            #customRadioInline2:checked~.custom-control-label::before {
                background-color: #dc3545;
            }

            #customRadioInline1:focus~.custom-control-label::before,
            #customRadioInline2:focus~.custom-control-label::before {
                box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
                border: none;
            }
        </style>
    </head>

    <body class="bg-light">

        <!-- Navbar -->
        <?php session_start();

        include "../header/header.php"; ?>

        <!-- Body -->
        <div class="container-fluid bg-light pb-5 mt-5">
            <div class="row d-flex flex-column align-items-center">
                <div class="col-8">
                    <h1 class="pb-3 text-center">S'inscrire</h1>
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
                        <!-- Nom -->
                        <div class="mb-3 bg-white rounded border border-2 shadow-sm p-4">
                            <label for="nomUser" class="form-label text-muted text-uppercase" style="font-size:12px;opacity:0.5">Nom de famille</label>
                            <input name="nom" type="text" class="form-control" id="nomUser" value="<?php if (isset($_POST['nom'])) {
                                                                                                        echo $_POST['nom'];
                                                                                                    } ?>" required>
                        </div>

                        <!-- Prénom -->
                        <div class="mb-3 bg-white rounded border border-2 shadow-sm p-4">
                            <label for="prenomUser" class="form-label text-muted text-uppercase" style="font-size:12px;opacity:0.5">Prénom</label>
                            <input name="prenom" type="text" class="form-control" id="prenomUser" value="<?php if (isset($_POST['prenom'])) {
                                                                                                                echo $_POST['prenom'];
                                                                                                            } ?>" required>
                        </div>


                        <!-- Pseudo -->
                        <div class="mb-3 bg-white rounded border border-2 shadow-sm p-4">
                            <label for="pseudoUser" class="form-label text-muted text-uppercase" style="font-size:12px;opacity:0.5">Nom d'utilisateur</label>
                            <input name="pseudo" type="text" class="form-control" pattern="^[a-zA-Z0-9_]{3,16}$" id="pseudoUser" value="<?php if (isset($_POST['pseudo'])) {
                                                                                                                                            echo $_POST['pseudo'];
                                                                                                                                        } ?>" aria-describedby="pseudoHelp" required>
                            <div id="pseudoHelp" class="form-text text-muted">
                                Le nom d'utilisateur ne doit pas contenir de caractères spéciaux. Il doit être compris entre 3 et 16 caractères.
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3 bg-white rounded border border-2 shadow-sm p-4">
                            <label for="exampleInputEmail1" class="form-label text-muted text-uppercase" style="font-size:12px;opacity:0.5">Email</label>
                            <input name="email" type="email" class="form-control" pattern="^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$" value="<?php if (isset($_POST['email'])) {
                                                                                                                                                                                                echo $_POST['email'];
                                                                                                                                                                                            } ?>" id="exampleInputEmail1" placeholder="name@example.com" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text text-muted">
                                Exemple d'adresse email : <strong>abc123@cde456.fr</strong>
                            </div>
                        </div>

                        <!-- Mot de passe -->
                        <div class="mb-3 bg-white rounded border border-2 shadow-sm p-4">
                            <label for="exampleInputPassword1" class="form-label text-muted text-uppercase" style="font-size:12px;opacity:0.5">Mot de passe</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" aria-describedby="passwordHelp" required>
                        </div>

                        <!-- Confirmer le mot de passe -->
                        <div class="mb-3 bg-white rounded border border-2 shadow-sm p-4">
                            <label for="confirmInputPassword1" class="form-label text-muted text-uppercase" style="font-size:12px;opacity:0.5">Confirme le mot de passe</label>
                            <input name="confirmPassword" type="password" class="form-control" id="confirmInputPassword1" required>
                        </div>

                        <!-- Ton âge -->
                        <div class="mb-3 bg-white rounded border border-2 shadow-sm p-4">
                            <label for="customRange2" class="form-label text-muted text-uppercase" style="font-size:12px;opacity:0.5">Ton âge <span id="demo"></span></label>
                            <input name="age" type="range" class="form-range" min="15" max="100" value="18" id="customRange2" required>
                        </div>

                        <!-- Choix du campus -->
                        <div class="mb-3 bg-white rounded border border-2 shadow-sm p-4">
                            <p class="text-muted text-uppercase" style="font-size:12px;opacity:0.5">À quelle école es-tu ?</p>
                            <div class="form-check">
                                <input name="position" type="radio" id="customRadioInline1" value="paris" name="customRadioInline1" class="form-check-input" required>
                                <label class="form-check-label" for="customRadioInline1">Paris</label>
                            </div>
                            <div class="form-check">
                                <input name="position" type="radio" id="customRadioInline2" value="cergy" name="customRadioInline1" class="form-check-input" aria-describedby="positionHelp" required>
                                <label class="form-check-label" for="customRadioInline2">Cergy</label>
                            </div>
                            <div id="positionHelp" class="form-text text-muted">
                                Si tu es un PO, choisis l'école où tu es le plus ou celle que tu préfères :)
                            </div>
                        </div>

                        <!-- Choix du statut -->
                        <div class="mb-3 bg-white rounded border border-2 shadow-sm p-4">
                            <p class="text-muted text-uppercase" style="font-size:12px;opacity:0.5">Dans quelle formation es-tu ? (Si tu es PO, une option est faite pour toi !)</p>
                            <select name="status" class="form-select">
                                <option value="bachelor" selected>Bachelor</option>
                                <option value="master">Master</option>
                                <option value="reconversion">Reconversion</option>
                                <option value="po">PO</option>
                            </select>
                            <div id="passwordHelp" class="form-text text-muted">
                                Cela permettra au site d'afficher ton statut.
                            </div>
                        </div>

                        <input name="formSubmit" type="submit" class="btn btn-danger mt-3" value="S'inscrire">
                    </form>
                </div>
            </div>
        </div>

        <!-- Javascript -->
        <script>
            var slider = document.getElementById("customRange2");
            var output = document.getElementById("demo");
            output.innerHTML = slider.value; // Display the default slider value

            // Update the current slider value (each time you drag the slider handle)
            slider.oninput = function() {
                output.innerHTML = this.value;
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>

    </html>