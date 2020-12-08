<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
    <?php include "../header/header.html"; ?>

    <!-- Traitement du formulaire en php -->
    <?php

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

            // Si $valid = true, on envoie tout dans la base de donnée
            if ($valid && empty($errors)) {

                $req = $pdo->prepare("
                        INSERT INTO users(pseudo,mail,password,age,position,status)
                        VALUES (?, ?, ?, ?, ?, ?)
                    ");

                $password = password_hash($password, PASSWORD_BCRYPT);

                $req->bindValue(1, $pseudo);
                $req->bindValue(2, $mail);
                $req->bindValue(3, $password);
                $req->bindValue(4, $age);
                $req->bindValue(5, $position);
                $req->bindValue(6, $status);

                $req->execute();

                $req2 = $pdo->prepare("SELECT * FROM users WHERE mail = ?");

                $req2->execute(array($mail));

                $userConnexion = $req2->fetch();

                session_start();

                $_SESSION['auth'] = $userConnexion;

                header('Location: /forum-coding-factory/public/home/home.php');

                exit;
            }
        }
    }

    ?>


    <!-- Body -->
    <div class="d-flex align-items-center" style="height: 130vh">
        <div class="container-fluid bg-light pt-4 pb-5">
            <div class="row">
                <div class="col-12 pt-5 d-flex flex-column align-items-center">
                    <h1 class="pb-3">S'inscrire</h1>
                    <form action="" method="POST" class="w-50 fz-text p-5 rounded border border-secondary">

                        <?php if (!empty($errors)) : ?>
                            <div class="alert alert-danger pb-0">
                                <ul>

                                    <?php foreach ($errors as $error) : ?>

                                        <li><?= $error; ?></li>

                                    <?php endforeach; ?>

                                </ul>
                            </div>

                        <?php endif; ?>

                        <!-- Pseudo -->
                        <div class="form-group">
                            <label for="pseudoUser">Nom d'utilisateur</label>
                            <input name="pseudo" type="text" class="form-control" pattern="^[a-zA-Z0-9_]{3,16}$" id="pseudoUser" aria-describedby="pseudoHelp" required>
                            <small id="pseudoHelp" class="form-text text-muted">
                                Le nom d'utilisateur ne doit pas contenir de caractères spéciaux. Il doit être compris entre 3 et 16 caractères.
                            </small>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input name="email" type="email" class="form-control" pattern="^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$" id="exampleInputEmail1" placeholder="name@example.com" aria-describedby="emailHelp" required>
                            <small id="emailHelp" class="form-text text-muted">
                                Exemple d'adresse email : <strong>abc123@cde456.fr</strong>
                            </small>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mot de passe</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" aria-describedby="passwordHelp" required>
                        </div>

                        <!-- Confirmer le mot de passe -->
                        <div class="form-group">
                            <label for="confirmInputPassword1">Confirme le mot de passe</label>
                            <input name="confirmPassword" type="password" class="form-control" id="confirmInputPassword1" required>
                        </div>

                        <!-- Ton âge -->
                        <div class="form-group">
                            <label for="customRange2">Ton âge <span id="demo"></span></label>
                            <input name="age" type="range" class="custom-range" min="15" max="100" value="18" id="customRange2" required>
                        </div>

                        <!-- Choix du campus -->
                        <p>À quelle école es-tu ?</p>
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="position" type="radio" id="customRadioInline1" value="paris" name="customRadioInline1" class="custom-control-input" required>
                                <label class="custom-control-label" for="customRadioInline1">Paris</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="position" type="radio" id="customRadioInline2" value="cergy" name="customRadioInline1" class="custom-control-input" required>
                                <label class="custom-control-label" for="customRadioInline2">Cergy</label>
                            </div>
                        </div>

                        <!-- Choix du statut -->
                        <p>Dans quelle formation es-tu ? (Si tu es PO, une option est faite pour toi !)</p>
                        <div class="form-group">
                            <select name="status" class="custom-select">
                                <option value="bachelor" selected>Bachelor</option>
                                <option value="master">Master</option>
                                <option value="reconversion">Reconversion</option>
                                <option value="po">PO</option>
                            </select>
                            <small id="passwordHelp" class="form-text text-muted">
                                Cela permettra au site d'afficher ton statut.
                            </small>
                        </div>

                        <input name="formSubmit" type="submit" class="btn btn-danger mt-3" value="S'inscrire">
                    </form>





                </div>
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>