<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../header/header.css" rel="stylesheet" />
    <link href="../footer/footer.css" rel="stylesheet" />
    <link href="../../prism/prism.css" rel="stylesheet" />
    <script src="../../prism/prism.js"></script>
    <script src="../../editor-simplemde/simplemde.min.js"></script>
    <link href="../../editor-simplemde/simplemde.min.css" rel="stylesheet" />
    <title>Forum - Coding Factory</title>
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

        .header-forum {
            background: no-repeat center/cover url(../../img/back-forum.jpg);
            height: 500px;
            filter: grayscale(100%);
            transition: all 0.5s;
        }

        .header-forum:hover {
            filter: grayscale(0%);
        }

        .link-owner-topic {
            color: #545454;
            text-decoration: none !important;
        }

        .link-owner-topic:hover {
            color: #545454;
            text-decoration: underline !important;
        }

        .breadcrumb-item a {
            text-decoration: none !important;
        }

        .link-edit-topic a {
            text-decoration: none !important;
            color: black;
        }

        .link-edit-topic a:hover {
            opacity: 0.6;
        }

        p>img {
            max-width: 80%;
        }

        .vote-img:hover {
            opacity: 0.6;
        }
    </style>

</head>

<body>

    <?php
    //Date sous forme française
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fra_fra');

    //Mise en place de la session
    session_start();

    //J'inclus le header
    include "../header/header.php";

    //J'inclus les fonctions
    require_once '../../functions/functions.php';

    //J'inclus la base de donnée
    require_once '../../database/db.php';

    //J'inclus le fichier permettant de parser le markdown
    require_once '../../parsedown/Parsedown.php';

    //J'appelle l'objet parsedown
    $parsedown = new Parsedown();
    ?>

    <!-- Création du container principal -->
    <div class="container-fluid bg-light">
        <div class="row d-flex flex-column">
            <div class="header-forum shadow d-flex justify-content-center align-items-center">
                <h1 class="text-white fw-bold text-center fst-italic" style="font-size:6em;letter-spacing:1px">Espace forum</h1>
            </div>


            <?php

            //Si la variable id existe
            if (isset($_GET['id'])) :

                //J'effectue une jointure entre les topics et les users
                $req = $pdo->prepare("SELECT * FROM topics LEFT JOIN users ON topics.idCreator = users.id WHERE topics.idTopic = ?");

                $req->execute([$_GET['id']]);

                $list_topics = $req->fetchAll(PDO::FETCH_ASSOC);

                $array_topics = [];

                //Je parcours les résultats
                foreach ($list_topics as $key => $value) :

                    foreach ($value as $a => $b) {

                        $array_topics[$a] = $b;
                    }

                endforeach;

                //Si l'id existe dans les résultats de la jointure
                if (in_array($_GET['id'], $array_topics)) :

                    $name_categoryQuery = $pdo->prepare("SELECT * FROM topics LEFT JOIN categories ON topics.idCategory = categories.id WHERE topics.idCategory = ? AND topics.idTopic = ?");

                    $name_categoryQuery->execute([$array_topics['idCategory'], $_GET['id']]);

                    $name_category = $name_categoryQuery->fetch(PDO::FETCH_ASSOC);
            ?>

                    <div class="col-9 mx-auto mt-5 d-flex flex-column">
                        <h2 class="mb-5 ms-3"><?php echo $array_topics['titleTopic'] ?></h2>
                        <!-- BreadCrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/forum-coding-factory/public/home/home.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="/forum-coding-factory/public/forum/forum.php">Forum</a></li>
                                <li class="breadcrumb-item"><a href="/forum-coding-factory/public/forum/forum.php?category=<?= strtolower($name_category['name']) ?>&id=<?= $name_category['id'] ?>"><?php echo $name_category['name'] ?></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Topic n°<?php echo $_GET['id'] ?></li>
                            </ol>
                        </nav>

                        <!-- Création du bloc affichant le post de l'utilisateur -->
                        <div class="d-flex flex-row">
                            <div class="d-flex flex-column justify-content-center me-3 py-3 mb-4 mt-3">
                                <a href=""><img src="../../img/up-arrow.png" class="mb-1 vote-img" alt=""></a>
                                <p class="text-center m-0 fz-text">0</p>
                                <a href=""><img src="../../img/down-arrow.png" class="mt-1 vote-img" alt=""></a>
                            </div>

                            <div class="bg-white rounded shadow-sm p-3 mb-4 w-100 fz-text d-flex flex-row mt-3">
                                <div class="d-flex flex-column align-items-center me-5">
                                    <a class="link-owner-topic ms-2 mb-1" style="font-size: 19px; font-weight: 600; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"><?= $array_topics['pseudo'] ?></a>
                                    <div class="ms-2 d-flex flex-column align-items-center">
                                        <div class="mb-2">
                                            <?= badge_color($array_topics['status']) ?>
                                        </div>
                                        <div>
                                            <?= if_admin_user($array_topics['rank']) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-100">
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <div>
                                            <!-- Je parse le message de la base de donnée et je décode tous les caractères HTML en utf-8 -->
                                            <p class="mt-2 text-user-topic"><?php echo $parsedown->text(html_entity_decode($array_topics['contentTopic'])) ?></p>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted fst-italic me-2" style="font-size:14px"><?= timeAgo($array_topics['creationDate']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- J'affiche le temps du message depuis laquel il a été posté -->
                                    <div class="link-edit-topic d-flex justify-content-end me-3" style="font-size: 15px">
                                        <?php if (isset($_SESSION['auth']->id) && ($array_topics['id'] === $_SESSION['auth']->id)) : ?>
                                            <a onclick="" class="text-muted me-3"><i class="fa fa-edit"></i> Éditer</a>
                                            <a href="" onclick="" class="text-muted" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-trash"></i> Supprimer</a>
                                        <?php endif; ?>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>


                        <!-- Modal suppression topic -->
                        <div class="modal fade fz-text" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Supprimer le topic</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous certain de vouloir supprimer votre message ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button onclick="<?php $test = "coucou" ?>" type="button" class="btn btn-danger" data-bs-dismiss="modal">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4 mt-0">

                        <div class="order-last">

                            <?php

                            //Formulaire de réponse
                            if (isset($_POST['submitReplyPost'], $_POST['reponseText'])) {

                                $replyContent = htmlspecialchars($_POST['reponseText']);

                                if (isset($_SESSION['auth'])) {
                                    if (!empty($replyContent)) {

                                        $reqReply = $pdo->prepare("INSERT INTO messages(idTopicMessage, idUser, contentMessage) VALUES (?, ?, ?)");

                                        $reqReply->execute([$_GET['id'], $_SESSION['auth']->id, $replyContent]);

                                        $reqReply2 = $pdo->prepare("UPDATE topics SET updateTopic = CURRENT_TIMESTAMP WHERE idTopic = ?");

                                        $reqReply2->execute([$_GET['id']]);

                                        echo '<div class="alert alert-success">Réponse envoyée avec succès.</div>';
                                    } else {
                                        echo '<div class="alert alert-danger">Tu dois indiquer une réponse.</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger">Veuillez vous connecter ou vous inscrire afin d\'envoyer une réponse.</div>';
                                }
                            }

                            //Si l'utilisateur est connecté
                            if (isset($_SESSION['auth'])) :
                            ?>
                                <hr>

                                <div class="mb-3">
                                    <form method="POST">
                                        <div>
                                            <h5 class="mb-3">Répondre</h5>
                                            <?php if (isset($_SESSION['auth']->id) && ($array_topics['idCreator'] === $_SESSION['auth']->id)) : ?>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Marquer le sujet comme résolu
                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                            <textarea name="reponseText" type="hidden" placeholder="Écrivez votre réponse" id="contentTopic" class="form-control" rows="3"></textarea>
                                        </div>
                                        <input type="submit" name="submitReplyPost" class="btn btn-danger mt-2" value="Répondre">
                                    </form>
                                </div>
                        </div>

                    <?php endif;

                            //J'effectue une jointure entre les messages des topics et les utilisateurs
                            $reqListMessages = $pdo->prepare("SELECT * FROM messages LEFT JOIN users ON messages.idUser = users.id WHERE idTopicMessage = ?");

                            $reqListMessages->execute([$_GET['id']]);

                            $list_messages_topic = $reqListMessages->fetchAll(PDO::FETCH_ASSOC); ?>

                    <h5 class="mb-4"><?php echo (count($list_messages_topic) > 1) ? count($list_messages_topic) . " Réponses" : count($list_messages_topic) . " Réponse" ?></h5>

                    <?php

                    //Je parcours tous les résultats
                    foreach ($list_messages_topic as $a => $b) : ?>

                        <div class="d-flex flex-row">
                            <div class="d-flex flex-column justify-content-center me-3 py-3 mb-4 mt-3">
                                <a href=""><img src="../../img/up-arrow.png" class="mb-1 vote-img" alt=""></a>
                                <p class="text-center m-0 fz-text">0</p>
                                <a href=""><img src="../../img/down-arrow.png" class="mt-1 vote-img" alt=""></a>
                            </div>

                            <div class="bg-white rounded shadow-sm p-3 mb-4 w-100 fz-text d-flex flex-row mt-3">
                                <div class="d-flex flex-column align-items-center me-5">
                                    <a class="link-owner-topic ms-2 mb-1" style="font-size: 19px; font-weight: 600; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"><?= $b['pseudo'] ?></a>
                                    <div class="ms-2 d-flex flex-column align-items-center">
                                        <div class="mb-2">
                                            <?= badge_color($b['status']) ?>
                                        </div>
                                        <div>
                                            <?= if_admin_user($b['rank']) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100">
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <div>
                                            <!-- Je parse le message de la base de donnée et je décode tous les caractères HTML en utf-8 -->
                                            <p class="mt-2 text-user-topic"><?php echo $parsedown->text(html_entity_decode($b['contentMessage'])) ?></p>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted fst-italic me-2" style="font-size:14px"><?= timeAgo($b['messageDate']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- J'affiche le temps du message depuis laquel il a été posté -->
                                    <div class="link-edit-topic d-flex justify-content-end me-3" style="font-size: 15px">
                                        <?php if (isset($_SESSION['auth']->id) && ($b['id'] === $_SESSION['auth']->id)) : ?>
                                            <a onclick="" class="text-muted me-3"><i class="fa fa-edit"></i> Éditer</a>
                                            <a href="" onclick="" class="text-muted" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-trash"></i> Supprimer</a>
                                        <?php endif; ?>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>


                    </div>

                <?php else : ?>

                    <h1 class="text-center">Le topic est introuvable</h1>

                <?php endif; ?>

            <?php else : ?>

                <h1 class="text-center">Le topic est introuvable</h1>

            <?php endif; ?>

        </div>
    </div>


    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script>
        //Je récupère toutes les balises <code>
        let codeBlockList = document.querySelectorAll("code");

        //Je parcours tous la liste des balises <code>
        codeBlockList.forEach(function(codeBlock) {
            //Si leurs nombre de classe = 0 alors on ajoute la classe "language-markup"
            if (codeBlock.classList.length == 0) {
                codeBlock.classList.add("language-markup");
            }
        });

        var simplemde = new SimpleMDE({
            element: document.getElementById("contentTopic"),
            toolbar: ["bold", "italic", "heading", "|", "code", "|", "quote", "unordered-list", "ordered-list", "|", "link", "image", "|", "preview", "guide"],
        });
    </script>
</body>

</html>