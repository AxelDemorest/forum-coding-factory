<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
    <div class="header pt-5 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="bg-dark p-3 opacity-bg">
                        <h1 class="text-white">Learn, Together</h1>
                    </div>
                    <form class="form-inline my-5 w-100 d-flex justify-content-center fz-text">
                        <input class="form-control mr-sm-2 w-75" type="search" placeholder="Recherche un sujet" aria-label="Search">
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
            <div class="col-12 col-lg-6 pl-lg-5 pt-5 pt-lg-0 d-flex justify-content-center">
                <img class="img-fluid" src="../../img/web-design.gif">
            </div>
        </div>
    </div>

    <!-- Chat en direct -->
    <div style="margin-top: 5em;" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">

                </div>
            </div>
        </div>
    </div>


    <!-- Container de la liste des nouveaux utilisateurs -->
    <div class="container">
        <div class="row d-flex justify-content-center">
            <h1 class="pt-5 mt-3">Les derniers utilisateurs inscrits</h1>
            <!-- Liste des utilisateurs -->


        </div>
    </div>

    <?php include "../footer/footer.html"; ?>

    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="home.js"></script>
</body>

</html>