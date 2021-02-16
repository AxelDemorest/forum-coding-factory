<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../header/header.css" rel="stylesheet" />
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

        .tr-table:last-child {
            border: none !important;
        }

        .td-link {
            text-decoration: none !important;
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

        .category-block:hover {
            background-color: #ECECEC;
        }

        .link-last-topics:hover {
            color: #0d6efd !important;
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

    $reqInCategory = $pdo->query("SELECT * FROM in_category");

    $ListinCategory = $reqInCategory->fetchAll(PDO::FETCH_ASSOC);

    $reqCategories = $pdo->query("SELECT * FROM categories ORDER BY name ASC");

    $resultatCategories = $reqCategories->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <!-- Design du forum -->
    <div class="container-fluid">
        <div class="row d-flex flex-column">
            <div class="header-forum shadow d-flex justify-content-center align-items-center">
                <h1 class="text-white fw-bold text-center fst-italic" style="font-size:6em;letter-spacing:1px">Espace forum</h1>
            </div>

            <!-- Si aucune catégorie a été choisie -->
            <?php if (!isset($_GET['category']) || !isset($_GET['id'])) : ?>

                <div class="w-100 bg-light d-flex justify-content-center align-items-center">
                    <div class="col-8 bg-white rounded shadow-sm fz-text mb-1 mt-5 p-4">
                        <p class="text-center">Bienvenue sur le forum officiel de <strong class="text-danger">BlackBoard Factory</strong>, ce forum vous est dédié pour vous aider dans votre développement. Si vous avez besoin d'aide, un élève ou un PO de la <em>Coding Factory</em> vous répondra et vous aidera à trouver une solution à votre problème. Vous pourrez trouver sur ce forum, différentes catégories afin de cibler vos questions. Nous vous demandons donc de <strong class="text-danger">bien référencer vos questions</strong> sous peine d'un avertissement.</p>
                        <?php if (!isset($_SESSION['auth'])) : ?>
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="/forum-coding-factory/public/inscription-connexion/connexion.php" class="btn btn-danger">Se connecter</a>
                                <p class="mb-0 mx-4">ou</p>
                                <a href="/forum-coding-factory/public/inscription-connexion/inscription.php" class="btn btn-danger">S'inscrire</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="w-100 bg-light d-flex justify-content-center align-items-center">
                    <div class="col-8 bg-white rounded shadow-sm fz-text mb-1 mt-5 p-4">
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="/forum-coding-factory/public/inscription-connexion/connexion.php" class="btn btn-danger">Se connecter</a>
                            <p class="mb-0 mx-4">ou</p>
                            <a href="/forum-coding-factory/public/inscription-connexion/inscription.php" class="btn btn-danger">S'inscrire</a>
                        </div>
                    </div>
                </div>

                <div class="w-100 bg-light d-flex flex-row justify-content-center">
                    <div class="col-7 py-5 d-flex flex-column align-items-center ">
                        <?php foreach ($ListinCategory as $key => $ListinCategoryValues) :

                            $req = $pdo->prepare("SELECT * FROM categories WHERE in_category = ? ORDER BY name ASC");

                            $req->execute([$ListinCategoryValues['in_categoryId']]);

                            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

                            if (!empty($resultat)) :

                        ?>
                                <table class="bg-white table-list-category shadow-sm rounded fz-text mb-5">
                                    <tbody>
                                        <!-- Mettre la boucle de grosse catégorie ici -->
                                        <tr class="border-bottom tr-table">
                                            <td class="py-3 ps-4" colspan="3">
                                                <h4 class="mb-0"><?= $ListinCategoryValues['in_categoryName'] ?></h4>
                                            </td>
                                        </tr>
                                        <?php foreach ($resultat as $key => $value) :

                                            $req2 = $pdo->prepare("SELECT * FROM categories RIGHT JOIN topics ON categories.id = topics.idCategory WHERE categories.id = ? ORDER BY topics.updateTopic DESC LIMIT 1");

                                            $req2->execute([$value['id']]);

                                            $resultat2 = $req2->fetch(PDO::FETCH_ASSOC);

                                            $reqNumberTopic = $pdo->prepare("SELECT COUNT(*) AS 'nb_topics_categories' FROM topics WHERE idCategory = ?");

                                            $reqNumberTopic->execute([$value['id']]);

                                            $resultTopics = $reqNumberTopic->fetch(PDO::FETCH_ASSOC);

                                            $resultNumberTopic = $resultTopics['nb_topics_categories'];

                                            $reqNumberTotalMessages = $pdo->prepare("SELECT COUNT(*) AS nbMessagesOfCategory FROM messages WHERE messages.idMessagecategory = ?");

                                            $reqNumberTotalMessages->execute([$value['id']]);

                                            $resultNumberTotalMessages = $reqNumberTotalMessages->fetch(PDO::FETCH_ASSOC);

                                            $nbMessagesOfCategory = $resultNumberTotalMessages['nbMessagesOfCategory'];
                                        ?>
                                            <tr class="border-bottom tr-table">
                                                <td class="py-4 ps-4" style="width:45em">
                                                    <div>
                                                        <a class="td-link text-dark d-flex flex-row" href="/forum-coding-factory/public/forum/forum.php?category=<?= strtolower($value['name']) ?>&id=<?= strtolower($value['id']) ?>"><span class="d-flex justify-content-center me-3" style="width:4em"><img class="imgCategory" src="../../img/imgCategory/<?= $value['image']; ?>" height="30"></span>
                                                            <h5 class="fw-normal"><?= $value['name'] ?></h5>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <p class="text-muted mb-0 mt-2 w-75" style="font-size:13px"><?= $value['categoriesOverview'] ?></p>
                                                    </div>
                                                </td>
                                                <td class="px-4" style="width:5em">
                                                    <p class="mb-0 text-end" style="font-size:18px"><?= $resultNumberTopic ?></p>
                                                    <p class="mb-0 text-end text-muted" style="font-size:16px"><?= $resultNumberTopic < 2 ? "sujet" : "sujets" ?></p>
                                                </td>
                                                <td class="ps-4 pe-5" style="width:10em">
                                                    <p class="mb-0 text-end" style="font-size:18px"><?= $nbMessagesOfCategory ?></p>
                                                    <p class="mb-0 text-end text-muted" style="font-size:16px"><?= $nbMessagesOfCategory < 2 ? "réponse" : "réponses" ?></p>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <?php $req2 = $pdo->query('SELECT * FROM topics LEFT JOIN users ON topics.idCreator = users.id LEFT JOIN categories ON topics.idCategory = categories.id ORDER BY updateTopic DESC LIMIT 5'); ?>

                    <div class="col-3 mt-5 ms-5 fz-text">
                        <div class="bg-white text-center rounded shadow-sm">
                            <h5 class="py-3 border-bottom mb-0">Derniers sujets actifs</h5>
                            <?php while ($resultat3 = $req2->fetch()) : ?>
                                <div class="d-flex flex-row border-bottom">
                                    <div class="d-flex align-items-center justify-content-center w-25" style="width:4em">
                                        <a class="td-link text-dark d-flex flex-row" href="/forum-coding-factory/public/forum/forum.php?category=<?= strtolower($resultat3->name) ?>&id=<?= strtolower($resultat3->idCategory) ?>"><img class="imgCategory" src="../../img/imgCategory/<?= $resultat3->image ?>" height="30"></a>
                                    </div>
                                    <div class="d-flex flex-column py-3 text-start w-75">
                                        <a class="link-last-topics text-dark text-break pe-3" href="/forum-coding-factory/public/forum/topic.php?idCategory=<?= $resultat3->idCategory ?>&id=<?= $resultat3->idTopic ?>" style="text-decoration:none;font-size:15px"><?= tronque($resultat3->titleTopic, 35) ?></a>
                                        <p class="mb-0" style="font-size:13px">Crée par <?= $resultat3->pseudo ?></p>
                                        <p class="text-muted mb-0" style="font-size:13px">Création <?= strtolower(timeAgo($resultat3->updateTopic)) ?></p>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>


                <!-- <div class="d-flex flex-column">
                    <div class="col-12 mt-5 d-flex flex-column">

                        <h2 class="last-topics-title text-black fw-bold text-center fst-italic" style="font-size:4em;letter-spacing:1px">Catégories</h2>

                        <div class="d-flex flex-row w-75 flex-wrap justify-content-center mt-5 mb-5 mx-auto">

                                <div class="d-flex flex-column py-3 px-2 m-3 mx-4 rounded fz-text bg-white shadow-sm category-block" style="width:13em">
                                    <div class="mx-auto mb-3" style="height: 70px;">
                                        <a href="/forum-coding-factory/public/forum/forum.php?category=<?= strtolower($value['name']) ?>&id=<?= strtolower($value['id']) ?>"><img class="imgCategory" src="../../img/imgCategory/<?= $value['image']; ?>" height="60"></a>
                                    </div>
                                    <a class="text-danger text-decoration-none" href="/forum-coding-factory/public/forum/forum.php?category=<?= strtolower($value['name']) ?>&id=<?= strtolower($value['id']) ?>">
                                        <h5 class="text-center"><?= $value['name']; ?></h5>
                                    </a>
                                    <?php
                                    if (!empty($resultat2)) : ?>
                                        <a class="text-center text-muted link-content mt-2 text-break" style="font-size:15px;opacity:0.6" href="/forum-coding-factory/public/forum/topic.php?id=<?= $resultat2['idTopic'] ?>"><?php echo tronque($resultat2['titleTopic'], 40) ?></a>
                                    <?php else : ?>
                                        <p class="text-center text-muted mt-2" style="font-size:15px;opacity:0.6">Aucun topic</p>
                                    <?php endif; ?>
                                </div>

                        </div>

                        <hr class="w-50 mx-auto">

                        <div class="d-flex flex-row justify-content-center mt-5">
                            <div>
                                <h2 class="last-topics-title text-black fw-bold text-center fst-italic" style="font-size:4em;letter-spacing:1px">Derniers topics actifs</h2>

                                <?php $req2 = $pdo->query('SELECT * FROM topics LEFT JOIN users ON topics.idCreator = users.id LEFT JOIN categories ON topics.idCategory = categories.id ORDER BY updateTopic DESC LIMIT 10'); ?>

                                <div class="d-flex flex-row justify-content-center mb-5">
                                    <div class="col-9 d-flex flex-column align-items-center mt-5 fz-text">

                                        <?php while ($resultat3 = $req2->fetch()) : ?>
                                            <table class="table table-hover shadow-sm mb-3" style="width:45em">
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
                                                                <p class="text-muted me-1" style="font-size:14px"><?= timeAgo($resultat3->updateTopic) ?></p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 d-flex align-items-start" style="margin-top:8.3em;margin-left:13em">
                                <h2 class="last-topics-title text-black fw-bold text-center fst-italic" style="font-size:4em;letter-spacing:1px">Derniers topics actifs</h2>
                                <div class="shadow-sm p-3">
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officia eveniet numquam placeat nulla asperiores! Deserunt praesentium non, nesciunt fugiat, provident voluptatibus error ex neque, eos harum iusto recusandae corporis expedita!</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> -->

                <?php include "../footer/footer.html"; ?>

                <!-- Si une catégorie a été choisie -->
            <?php else : ?>

                <?php $array_category = []; ?>

                <?php $array_category_id = []; ?>

                <!-- Je parcours le résultat de la requête SQL et je push dans le tableau l'id qui correspond au nom de la catégorie -->
                <?php foreach ($resultatCategories as $key => $value) : ?>

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

                        $sql = 'SELECT COUNT(*) AS nb_topics FROM topics WHERE idCategory = ?';

                        $query = $pdo->prepare($sql);

                        $query->execute([$_GET['id']]);

                        $result = $query->fetch(PDO::FETCH_ASSOC);

                        $nbTopics = (int) $result['nb_topics'];

                        $currentPage = (isset($_GET["page"])) ? $_GET["page"] : 1;

                        $perPage = 15;

                        $totalItems = $nbTopics;

                        $totalPages = ceil($totalItems / $perPage);

                        $currentPage = min(max(1, $currentPage), $totalPages);

                        $premier = ($currentPage * $perPage) - $perPage; ?>

                        <?php if (isset($_SESSION['auth'])) : ?>
                            <a class="mt-5 d-flex justify-content-center" style="text-decoration: none !important" href="/forum-coding-factory/public/forum/askQuestion.php?id=<?= $_GET['id'] ?>">
                                <div class="btn btn-outline-danger fz-text" style="width: 20%">Poser une question</div>
                            </a>
                        <?php else : ?>
                            <div class="d-flex justify-content-center align-items-center mt-5">
                                <a href="/forum-coding-factory/public/inscription-connexion/connexion.php" class="btn btn-danger">Se connecter</a>
                                <p class="mb-0 mx-4">ou</p>
                                <a href="/forum-coding-factory/public/inscription-connexion/inscription.php" class="btn btn-danger">S'inscrire</a>
                            </div>
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

                                                <td class="align-middle"><a class="td-link" href="topic.php?idCategory=<?= $_GET['id'] ?>&id=<?= $value['idTopic'] ?>"><?php echo $value['titleTopic'] ?></a>

                                                    <br />
                                                    <div class="text-muted" style="font-size: 13px">

                                                        <?php if (isset($value['updateTopic'])) : ?>
                                                            <?= ucfirst(timeAgo($value['updateTopic'])) ?>
                                                        <?php else : ?>
                                                            <?= ucfirst(timeAgo($value['updateTopic'])) ?>
                                                        <?php endif; ?>
                                                    </div>


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