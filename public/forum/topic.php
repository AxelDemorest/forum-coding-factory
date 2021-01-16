<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Header et Footer -->
    <link href="../header/header.css" rel="stylesheet" />

    <!-- Éditeur markdown -->
    <link rel="stylesheet" href="../../editormd/css/editormd.css" />
    <link rel="stylesheet" href="../../editormd/css/editormd.preview.css" />

    <!-- <script src="../../editor-simplemde/simplemde.min.js"></script>
    <link href="../../editor-simplemde/simplemde.min.css" rel="stylesheet" /> -->

    <!-- Color syntaxing -->
    <link rel="stylesheet" href="../../highlightjs/styles/Googlecode.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Forum - BlackBoard Factory</title>

    <!-- Style de la page -->
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

        .link-best-answer {
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

        pre {
            border-radius: 5px;
        }

        .hljs-ln-numbers {
            padding-right: 14px !important;
        }

        .hljs-ln-n {
            color: #969696;
        }

        .tr-table-code {
            height: 25px;
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
            if (isset($_GET['id']) && isset($_GET['idCategory'])) :

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
                if (in_array($_GET['id'], $array_topics) && in_array($_GET['idCategory'], $array_topics)) :

                    $name_categoryQuery = $pdo->prepare("SELECT * FROM topics LEFT JOIN categories ON topics.idCategory = categories.id WHERE topics.idCategory = ? AND topics.idTopic = ?");

                    $name_categoryQuery->execute([$array_topics['idCategory'], $_GET['id']]);

                    $name_category = $name_categoryQuery->fetch(PDO::FETCH_ASSOC);
            ?>

                    <div class="col-9 mx-auto mt-5 d-flex flex-column">
                        <h2 class="mb-5 ms-5"><?= $array_topics['titleTopic'] ?></h2>
                        <!-- BreadCrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb ms-5">
                                <li class="breadcrumb-item"><a href="/forum-coding-factory/public/home/home.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="/forum-coding-factory/public/forum/forum.php">Forum</a></li>
                                <li class="breadcrumb-item"><a href="/forum-coding-factory/public/forum/forum.php?category=<?= strtolower($name_category['name']) ?>&id=<?= $name_category['id'] ?>"><?= $name_category['name'] ?></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Topic n°<?= $_GET['id'] ?></li>
                            </ol>
                        </nav>

                        <?php

                        //--------------------------------------//
                        // Si l'utilisateur a déjà up le topic  //
                        //--------------------------------------//

                        if (isset($_SESSION['auth'])) {

                            $querySelectVoteUser = $pdo->prepare("SELECT * FROM votesTopics WHERE votesTopicsIdUser = ? AND votesTopicsIdContentTopic = ? AND votesTopicsStatus = ? ");

                            $querySelectVoteUser->execute([$_SESSION['auth']->id, $_GET['id'], "up"]);

                            if ($value = $querySelectVoteUser->fetch()) {

                                $img = "../../img/up-arrow-already.png";
                            } else {

                                $img = "../../img/up-arrow.png";
                            }

                            //----------------------------------------//
                            // Si l'utilisateur a déjà down le topic  //
                            //----------------------------------------//

                            $querySelectVoteUser = $pdo->prepare("SELECT * FROM votesTopics WHERE votesTopicsIdUser = ? AND votesTopicsIdContentTopic = ? AND votesTopicsStatus = ? ");

                            $querySelectVoteUser->execute([$_SESSION['auth']->id, $_GET['id'], "down"]);

                            if ($value = $querySelectVoteUser->fetch()) {

                                $img2 = "../../img/down-arrow-already.png";
                            } else {

                                $img2 = "../../img/down-arrow.png";
                            }
                        }

                        ?>

                        <!-- Création du bloc affichant le post de l'utilisateur -->
                        <div class="d-flex flex-row">

                            <?php if (isset($_SESSION['auth'])) : ?>
                                <!-- Vote content topic -->
                                <div class="d-flex flex-column justify-content-center me-3 py-3 mb-4 mt-3">
                                    <a href="javascript:void(0)" id="linkVoteUp" onclick="voteTopic(<?= $_GET['id'] ?>, 'up', <?= $_SESSION['auth']->id ?>)"><img src="<?= $img ?>" class="mb-1 vote-img" id="vote-img-up-topic" alt=""></a>
                                    <p class="text-center m-0 fz-text" id="voteNumberContentTopic"><?= $array_topics['topicVote'] ?></p>
                                    <a href="javascript:void(0)" onclick="voteTopic(<?= $_GET['id'] ?>, 'down', <?= $_SESSION['auth']->id ?>)"><img src="<?= $img2 ?>" class="mt-1 vote-img" id="vote-img-down-topic" alt=""></a>
                                </div>

                            <?php endif; ?>

                            <div class="bg-white rounded shadow-sm px-3 pt-3 pb-1 mb-4 w-100 fz-text d-flex flex-row mt-3">
                                <div class="d-flex flex-column align-items-center pe-2 pb-4 me-3" style="width:9em">
                                    <?php if ($array_topics['rank'] == 1) : ?>
                                        <img src="../../img/crown.png" width="40" alt="">
                                    <?php endif; ?>
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
                                <div style="width:85%">
                                    <div class="d-flex justify-content-start">
                                        <p class="mb-0 text-muted fst-italic" style="font-size:14px"><?= timeAgo($array_topics['creationDate']); ?>
                                            <!--  <?= ($array_topics['updateTopic'] !== $array_topics['creationDate']) ? "- (Sujet modifié " . timeAgo($array_topics['updateTopic']) . ")" : "" ?> -->
                                        </p>
                                    </div>
                                    <div class="me-5">
                                        <!-- Je parse le message de la base de donnée et je décode tous les caractères HTML en utf-8 -->
                                        <p class="mt-2 text-user-topic"><?php echo $parsedown->text(html_entity_decode($array_topics['contentTopic'])) ?></p>
                                    </div>
                                    <hr>
                                    <!-- J'affiche le temps du message depuis laquel il a été posté -->
                                    <div class="link-edit-topic d-flex justify-content-end me-3 pt-2" style="font-size: 15px">
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
                                        <button type="button" onclick="deleteTopic(<?= $_GET['id'] ?>)" class="btn btn-danger" data-bs-dismiss="modal">Supprimer</button>
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

                                        $reqReply = $pdo->prepare("INSERT INTO messages(idTopicMessage, idUser, contentMessage, idMessagecategory) VALUES (?, ?, ?, ?)");

                                        $reqReply->execute([$_GET['id'], $_SESSION['auth']->id, $replyContent, $_GET['idCategory']]);

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
                                            <div id="contentTopic">
                                                <textarea name="reponseText" type="hidden" placeholder="Écrivez votre réponse" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <input type="submit" name="submitReplyPost" class="btn btn-danger mt-2" value="Répondre">
                                    </form>
                                </div>
                        </div>

                    <?php endif;

                            //J'effectue une jointure entre les messages des topics et les utilisateurs
                            $reqListMessages = $pdo->prepare("SELECT * FROM messages LEFT JOIN users ON messages.idUser = users.id LEFT JOIN topics ON messages.idTopicMessage = topics.idTopic WHERE idTopicMessage = ? ORDER BY messageDate ASC");

                            $reqListMessages->execute([$_GET['id']]);

                            $list_messages_topic = $reqListMessages->fetchAll(PDO::FETCH_ASSOC); ?>

                    <h5 class="mb-4"><?php echo (count($list_messages_topic) > 1) ? count($list_messages_topic) . " Réponses" : count($list_messages_topic) . " Réponse" ?></h5>

                    <?php

                    //Je parcours tous les résultats
                    foreach ($list_messages_topic as $a => $b) :

                        //--------------------------------------//
                        // Si l'utilisateur a déjà up le topic  //
                        //--------------------------------------//

                        if (isset($_SESSION['auth'])) {

                            $querySelectVoteUser = $pdo->prepare("SELECT * FROM votesComments WHERE votesCommentsIdUser = ? AND votesCommentsidMessage = ? AND votesCommentsStatus = ? ");

                            $querySelectVoteUser->execute([$_SESSION['auth']->id, $b['idMessage'], "up"]);

                            if ($value = $querySelectVoteUser->fetch()) {

                                $imgComments = "../../img/up-arrow-already.png";
                            } else {

                                $imgComments = "../../img/up-arrow.png";
                            }

                            //----------------------------------------//
                            // Si l'utilisateur a déjà down le topic  //
                            //----------------------------------------//

                            $querySelectVoteUser = $pdo->prepare("SELECT * FROM votesComments WHERE votesCommentsIdUser = ? AND votesCommentsidMessage = ? AND votesCommentsStatus = ? ");

                            $querySelectVoteUser->execute([$_SESSION['auth']->id, $b['idMessage'], "down"]);

                            if ($value = $querySelectVoteUser->fetch()) {

                                $imgComments2 = "../../img/down-arrow-already.png";
                            } else {

                                $imgComments2 = "../../img/down-arrow.png";
                            }
                        }

                        if($b['bestReply'] == 0) {

                            $contentText = "<i class='fa fa-check'></i> Choisir comme meilleure solution";
                            $colorText = "#0d6efd";
                            $colorBorder = "";

                        } else {

                            $contentText = "<i class='fa fa-star'></i></i> Meilleure solution";
                            $colorText = "#64C43F";
                            $colorBorder = "border: #64C43F solid 1px";

                        }
                    ?>

                        <div class="d-flex flex-row">

                            <?php if (isset($_SESSION['auth'])) : ?>

                                <div class="d-flex flex-column justify-content-center me-3 py-3 mb-4 mt-3">
                                    <a href="javascript:void(0)" onclick="voteMessage(<?= $b['idMessage'] ?>, 'up', <?= $b['id'] ?>)"><img src="<?= $imgComments ?>" class="mb-1 vote-img" id="vote-img-up-comments<?= $b['idMessage'] ?>" alt=""></a>
                                    <p class="text-center m-0 fz-text" id="vote-number-message<?= $b['idMessage'] ?>"><?= $b['messageVote'] ?></p>
                                    <a href="javascript:void(0)" onclick="voteMessage(<?= $b['idMessage'] ?>, 'down', <?= $b['id'] ?>)"><img src="<?= $imgComments2 ?>" class="mt-1 vote-img" id="vote-img-down-comments<?= $b['idMessage'] ?>" alt=""></a>
                                </div>

                            <?php endif; ?>

                            <div class="bg-white rounded shadow-sm px-3 pt-3 pb-1 mb-4 w-100 fz-text d-flex flex-row mt-3" id="content-message<?= $b['idMessage'] ?>" style="<?= $colorBorder ?>">
                                <div class="d-flex flex-column align-items-center pe-2 pb-4 me-3" style="width:9em">
                                    <?php if ($b['rank'] == 1) : ?>
                                        <img src="../../img/crown.png" width="40" alt="">
                                    <?php endif; ?>
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
                                    <div class="d-flex justify-content-start">
                                        <p class="mb-0 text-muted fst-italic" style="font-size:14px"><?= timeAgo($b['messageDate']); ?>
                                    </div>
                                    <div class="me-5 parse-text">
                                        <!-- Je parse le message de la base de donnée et je décode tous les caractères HTML en utf-8 -->
                                        <p class="mt-2 text-user-topic"><?php echo $parsedown->text(html_entity_decode($b['contentMessage'])) ?></p>
                                    </div>
                                    <hr>
                                    <!-- J'affiche le temps du message depuis laquel il a été posté -->
                                    <div class="d-flex justify-content-between me-3 pt-2" style="font-size: 15px">
                                        <?php if (isset($_SESSION['auth']->id) && ($b['idCreator'] === $_SESSION['auth']->id)) : ?>
                                            <div>
                                                <a href="javascript:void(0)" onclick="bestReply(<?= $b['idMessage'] ?>, <?= $b['idTopic'] ?>)" class="link-best-answer" id="link-best-answer<?= $b['idMessage'] ?>" style="color: <?= $colorText ?>"><?= $contentText ?></a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION['auth']->id) && ($b['id'] === $_SESSION['auth']->id)) : ?>
                                            <div class="link-edit-topic">
                                                <a onclick="" class="text-muted me-3"><i class="fa fa-edit"></i> Éditer</a>
                                                <a href="" onclick="" class="text-muted" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-trash"></i> Supprimer</a>
                                            </div>
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

    <!-- Fichier ajax -->
    <script src="javascript/app.js"></script>

    <!-- Barre de navigation -->
    <script src="../header/header.js"></script>

    <!-- Éditeur markdowwn -->
    <script src="../../editormd/editormd.min.js"></script>
    <script src="../../editormd/languages/fr.js"></script>
    <script src="../../editormd/plugins/link-dialog/link-dialog.js"></script>
    <script src="../../editormd/plugins/image-dialog/image-dialog.js"></script>
    <script src="../../editormd/plugins/code-block-dialog/code-block-dialog.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Color syntaxing -->
    <script src="../../highlightjs/highlight.pack.js"></script>
    <script src="../../highlightjs/highlightjs-line-numbers.js"></script>
    <script>
        if (typeof hljs !== 'undefined') {
            hljs.initHighlightingOnLoad();
            hljs.initLineNumbersOnLoad();

        }

        /* //Je récupère toutes les balises <code>
        let codeBlockList = document.querySelectorAll("code");

        //Je parcours tous la liste des balises <code>
        codeBlockList.forEach(function(codeBlock) {
            //Si leurs nombre de classe = 0 alors on ajoute la classe "language-markup"
            if (codeBlock.classList.length == 0) {
                codeBlock.classList.add("language-markup");
            }
        }); */

        /* var simplemde = new SimpleMDE({
            element: document.getElementById("contentTopic"),
            toolbar: ["bold", "italic", "heading", "|", "code", "|", "quote", "unordered-list", "ordered-list", "|", "link", "image", "|", "preview", "guide"],
        }); */

        //Éditeur markdown
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