<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../header/header.css" rel="stylesheet" />
    <link href="../footer/footer.css" rel="stylesheet" />
    <link href="home.css" rel="stylesheet" />
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

        /* .list-categories:nth-child(even) {
            background-color: #FFF;
        }

        .list-categories:nth-child(odd) {
            background-color: #EEE;
        } */

        .list-categories {
            background-color: #EEE;
        }

        .list-categories a:hover {
            text-decoration: underline !important;
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

    <?php
    $req = $pdo->prepare("SELECT * FROM categories ORDER BY name DESC");

    $req->execute();

    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Design du forum -->
    <div class="container-fluid" style="padding-top: 59px">
        <div class="row d-flex flex-column">
            <h1 class="pt-5 text-center">Espace forum</h1>
            <div class="hr-body mx-auto mb-3 mt-1"></div>

            <!-- Si aucune catégorie a été choisie -->
            <?php if (!isset($_GET['category']) || !isset($_GET['id'])) : ?>

                <div class="d-flex flex-column fz-text">
                    <div class="col-12 mt-5 d-flex flex-column">

                        <h2 class="text-center py-2 px-4 mb-5 border border-danger border-3 rounded mx-auto w-25">Développement</h2>

                        <div class="d-flex flex-row flex-wrap justify-content-center">
                            <?php foreach ($resultat as $key => $value) : ?>
                                <div class="list-categories d-flex flex-column py-3 px-2 m-3 rounded shadow-sm border border-secondary" style="width: 15%;">
                                    <div class="mx-auto mb-3" style="height: 70px;">
                                        <a href="/forum-coding-factory/public/forum/forum.php?category=<?= strtolower($value['name']) ?>&id=<?= strtolower($value['id']) ?>"><img class="imgCategory" src="../../img/imgCategory/<?= $value['image']; ?>" height="60"></a>
                                    </div>
                                    <a class="text-dark text-decoration-none" href="/forum-coding-factory/public/forum/forum.php?category=<?= strtolower($value['name']) ?>&id=<?= strtolower($value['id']) ?>">
                                        <h5 class="text-center"><?= $value['name']; ?></h5>
                                    </a>
                                    <a class="text-dark text-decoration-none" href="">
                                        <p class="text-center">Dernier topic :</p>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>

                    <div class="col-12 mt-5 d-flex flex-column">
                    <h2 class="text-center py-2 px-4 mb-5 border border-danger border-3 rounded mx-auto" style="width: 10%">Agile</h2>
                        <div class="alert alert-danger w-25 mx-auto">La catégorie est momentanément fermée.</div>
                    </div>
                </div>

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

                        <?php $req2 = $pdo->prepare("SELECT * FROM topics LEFT JOIN categories ON topics.idCategory = categories.id 
                        LEFT JOIN users ON topics.idCreator = users.id
                        WHERE topics.idCategory = ?");

                        $req2->execute([$_GET['id']]);

                        $display_topics = $req2->fetchAll(PDO::FETCH_ASSOC);

                        /* echo '<pre>';
                        echo print_r($display_topics);
                        echo '</pre>';  */
                        ?>

                        <div class="table-responsive mt-5">
                            <table class="table table-striped table-hover w-75 table-bordered mx-auto border border-secondary shadow-sm fz-text caption-top">
                                <caption>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/forum-coding-factory/public/home/home.php">Home</a></li>
                                            <li class="breadcrumb-item"><a href="/forum-coding-factory/public/forum/forum.php">Forum</a></li>
                                            <li class="breadcrumb-item active" aria-current="page"><?php echo $_GET['category'] ?></li>
                                        </ol>
                                    </nav>
                                </caption>
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-1"></th>
                                        <th scope="col" class="col-6">Sujet</th>
                                        <th scope="col" class="text-center col-2">Réponses</th>
                                        <th scope="col">Propriétaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($display_topics as $topic => $value) : ?>

                                        <tr>
                                            <td>
                                                <?php


                                                if ($value['resolution'] == 0) : ?>

                                                    <img class="px-4" src="../../img/communication.png" height="30">

                                                <?php else : ?>

                                                    <img src="../../img/lock.png" height="30">

                                                <?php endif; ?>

                                            </td>

                                            <td class="align-middle"><a class="td-link" href="topic.php?id=<?= $value['idTopic'] ?>"><?php echo $value['titleTopic'] ?></a>

                                                <br />
                                                <div class="text-muted" style="font-size: 13px">

                                                    Dernier message : <?php  ?></div>

                                            </td>

                                            <td class="text-center align-middle"><?php echo $value['numberReply'] ?></td>
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
                        </div>

                    <?php else : ?>

                        <h1 class="text-center">La catégorie est introuvable</h1>

                    <?php endif; ?>

                <?php else : ?>

                    <h1 class="text-center">La catégorie est introuvable</h1>

                <?php endif; ?>

            <?php endif; ?>
        </div>

    </div>

    <?php include "../footer/footer.html"; ?>

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="home.js"></script>
</body>

</html>