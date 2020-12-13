<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../header/header.css" rel="stylesheet" />
    <title>Question - Forum Factory</title>
    <style>
        .fz-text {
            font-family: 'Quicksand', sans-serif;
        }

        .hr-body {
            height: 5px;
            width: 8em;
            border-radius: 10px;
            background-color: #dc3545;
        }

        .imgCategory {
            transition: transform .2s;
        }

        .imgCategory:hover {
            -ms-transform: scale(1.2);
            /* IE 9 */
            -webkit-transform: scale(1.2);
            /* Safari 3-8 */
            transform: scale(1.2);
        }
    </style>
</head>

<body>

    <?php
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fra_fra');

    session_start();

    include "../header/header.php";

    require_once '../../functions/functions.php';

    require_once '../../database/db.php';
    ?>

    <div class="container-fluid" style="padding-top: 59px">
        <div class="row d-flex flex-column">
            <h1 class="pt-5 text-center">Espace forum</h1>
            <div class="hr-body mx-auto mb-3 mt-1"></div>

            <?php

            if (isset($_POST['submitButtonQuestion'])) {

                $contentTopic = htmlspecialchars($_POST['textQuestionTopic']);

                $titleTopic = htmlspecialchars($_POST['titleTopic']);

                $valid = true;

                $errors = [];

                if (isset($_SESSION['auth'])) {

                    if (empty($contentTopic)) {
                        $errors['content'] = "Le contenu est incorrect.";
                        $valid = false;
                    }

                    if (empty($titleTopic)) {
                        $errors['title'] = "Le titre est incorrect.";
                        $valid = false;
                    }

                    if (empty($errors) && $valid) {

                        $req = $pdo->prepare("INSERT INTO topics(idCreator, titleTopic, contentTopic, idCategory) VALUES (?, ?, ?, ?)");

                        $req->execute([$_SESSION['auth']->id, $titleTopic, $contentTopic, $_GET['id']]);

                        $req2 = $pdo->prepare("SELECT idTopic FROM topics WHERE idCreator = ? ORDER BY idTopic DESC LIMIT 1");

                        $req2->execute([$_SESSION['auth']->id]);

                        $redirect = $req2->fetch(PDO::FETCH_ASSOC);

                        echo $redirect['idTopic'];
                        
                        header('Location: /forum-coding-factory/public/forum/topic.php?id='.$redirect['idTopic']);

                        exit;
                    }
                }
            }

            $req2 = $pdo->prepare("SELECT * FROM categories WHERE id = ?");

            $req2->execute([$_GET['id']]);

            $value = $req2->fetch(PDO::FETCH_ASSOC);
            ?>

            <div class="d-flex justify-content-center mt-4">
                <img class="imgCategory" src="../../img/imgCategory/<?= strtolower($value['image']) ?>" style="width: 10%">
            </div>

            <div class="col-6 border border-danger mx-auto mt-5 fz-text rounded shadow-sm">

                <form action="" method="POST" class="mb-3 p-4">

                    <?php if (!empty($errors)) : ?>
                        <div class="alert alert-danger pb-0" role="alert">
                            <ul>

                                <?php foreach ($errors as $error) : ?>

                                    <li><?= $error; ?></li>

                                <?php endforeach; ?>

                            </ul>
                        </div>

                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="titleSubject" class="form-label">Titre de ton sujet</label>
                        <input name="titleTopic" type="text" class="form-control" id="titleSubject" required>
                    </div>
                    <div class="mb-3">
                        <label for="contentTopic" class="form-label">Contenu de ton sujet</label>
                        <textarea name="textQuestionTopic" placeholder="Écrivez votre question" id="contentTopic" class="form-control" rows="3" required></textarea>
                    </div>

                    <input type="submit" class="btn btn-danger" name="submitButtonQuestion" value="Envoyer la question">
                    <div class="form-text text-muted">
                        La question sera envoyée dans la catégorie Python.
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="home.js"></script>
</body>

</html>