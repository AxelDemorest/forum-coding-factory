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
</head>

<body>

    <?php session_start();

    include "../header/header.php"; ?>

    <!-- Header -->
    <div class="header d-flex align-items-center" style="padding-top: 59px">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="bg-dark p-3 opacity-bg">
                        <h1 class="text-white">Learn, Together</h1>
                    </div>
                    <form class="form-inline my-5 w-100 d-none d-md-flex justify-content-md-center fz-text">
                        <input class="form-control me-sm-2 w-75" type="search" placeholder="Recherche un sujet" aria-label="Search">
                        <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Body Page -->
    <div class="container pt-5">
        <div class="row">
            <div class="col-12 col-lg-6 text-center d-flex flex-column justify-content-center">
                <h1>Forum Factory</h1>
                <div class="hr-body mx-auto mb-3 mt-1"></div>
                <p class="fz-text pt-3">Le forum a été conçu pour les élèves de la Coding Factory de Paris et Cergy. Les
                    élèves pourront répondre aux questions de leurs camarades avec le forum proposé sur ce site.
                    Différentes fonctionnalités sont dispnibles pour que l'expérience utilisateur soit la meilleure
                    possible. Les élèves pourront avancer ensemble et progresser rapidement avec l'entraide.</p>
            </div>
            <div class="col-12 col-lg-6 ps-lg-5 pt-5 pt-lg-0 d-flex justify-content-center">
                <img class="img-fluid" src="../../img/web-design.gif">
            </div>
        </div>
    </div>

    <?php

    require_once '../../database/db.php';

    $req = $pdo->prepare("SELECT * FROM users ORDER BY dateInscription DESC LIMIT 0, 4");

    $req->execute();

    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

    require '../../functions/functions.php'

    ?>

    <!-- Container de la liste des nouveaux utilisateurs -->
    <div class="bg-light">
        <div class="container-fluid">
            <h1 class="text-center py-4">Les derniers utilisateurs inscrits !</h1>
            <div class="row justify-content-center">
                <?php foreach ($resultat as $listUser => $userParameter) : ?>
                    <div class="col-8 col-sm-4 col-lg-3 col-xl-2 mx-4 mb-4 mt-2 border border-secondary rounded fz-text" style="height: 10em;">
                        <h5 class="text-center pt-3"><?php echo $userParameter['pseudo']; ?></h5>
                        <div class="bg-danger mx-auto rounded-pill" style="height: 4px; width: 20%;"></div>
                        <p class="text-center pt-2 mb-1">Date de création :</p>
                        <p class="text-center pt-1" style="margin-bottom: 5px;"><?php echo $userParameter['dateInscription']; ?></p>
                        <p class="text-center"><?php badge_color($userParameter['status']); if($userParameter['rank'] == 1) { echo ' <span class="badge text-dark rounded-pill bg-warning">Administrateur</span>'; } ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php include "../footer/footer.html"; ?>

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="home.js"></script>
</body>

</html>