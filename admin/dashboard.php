<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>dashboard - Forum Factory</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');

        body {
            background-color: #232323;
        }

        .fz-text {
            font-family: 'Quicksand', sans-serif;
        }

        .navbar {
            z-index: 1010;
            background-color: #2D2D2D;
        }
    </style>
</head>

<body>
    <?php

    session_start();

    if (isset($_SESSION['auth'])) : ?>

        <?php if ($_SESSION['auth']->rank == 1) : ?>

            <!-- ici on demande le mdp d'accès et si c'est bon on affiche le dashboard -->

            <nav class="navbar navbar-expand-lg navbar-dark fixed-top fz-text" style="height: 60px;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Forum Factory - Administration</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/forum-coding-factory/public/home/home.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Forum Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#dashboardStats">Statistiques</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Users</a>
                            </li>
                        </ul>
                        <span class="navbar-text me-3">
                            Connecté en tant que <?php echo $_SESSION['auth']->pseudo ?>
                        </span>
                    </div>
                </div>
            </nav>

            <!-- Traitement de l'ajout d'une catégorie au forum -->
            <?php

            require_once '../database/db.php';

            $errors = array();

            $valid = true;

            if (isset($_POST['addCategoryForumSubmit'])) {

                $nameCategory  = htmlspecialchars(trim($_POST['nameCategory']));

                if (empty($nameCategory)) {
                    $errors['nameCategory'] = "Le nom de la catégorie est incorrect.";
                    $valid = false;
                }

                if ($valid) {

                    if (isset($_FILES['imageCategory']) and !empty($_FILES['imageCategory']['name'])) {

                        $tailleMax = 2097152;
                        $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');

                        if ($_FILES['imageCategory']['size'] <= $tailleMax) {

                            $extensionUpload = strtolower(substr(strchr($_FILES['imageCategory']['name'], '.'), 1));

                            if (in_array($extensionUpload, $extensionsValides)) {

                                $chemin = "../img/imgCategory/" . $nameCategory . '.' . $extensionUpload;
                                $resultat = move_uploaded_file($_FILES['imageCategory']['tmp_name'], $chemin);

                                if ($resultat) {

                                    $updateavatar = $pdo->prepare("
                                    INSERT INTO categories(name, image)
                                    VALUES (:name, :image)
                                ");

                                    $updateavatar->execute([
                                        'name' => $nameCategory,
                                        'image' => $nameCategory . '.' . $extensionUpload,
                                    ]);
                                } else {

                                    $errors['errorImport'] = "Il y a eu une erreur pendant l'importation du fichier.";
                                }
                            } else {

                                $errors['errorFormat'] = "L'image doit être au format jpg, jpeg, gif ou png.";
                            }
                        } else {

                            $errors['errorSize'] = "La taille du fichier est trop élevée";
                        }
                    } else {

                        $errors['errorImage'] = "Tu dois indiquer une image";
                    }
                }
            }

            ?>

            <!-- Ajouter une catégorie au forum -->
            <div class="main-content text-white" style="margin-top: 60px;">
                <div class="container">
                    <div class="row">
                        <h1 class="pt-4 text-center">Forum dashboard</h1>
                    </div>
                    <div class="row pt-5">
                        <div class="col-4 p-5 rounded" style="background-color: #323232">
                            <h2 class="pb-4">Ajouter une catégorie</h2>
                            <?php if (isset($resultat) && $resultat) : echo '<div class="alert alert-success">La catégorie ' . $nameCategory . ' a bien été ajoutée avec succès !</div>';
                            endif; ?>
                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger">
                                    <ul>

                                        <?php foreach ($errors as $error) : ?>

                                            <li><?= $error; ?></li>

                                        <?php endforeach; ?>

                                    </ul>
                                </div>

                            <?php endif; ?>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="addCategoryForum" class="form-label">Nom de la catégorie</label>
                                    <input name="nameCategory" type="text" class="form-control" id="addCategoryForum" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Image de la catégorie</label>
                                    <input name="imageCategory" class="form-control" type="file" id="formFile" required>
                                </div>
                                <button name="addCategoryForumSubmit" type="submit" class="btn btn-primary">Envoyer</button>
                            </form>
                        </div>
                    </div>
                </div>

                <hr class="mx-auto my-5 w-75 rounded" style="height: 10px; background-color: white !important;">

                <div class="container">
                    <div class="row">
                        <h1 id="dashboardStats" class="pt-4 text-center">Les Statistiques</h1>
                    </div>
                    <div class="row pt-5">
                        <div class="col-4 p-5 rounded" style="background-color: #323232">
                            <h2 class="pb-4">Ajouter une catégorie</h2>

                        </div>
                    </div>
                </div>

            </div> <!-- FIN CONTENT -->

            <!-- debut nouveauter alexis -->

                <hr class="mx-auto my-5 w-75 rounded" style="height: 10px; background-color: white !important;">

                <div class="main-content text-white" style="margin-top: 60px;">
                <div class="container">
                    <div class="row">
                        <h1 class="pt-4 text-center">Les Nouveautés</h1>
                    </div>
                    <div class="row pt-5">
                        <div class="col-4 p-5 rounded" style="background-color: #323232">
                            <h2 class="pb-4">Ajouter une nouveautés</h2>
                            <?php if (isset($resultat) && $resultat) : echo '<div class="alert alert-success">La catégorie ' . $nameCategory . ' a bien été ajoutée avec succès !</div>';
                            endif; ?>
                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger">
                                    <ul>

                                        <?php foreach ($errors as $error) : ?>

                                            <li><?= $error; ?></li>

                                        <?php endforeach; ?>

                                    </ul>
                                </div>

                            <?php endif; ?>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="addCategoryForum" class="form-label">Nom de la nouveauté</label>
                                    <input name="nameCategory" type="text" class="form-control" id="addCategoryForum" required>
                                </div>
                                
                                <button name="addCategoryForumSubmit" type="submit" class="btn btn-primary">Envoyer</button>
                            </form>
                        </div>
                    </div>
                </div>                    
                                
                <!-- ,,,,,,,,,,,,,,,,,,,,,,,,,,,,-->


        <?php endif; ?>

    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>