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
    </style>
</head>

<body>

    <?php
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fra_fra');

    session_start();

    include "../header/header.php";

    require_once '../../database/db.php';
    ?>

    <!-- Design du forum -->
    <div class="container-fluid" style="padding-top: 59px">
        <div class="row d-flex flex-column">
            <h1 class="pt-5 text-center">Espace forum</h1>
            <div class="hr-body mx-auto mb-3 mt-1"></div>
            <div class="d-flex flex-row fz-text">
                <div class="col-6 mt-5 d-flex flex-column align-items-center">
                    <?php
                    $req = $pdo->prepare("SELECT * FROM categories ORDER BY name DESC");

                    $req->execute();

                    $resultat = $req->fetchAll(PDO::FETCH_ASSOC); //
                    ?>

                    <h2 class="text-center py-2 px-4 mb-5 border border-danger border-3 rounded">Développement</h2>

                    <div class="d-flex flex-row flex-wrap justify-content-center">
                        <?php foreach ($resultat as $key => $value) : ?>
                            <div class="list-categories d-flex flex-column py-3 px-2 m-3 rounded shadow-sm border border-secondary" style="width: 25%;">
                                <div class="mx-auto mb-3" style="height: 70px;">
                                    <a href=""><img class="imgCategory" src="../../img/imgCategory/<?= $value['image']; ?>" height="60"></a>
                                </div>
                                <a class="text-dark text-decoration-none" href=""><h5 class="text-center"><?= $value['name']; ?></h5></a>
                                <a class="text-dark text-decoration-none" href=""><p class="text-center">Dernier topic :</p></a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div class="col-6 mt-5 d-flex flex-column align-items-center">
                    <h2 class="text-center py-2 px-4 mb-5 border border-danger border-3 rounded">Agile</h2>
                </div>
            </div>
        </div>

    </div>

    <?php include "../footer/footer.html"; ?>

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="home.js"></script>
</body>

</html>