<?php
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fra_fra');

session_start();

include "../header/header.php";

require_once '../../functions/functions.php';

require_once '../../database/db.php';

if (isset($_POST['submitButtonQuestion'])) {

    $contentTopic = htmlspecialchars(trim($_POST['textQuestionTopic']));

    $titleTopic = htmlspecialchars(trim($_POST['titleTopic']));

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

            header('Location: /forum-coding-factory/public/forum/topic.php?id=' . $redirect['idTopic']);

            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../header/header.css" rel="stylesheet" />
    <!-- <script src="../../editor-simplemde/simplemde.min.js"></script>
    <link href="../../editor-simplemde/simplemde.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="../../editormd/css/editormd.css" />
    <link rel="stylesheet" href="../../editormd/css/editormd.preview.css" />
    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
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

        .breadcrumb-item a {
            text-decoration: none !important;
        }

        #titleSubject::placeholder {
            opacity: 0.8;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container-fluid" style="padding-top: 59px">
        <div class="row d-flex flex-column">
            <h1 class="pt-5 text-center">Espace forum</h1>
            <div class="hr-body mx-auto mb-3 mt-1"></div>

            <?php

            $req2 = $pdo->prepare("SELECT * FROM categories WHERE id = ?");

            $req2->execute([$_GET['id']]);

            $value = $req2->fetch(PDO::FETCH_ASSOC);
            ?>

            <div class="d-flex justify-content-center mt-4">
                <img class="imgCategory" src="../../img/imgCategory/<?= strtolower($value['image']) ?>" style="width: 10%">
            </div>

            <!-- BreadCrumb  -->
            <nav aria-label="breadcrumb" class="d-flex justify-content-around mb-0 mt-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/forum-coding-factory/public/home/home.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="/forum-coding-factory/public/forum/forum.php">Forum</a></li>
                    <li class="breadcrumb-item"><a href="/forum-coding-factory/public/forum/forum.php?category=<?= strtolower($value['name']) ?>&id=<?= $value['id'] ?>"><?php echo $value['name'] ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Poser une question</li>
                </ol>
            </nav>

            <div class="col-9 mx-auto fz-text mb-5">


                <form action="" method="POST" class="mt-4">

                    <?php if (!empty($errors)) : ?>
                        <div class="alert alert-danger pb-0" role="alert">
                            <ul>

                                <?php foreach ($errors as $error) : ?>

                                    <li><?= $error; ?></li>

                                <?php endforeach; ?>

                            </ul>
                        </div>

                    <?php endif; ?>


                    <div class="mb-3 bg-white rounded shadow-sm border border-2 p-4">
                        <label for="titleSubject" class="form-label text-muted text-uppercase ms-1" style="font-size:12px;opacity:0.5">Titre de votre sujet</label>
                        <input name="titleTopic" type="text" class="form-control" id="titleSubject" placeholder="Quel est le titre de votre sujet ?" required>
                    </div>

                    <div class="bg-white rounded shadow-sm border border-2 p-4">
                        <div class="mb-3">
                            <label for="contentTopic" class="form-label text-muted text-uppercase ms-1" style="font-size:12px;opacity:0.5">Contenu de votre sujet</label>
                            <div id="contentTopic">
                                <textarea name="textQuestionTopic" type="hidden" placeholder="Écrivez votre question" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <hr>
                        <input type="submit" class="btn btn-danger" name="submitButtonQuestion" value="Envoyer la question">
                        <div class="form-text text-muted" style="opacity:0.6">
                            La question sera envoyée dans la catégorie <?php echo $value['name'] ?>.
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="../header/header.js"></script>
    <script src="../../editormd/editormd.min.js"></script>
    <script src="../../editormd/languages/fr.js"></script>
    <script src="../../editormd/plugins/image-dialog/image-dialog.js"></script>
    <script src="../../editormd/plugins/code-block-dialog/code-block-dialog.js"></script>
    <script>
        /* var simplemde = new SimpleMDE({
            element: document.getElementById("contentTopic"),
            toolbar: ["bold", "italic", "heading", "|", "code", "|", "quote", "unordered-list", "ordered-list", "|", "link", "image", "|", "preview", "guide"],
        }); */

        $(function() {
            var editor = editormd("contentTopic", {
                // width  : "100%",
                // height : "100%",
                path: "../../editormd/lib/",
                autoFocus: false,
                placeholder: "Votre message...",
                pluginPath: "../../editormd/plugins/",
                language: "fr",
                width: "100%",
                height: 300,
                lineNumbers: false,
                //autoHeight: true,
                watch: false,
                toolbarAutoFixed: false,
                toolbarIcons: function() {
                    // Or return editormd.toolbarModes[name]; // full, simple, mini
                    // Using "||" set icons align right.
                    return ["undo", "redo", "|", "code", "code-block", "|", "bold", "del", "italic", "|", "list-ul", "list-ol", "hr", "|", "link", "image", "||", "watch"]
                },
                codeFold: true,
                syncScrolling: true,
                dialogLockScreen: false,
                searchReplace: true,
                tex: false,
            });
        });
    </script>
</body>

</html>