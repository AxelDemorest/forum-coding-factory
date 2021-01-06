<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../header/header.css" rel="stylesheet" />
    <link href="../footer/footer.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Forum - Coding factory</title>
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

        .td-link {
            color: black;
            text-decoration: none !important;
        }

        .td-link:hover {
            text-decoration: underline !important;
        }

        .link-content {
            text-decoration: none;
        }

        .link-content:hover {
            text-decoration: underline;
        }

        .page-link {
            color: #dc3545;
        }

        .page-link:hover {
            color: #dc3545;
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

        .last-topics-title {
            transition: all 1s;
        }

        .last-topics-title:hover {
            color: #dc3545;
        }

        .category-block {
            background-color: #F4F4F4
        }

        .category-block:hover {
            background-color: #ECECEC;
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

    $req = $pdo->query("SELECT * FROM categories ORDER BY name DESC");

    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <!-- Design du forum -->
    <div class="container-fluid">
        <div class="row d-flex flex-column">
            <div class="header-forum shadow d-flex justify-content-center align-items-center">
                <h1 class="text-white fw-bold text-center fst-italic" style="font-size:6em;letter-spacing:1px">Espace forum</h1>
            </div>

            <!-- Si aucune catégorie a été choisie -->
            <?php if (!isset($_GET['category']) || !isset($_GET['id'])) : ?>

                <div class="d-flex flex-column">
                    <div class="col-12 mt-5 d-flex flex-column">

                        <h2 class="last-topics-title text-black fw-bold text-center fst-italic" style="font-size:4em;letter-spacing:1px">Catégories</h2>

                        <div class="d-flex flex-row w-75 flex-wrap justify-content-center mt-5 mb-5 mx-auto">

                            <?php

                            foreach ($resultat as $key => $value) :

                                $req2 = $pdo->prepare("SELECT * FROM categories RIGHT JOIN topics ON categories.id = topics.idCategory WHERE categories.id = ? ORDER BY topics.updateTopic DESC LIMIT 1");

                                $req2->execute([$value['id']]);

                                $resultat2 = $req2->fetch(PDO::FETCH_ASSOC);

                            ?>

                                <div class="d-flex flex-column py-3 px-2 m-3 mx-4 rounded fz-text border border-3 category-block" style="width:13em">
                                    <div class="mx-auto mb-3" style="height: 70px;">
                                        <a href="/forum-coding-factory/public/forum/forum.php?category=<?= strtolower($value['name']) ?>&id=<?= strtolower($value['id']) ?>"><img class="imgCategory" src="../../img/imgCategory/<?= $value['image']; ?>" height="60"></a>
                                    </div>
                                    <a class="text-danger text-decoration-none" href="/forum-coding-factory/public/forum/forum.php?category=<?= strtolower($value['name']) ?>&id=<?= strtolower($value['id']) ?>">
                                        <h5 class="text-center"><?= $value['name']; ?></h5>
                                    </a>
                                    <?php
                                    if (!empty($resultat2)) : ?>
                                        <a class="text-center text-muted link-content mt-2 text-break" style="font-size:17px;opacity:0.6" href="/forum-coding-factory/public/forum/topic.php?id=<?= $resultat2['idTopic'] ?>"><?php echo tronque($resultat2['titleTopic'], 40) ?></a>
                                    <?php else : ?>
                                        <p class="text-center text-muted mt-2" style="font-size:17px;opacity:0.6">Aucun topic</p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>

                        </div>

                        <h2 class="last-topics-title text-black fw-bold text-center fst-italic" style="font-size:4em;letter-spacing:1px">Derniers topics</h2>

                        <?php $req2 = $pdo->query('SELECT * FROM topics LEFT JOIN users ON topics.idCreator = users.id LEFT JOIN categories ON topics.idCategory = categories.id ORDER BY creationDate DESC LIMIT 10'); ?>

                        <div class="d-flex flex-row justify-content-center">
                            <div class="col-9 d-flex flex-column align-items-center mt-5 fz-text">

                                <?php while ($resultat3 = $req2->fetch()) : ?>
                                    <table class="table table-striped table-hover" style="width:45em">
                                        <tbody>
                                            <tr>
                                                <td class="d-flex align-items-center justify-content-between rounded">
                                                    <div class="d-flex flex-row">
                                                        <div class="d-flex align-items-center justify-content-center" style="width:3em">
                                                            <?php if ($resultat3->resolution == 0) : ?>
                                                                <i class="fa fa-times text-secondary fs-2"></i>
                                                            <?php else : ?>
                                                                <i class="fa fa-check text-secondary fs-2"></i>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="ms-2">
                                                            <a href="/forum-coding-factory/public/forum/topic.php?id=<?= $resultat3->idTopic ?>" style="text-decoration:none">
                                                                <h4 class="mb-1 mt-2 text-danger"><?= $resultat3->titleTopic ?></h4>
                                                            </a>
                                                            <p class="text-muted me-3" style="font-size:14px"><?= $resultat3->pseudo ?> | <a class="text-danger" href="/forum-coding-factory/public/forum/forum.php?category=<?= strtolower($resultat3->name) ?>&id=<?= strtolower($resultat3->idCategory) ?>" style="text-decoration:none"><?= $resultat3->name ?></a></p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="text-muted me-1" style="font-size:14px"><?= timeAgo($resultat3->creationDate) ?></p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "../footer/footer.html"; ?>

                <!-- Si une catégorie a été choisie -->
            <?php else : ?>

                <?php $array_category = []; ?>

                <?php $array_category_id = []; ?>

                <!-- Je parcours le résultat de la requête SQL et je push dans le tableau l'id qui correspond au nom de la catégorie -->
                <?php foreach ($resultat as $key => $value) : ?>

                    <?php $array_category[$value['id']] = strtolower($value['name']); ?>
                    <?php array_push($array_category_id, $value['id']); ?>

                <?php endforeach; ?>

                <!-- Si le nom de la catégorie est dans le tableau et que l'id correspond à la bonne catégorie -->
                <?php if (in_array($_GET['category'], $array_category) && (in_array($_GET['id'], $array_category_id))) : ?>

                    <?php if ($array_category[$_GET['id']] == $_GET['category']) : ?>

                        <img class="imgCategory mx-auto mt-5" src="../../img/imgCategory/<?= $_GET['category']; ?>.png" style="width: 15%">

                        <?php

                        /* if (isset($_GET['page']) && !empty($_GET['page'])) {
                            $currentPage = (int) strip_tags($_GET['page']);
                        } else {
                            $currentPage = 1;
                        } */

                        $sql = 'SELECT COUNT(*) AS nb_topics FROM `topics`';

                        $query = $pdo->prepare($sql);

                        $query->execute();

                        $result = $query->fetch(PDO::FETCH_ASSOC);

                        $nbTopics = (int) $result['nb_topics'];

                        $currentPage = (isset($_GET["page"])) ? $_GET["page"] : 1;

                        $perPage = 15;

                        $totalItems = $nbTopics;

                        $totalPages = ceil($totalItems / $perPage);

                        /* echo $totalPages; */

                        $currentPage = min(max(1, $currentPage), $totalPages);

                        $premier = ($currentPage * $perPage) - $perPage; ?>

                        <?php if (isset($_SESSION['auth'])) : ?>
                            <a class="mt-5 d-flex justify-content-center" style="text-decoration: none !important" href="/forum-coding-factory/public/forum/askQuestion.php?id=<?= $_GET['id'] ?>">
                                <div class="btn btn-outline-danger fz-text" style="width: 20%">Poser une question</div>
                            </a>
                        <?php endif; ?>

                        <?php

                        if ($nbTopics > 0) :
                            $test = 'SELECT * FROM topics LEFT JOIN categories ON topics.idCategory = categories.id 
                            LEFT JOIN users ON topics.idCreator = users.id WHERE topics.idCategory = :id ORDER BY topics.updateTopic DESC LIMIT :premier, :parpage';

                            $req2 = $pdo->prepare($test);

                            $req2->bindValue(':id', $_GET['id']);
                            $req2->bindValue(':premier', $premier, PDO::PARAM_INT);
                            $req2->bindValue(':parpage', $perPage, PDO::PARAM_INT);

                            $req2->execute();

                            $display_topics = $req2->fetchAll(PDO::FETCH_ASSOC);
                        endif;


                        /*  echo '<pre>';
                        echo print_r($display_topics);
                        echo '</pre>';  */

                        ?>


                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover w-75 mx-auto border border-3 shadow-sm fz-text caption-top">
                                <caption>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/forum-coding-factory/public/home/home.php">Home</a></li>
                                            <li class="breadcrumb-item"><a href="/forum-coding-factory/public/forum/forum.php">Forum</a></li>
                                            <li class="breadcrumb-item active" aria-current="page"><?php echo $_GET['category'] ?></li>
                                        </ol>
                                    </nav>
                                </caption>
                                <tbody>
                                    <?php

                                    if ($nbTopics > 0) :

                                        foreach ($display_topics as $topic => $value) : ?>

                                            <tr>
                                                <td class="align-middle" style="width:4.7em">
                                                    <?php


                                                    if ($value['resolution'] == 0) : ?>

                                                        <i class="text-center fa fa-times text-secondary fs-2 ps-3"></i>


                                                    <?php else : ?>

                                                        <i class="fa fa-check text-secondary fs-2"></i>

                                                    <?php endif; ?>

                                                </td>

                                                <td class="align-middle"><a class="td-link" href="topic.php?id=<?= $value['idTopic'] ?>"><?php echo $value['titleTopic'] ?></a>

                                                    <br />
                                                    <div class="text-muted" style="font-size: 13px">

                                                        <?php

                                                        $lastActivityQuery = $pdo->prepare("SELECT messageDate FROM messages WHERE idTopicMessage = ? ORDER BY messageDate DESC LIMIT 1");

                                                        $lastActivityQuery->execute([$value['idTopic']]);

                                                        $lastActivity = $lastActivityQuery->fetch(PDO::FETCH_ASSOC);

                                                        if (isset($lastActivity['messageDate'])) : ?>
                                                            Dernière activité : <?php echo ucfirst(timeAgo($lastActivity['messageDate'])) ?></div>
                                                <?php else : ?>
                                                    Aucune activités
                                                <?php endif; ?>



                                                </td>

                                                <?php $reqListMessages = $pdo->prepare("SELECT * FROM messages LEFT JOIN users ON messages.idUser = users.id WHERE idTopicMessage = ?");

                                                $reqListMessages->execute([$value['idTopic']]);

                                                $list_messages_topic = $reqListMessages->fetchAll(PDO::FETCH_ASSOC); ?>

                                                <td class="text-center align-middle">
                                                    <i class="text-secondary fa fa-comments me-1"></i> <?php echo count($list_messages_topic) ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?php echo $value['pseudo'] ?>
                                                    <br />
                                                    <div class="text-muted" style="font-size: 13px">
                                                        <?php echo timeAgo($value['creationDate']); ?>
                                                    </div>


                                                </td>
                                            </tr>

                                        <?php endforeach; ?>
                                </tbody>
                            </table>


                            <div class="d-flex justify-content-center my-5">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">

                                        <!-- /forum-coding-factory/public/forum/forum.php?category=<?= $_GET['category'] ?>&id=<?= $_GET['id'] ?> -->

                                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                                            <a href="?category=<?= $_GET['category'] ?>&id=<?= $_GET['id'] ?>&page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                                        </li>

                                        <!-- <li class="disabled"><a>...</a></li> -->

                                        <?php for ($i = 1; $i < $currentPage; ++$i) { ?>
                                            <?php if ($i < 3 || $i > $currentPage - 3 || $totalPages < 10) { ?>
                                                <li class="page-item"><a class="page-link" href="?category=<?= $_GET['category'] ?>&id=<?= $_GET['id'] ?>&page=<?= $i ?>"><?= $i ?></a></li>
                                            <?php } elseif ($i == $currentPage - 3) { ?>
                                                <li class="disabled"><a class="page-link">...</a></li>
                                            <?php } ?>
                                        <?php } ?>

                                        <li class="page-item disabled"><a class="page-link"><?= $currentPage ?></a></li>

                                        <?php for ($i = $currentPage + 1; $i <= $totalPages; ++$i) { ?>
                                            <?php if ($i < $currentPage + 3 || $i > $totalPages - 2 || $totalPages < 10) { ?>
                                                <li class="page-item"><a class="page-link" href="?category=<?= $_GET['category'] ?>&id=<?= $_GET['id'] ?>&page=<?= $i ?>"><?= $i ?></a></li>
                                            <?php } elseif ($i == $currentPage + 3) { ?>
                                                <li class="disabled"><a class="page-link">...</a></li>
                                            <?php } ?>
                                        <?php } ?>

                                        <li class="page-item <?= ($currentPage == $totalPages) ? "disabled" : "" ?>">
                                            <a href="?category=<?= $_GET['category'] ?>&id=<?= $_GET['id'] ?>&page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                        </div>

                    <?php endif; ?>

                <?php else : ?>

                    <h1 class="text-center">La catégorie est introuvable</h1>

                <?php endif; ?>

            <?php else : ?>

                <h1 class="text-center">La catégorie est introuvable</h1>

            <?php endif; ?>

        <?php endif; ?>
        </div>
    </div>



    <!-- Javascript -->
    <script src="../header/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>