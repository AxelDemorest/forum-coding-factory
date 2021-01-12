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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Forum - Coding factory</title>
</head>

<body>

    <?php session_start();

    include "../header/header.php"; ?>

    <!-- Header -->
    <header class="header shadow d-flex justify-content-center align-items-center flex-column">
        <h1 class="text-white fw-bold text-center fst-italic" style="font-size:6em;letter-spacing:1px">Bienvenue sur BlackBoard Factory</h1>
        <div class="hr-title-header bg-white rounded-pill mt-5"></div>
    </header>

    <!-- Body Page -->
    <div class="container py-5">
        <div class="row">
            <div class="description-website col-12 col-lg-6 text-center d-flex flex-column justify-content-center">
                <h1>BlackBoard Factory</h1>
                <div class="hr-body mx-auto mb-3 mt-1"></div>
                <p class="fz-text pt-3 fs-5">Le forum a été conçu pour les élèves de la Coding Factory de Paris et Cergy. Les
                    élèves pourront répondre aux questions de leurs camarades avec le forum proposé sur ce site.
                    Différentes fonctionnalités sont dispnibles pour que l'expérience utilisateur soit la meilleure
                    possible. Les élèves pourront avancer ensemble et progresser rapidement avec l'entraide.</p>
            </div>
            <div class="col-12 col-lg-6 ps-lg-5 pt-5 pt-lg-0 d-flex justify-content-center">
                <img class="img-fluid" src="../../img/web-design.gif">
            </div>
        </div>
    </div>

    <div class="sp-line d-flex justify-content-center">
        <a href="http://localhost:8888/forum-coding-factory/public/home/home.php#list-points">
            <div class="intext-line rounded-circle bg-white d-flex justify-content-center align-items-center">
                <img src="../../img/icon-home/arrow.png" width="12">
            </div>
        </a>
    </div>

    <!-- Principal points of the website -->
    <div class="container-fluid pt-5" id="list-points">
            <div class="row d-flex justify-content-center align-items-center justify-content-center flex-wrap mx-4 py-5">
                <div class="col-3 me-4 d-flex flex-column align-items-center pb-5">
                    <img src="../../img/icon-home/discussion.png" class="img-point" width="30%" alt="">
                    <p class="fz-text mt-4 text-center fs-5">
                        Un espace forum a été mis en place pour tous les élèves. Si vous avez des questions, ou si vous avez un quelconque problème, n'hésitez pas à vous renseigner auprès des autres élèves ou des PO dans l'espace dédié.
                    </p>
                </div>
                <div class="col-3 mx-4 d-flex flex-column align-items-center pb-5">
                    <img src="../../img/icon-home/blog.png" class="img-point" width="30%" alt="">
                    <p class="fz-text mt-4 text-center fs-5">
                    Un espace Blog est disponible pour tous, toute l'actualité de la Coding Factory y est partagée. Une équipe de rédacteur se charge de rédiger les articles. N'hésitez pas à aller écrire un petit commentaire !
                    </p>
                </div>
                <div class="col-3 mx-4 d-flex flex-column align-items-center pb-5">
                    <img src="../../img/icon-home/voice-search.png" class="img-point" width="30%" alt="">
                    <p class="fz-text mt-4 text-center fs-5">
                    Vous souhaitez discuter avec vos camarades sans aller sur discord ? C'est possible, un espace discussion est dédié pour cela. Vous pouvez rejoindre des salons vocaux pour discuter avec les personnes connectées.
                    </p>
                </div>
                <div class="col-3 mx-4 d-flex flex-column align-items-center">
                    <img src="../../img/icon-home/ranking.png" class="img-point" width="30%" alt="">
                    <p class="fz-text mt-4 text-center fs-5">
                    Vous souhaitez être récompenser de votre activité ? Nous avons confectionné pour vous, un classement des utilisateurs les plus actifs et les plus populaires.
                    </p>
                </div>
                <div class="col-3 ms-4 d-flex flex-column align-items-center">
                    <img src="../../img/icon-home/levels.png" class="img-point" width="30%" alt="">
                    <p class="fz-text mt-4 text-center fs-5">
                    Gagnez des niveaux tout en postant des messages sur le forum. Ces niveaux vous permettent de gagner des badges pour votre profil et débloquer des petites fonctionnalités dans l'onglet "Boutique" !
                    </p>
                </div>
            </div>
    </div>


    <?php

    /* require_once '../../database/db.php';

    $req = $pdo->prepare("SELECT * FROM users ORDER BY dateInscription DESC LIMIT 0, 4");

    $req->execute();

    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

    require '../../functions/functions.php' */

    ?>

    <!-- Container de la liste des nouveaux utilisateurs -->
    <!--  <div class="bg-light">
        <div class="container-fluid">
            <h1 class="text-center py-4">Les derniers utilisateurs inscrits !</h1>
            <div class="row justify-content-center">
                <?php foreach ($resultat as $listUser => $userParameter) : ?>
                    <div class="col-8 col-sm-4 col-lg-3 col-xl-2 mx-4 mb-4 mt-2 border border-secondary rounded fz-text" style="height: 10em;">
                        <h5 class="text-center pt-3"><?php echo $userParameter['pseudo']; ?></h5>
                        <div class="bg-danger mx-auto rounded-pill" style="height: 4px; width: 20%;"></div>
                        <p class="text-center pt-2 mb-1">Date de création :</p>
                        <p class="text-center pt-1" style="margin-bottom: 5px;"><?php echo $userParameter['dateInscription']; ?></p>
                        <p class="text-center"><?php badge_color($userParameter['status']);
                                                if ($userParameter['rank'] == 1) {
                                                    echo ' <span class="badge text-dark rounded-pill bg-warning">Administrateur</span>';
                                                } ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div> -->

    <?php include "../footer/footer.html"; ?>

    <!-- Javascript -->
    <script src="../header/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="home.js"></script>

</body>

</html>