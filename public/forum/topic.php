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

        .link-owner-topic {
            color: black;
            text-decoration: none !important;
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

        p > img {
            max-width: 80%;
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
    <div class="container-fluid" style="padding-top: 59px">
        <div class="row d-flex flex-column">
            <h1 class="pt-5 text-center">Espace forum</h1>
            <div class="hr-body mx-auto mb-3 mt-1"></div>


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
                        <div class="border border-secondary rounded shadow-sm p-3 mb-4 w-100">
                            <div class="d-flex flex-row align-items-center">
                                <a class="link-owner-topic" style="font-size: 19px; font-weight: 600; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"><?php echo $array_topics['pseudo'] ?></a>
                                <div class="ms-2 fz-text">
                                    <?php badge_color($array_topics['status']) ?>
                                    <?php if_admin_user($array_topics['rank']) ?>
                                </div>
                            </div>
                            <hr>
                            <!-- Je parse le message de la base de donnée et je décode tous les caractères HTML en utf-8 -->
                            <p class="mt-2 fz-text text-user-topic"><?php echo $parsedown->text(html_entity_decode($array_topics['contentTopic'])) ?></p>
                            <!-- J'affiche le temps du message depuis laquel il a été posté -->
                            <p class="mb-0 text-muted" style="font-size:14px"><?php echo timeAgo($array_topics['creationDate']); ?>
                                <span class="fz-text link-edit-topic" style="font-size: 13px">
                                    <?php if ($array_topics['id'] == isset($_SESSION['auth']->id)) : ?>
                                        <a onclick="" class="text-muted"> | <i class="fa fa-edit"></i> Éditer</a>
                                        <a href="" onclick="" class="text-muted" data-bs-toggle="modal" data-bs-target="#exampleModal"> | <i class="fa fa-trash"></i> Supprimer</a>
                                    <?php endif; ?>
                                </span>
                            </p>

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
                                        <button onclick="<?php $test="coucou" ?>" type="button" class="btn btn-danger" data-bs-dismiss="modal">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php echo $test; ?>

                        <hr class="mb-4 mt-0">

                        <div class="order-last">
                            <hr>

                            <?php

                            //Formulaire de réponse
                            if (isset($_POST['submitReplyPost'], $_POST['reponseText'])) {

                                $replyContent = htmlspecialchars($_POST['reponseText']);

                                if (isset($_SESSION['auth'])) {
                                    if (!empty($replyContent)) {

                                        $reqReply = $pdo->prepare("INSERT INTO messages(idTopicMessage, idUser, contentMessage) VALUES (?, ?, ?)");

                                        $reqReply->execute([$_GET['id'], $_SESSION['auth']->id, $replyContent]);

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
                                <div class="mb-3">
                                    <form method="POST">
                                        <div class="mb-3">
                                            <h5 class="mb-3">Répondre</h5>
                                            <textarea name="reponseText" type="hidden" placeholder="Écrivez votre réponse" id="replyPost" class="form-control" rows="1"></textarea>
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

                        <div class="border border-secondary rounded shadow-sm p-3 mb-4 w-100">

                            <div class="d-flex flex-row align-items-center">
                                <a class="link-owner-topic" style="font-size: 19px; font-weight: 600; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"><?php echo $b['pseudo'] ?></a>
                                <div class="ms-2 fz-text">
                                    <?php badge_color($b['status']) ?>
                                    <?php if_admin_user($b['rank']) ?>
                                </div>
                            </div>
                            <hr>
                            <p class="mt-2 fz-text"><?php echo $parsedown->text(html_entity_decode($b['contentMessage'])) ?></p>
                            <p class="mb-0 text-muted" style="font-size:14px"><?php echo timeAgo($b['messageDate']); ?></p>
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

        //Je crée l'éditeur markdown SimpleMDE
        var simplemde = new SimpleMDE({
            //Je récupère la textArea ayant l'id "replyPost"
            element: document.getElementById("replyPost"),
            //J'insère dans la toolbar tous boutons d'édition que je souhaite
            toolbar: ["bold", "italic", "heading", "|", "code", "|", "quote", "unordered-list", "ordered-list", "|", "link", "image", "|", "preview", "guide"],
        });
    </script>
</body>

</html>