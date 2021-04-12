





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../header/header.css" rel="stylesheet" />
    <link href="nouveaute.css" rel="stylesheet" />





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Forum - Coding factory</title>


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

        <!-- nouveaute -->

        <article class="col-md-12">
       
        <!-- BLOG CARDS -->
        
        <div class="cards-1 section-gray">
            <div class="container">
                <div class="row">

                    <!-- une card --> 

                    <div class="col-md-4">

                        <div class="card card-blog">
                            <div class="card-image">
                                <a href="#"> <img class="img" src="http://adamthemes.com/demo/code/cards/images/blog01.jpeg">
                                    <div class="card-caption"> Quisque a bibendum magna </div>
                                </a>
                                <div class="ripple-cont"></div>
                            </div>
                            <div class="table">
                                <h6 class="category text-info">Cinema</h6>
                                <p class="card-description"> Lorem ipsum dolor sit amet, consectetur adipis cingelit. Etiam lacinia elit et placerat finibus. Praesent justo metus, pharetra vel nibh sit amet, tincidunt posuere nulla. Vivamus odio antement, feugiat eget nisi sit amet, scelerisque dignissim velit antement. </p>
                            </div>
                        </div>

                    </div>

                        <!-- fin card -->



                    <!-- une card --> 

                    <div class="col-md-4">

                        <div class="card card-blog">
                            <div class="card-image">
                                <a href="#"> <img class="img" src="http://adamthemes.com/demo/code/cards/images/blog01.jpeg">
                                    <div class="card-caption"> le Site contient maintenant un caht vocal </div>
                                </a>
                                <div class="ripple-cont"></div>
                            </div>
                            <div class="table">
                                <h6 class="category text-info">Cinema</h6>
                                <p class="card-description"> Lorem ipsum dolor sit amet, consectetur adipis cingelit. Etiam lacinia elit et placerat finibus. Praesent justo metus, pharetra vel nibh sit amet, tincidunt posuere nulla. Vivamus odio antement, feugiat eget nisi sit amet, scelerisque dignissim velit antement. </p>
                            </div>
                        </div>

                    </div>

                        <!-- fin card -->
                        

          

            <!-- une card --> 

            <div class="col-md-4">

                        <div class="card card-blog">

                            <div class="card-image">
                                <a href="#"> <img class="img" src="https://i.ytimg.com/vi/EYuAnYXl6Xg/maxresdefault.jpg"> </a>
                                <div class="ripple-cont"></div>
                            </div>

                            <div class="table">
                                <h6 class="category text-warning">
                                            <i class="fa fa-soundcloud"></i> Music   <!-- titre de l'article -->
                                        </h6>

                                <h4 class="card-caption">
                                <a href="#">nouvelle album de ashe 22 </a> <!-- sous titre -->
                            </h4>

                                <div class="ftr">    <!-- personne qui a ecrit l'arcticle ou commentaire -->
                                    <div class="author">
                                        <a href="#"> <img src="../nous/axel.png" alt="..." class="avatar img-raised"> <span>Demorest Axel </span> </a> 
                                    </div>
                                    <div class="stats"> <i class="fa fa-clock-o"></i> 15 min </div>  <!-- combien de temp le poste a été poster -->
                                </div>

                            </div>

                        </div>

            </div>


   <!-- fin card -->



         

            <!-- une card --> 

            <div class="col-md-4">

                        <div class="card card-blog">

                            <div class="card-image">
                                <a href="#"> <img class="img" src="https://i.ytimg.com/vi/EYuAnYXl6Xg/maxresdefault.jpg"> </a>
                                <div class="ripple-cont"></div>
                            </div>

                            <div class="table">
                                <h6 class="category text-warning">
                                            <i class="fa fa-soundcloud"></i> Music   <!-- titre de l'article -->
                                        </h6>

                                <h4 class="card-caption">
                                <a href="#">nouvelle album de ashe 22 </a> <!-- sous titre -->
                            </h4>

                                <div class="ftr">    <!-- personne qui a ecrit l'arcticle ou commentaire -->
                                    <div class="author">
                                        <a href="#"> <img src="../nous/axel.png" alt="..." class="avatar img-raised"> <span>Demorest Axel </span> </a> 
                                    </div>
                                    <div class="stats"> <i class="fa fa-clock-o"></i> 15 min </div>  <!-- combien de temp le poste a été poster -->
                                </div>

                            </div>

                        </div>

            </div>


   <!-- fin card -->








            <!-- une card --> 

            <div class="col-md-4">

                        <div class="card card-blog">

                            <div class="card-image">
                                <a href="#"> <img class="img" src="https://i.ytimg.com/vi/EYuAnYXl6Xg/maxresdefault.jpg"> </a>
                                <div class="ripple-cont"></div>
                            </div>

                            <div class="table">
                                <h6 class="category text-warning">
                                            <i class="fa fa-soundcloud"></i> Music   <!-- titre de l'article -->
                                        </h6>

                                <h4 class="card-caption">
                                <a href="#">nouvelle album de ashe 22 </a> <!-- sous titre -->
                            </h4>

                                <div class="ftr">    <!-- personne qui a ecrit l'arcticle ou commentaire -->
                                    <div class="author">
                                        <a href="#"> <img src="../nous/axel.png" alt="..." class="avatar img-raised"> <span>Demorest Axel </span> </a> 
                                    </div>
                                    <div class="stats"> <i class="fa fa-clock-o"></i> 15 min </div>  <!-- combien de temp le poste a été poster -->
                                </div>

                            </div>

                        </div>

            </div>


   <!-- fin card -->





                    <!-- une card --> 

                    <div class="col-md-4">

                        <div class="card card-blog">
                            <div class="card-image">
                                <a href="#"> <img class="img" src="http://adamthemes.com/demo/code/cards/images/blog01.jpeg">
                                    <div class="card-caption"> Quisque a bibendum magna </div>
                                </a>
                                <div class="ripple-cont"></div>
                            </div>
                            <div class="table">
                                <h6 class="category text-info">Cinema</h6>
                                <p class="card-description"> Lorem ipsum dolor sit amet, consectetur adipis cingelit. Etiam lacinia elit et placerat finibus. Praesent justo metus, pharetra vel nibh sit amet, tincidunt posuere nulla. Vivamus odio antement, feugiat eget nisi sit amet, scelerisque dignissim velit antement. </p>
                            </div>
                        </div>

                    </div>

                        <!-- fin card -->





                </div>
            </div>
        </div>
        






        <!-- fin nouveate -->




    <!-- Javascript -->
    <script src="../header/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>