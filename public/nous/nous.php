<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../header/header.css" rel="stylesheet" />
    <link href="nous.css" rel="stylesheet" />

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


<!-- profil -->


<div class="team-grid">
     <div class="container">
         <div class="intro">
             <h2 class="text-center">Nous </h2>   <!-- titre -->
             <p class="text-center"> oueoue blabla l'ekip  </p>   <!-- si on veut sous titre -->
         </div>
         <div class="row people d-flex justify-content-center">

            <div class="col-md-4 col-lg-3 item"> 
                 <div class="box" style="background-image:url(axel.png)">
                     <div class="cover"  >
                     <a href="/forum-coding-factory/public/message/message.php" >
                         <h3 class="name">Demorest Axel </h3>
                         <p class="title">Son Profil </p>
                         <div class="social"> <a href="#"> <i class="fa fa-github"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a>  <a href="#"><i class="fa fa-twitter"></i></a> </div>
                        </a>
                     </div>
                 </div>
             </div>
            

             <div class="col-md-4 col-lg-3 item">
                 <div class="box" style="background-image:url(alexis.png)">
                     <div class="cover">
                     <a href="/forum-coding-factory/public/nous/alexis.php" >
                         <h3 class="name">Majchrzak Alexis </h3>
                         <p class="title">Son Profil </p>
                         <div class="social"> <a href="#"> <i class="fa fa-github"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a>  <a href="#"><i class="fa fa-twitter"></i></a> </div>
                         </a>
                     </div>
                 </div>
             </div>


             <div class="col-md-4 col-lg-3 item">
                 <div class="box" style="background-image:url(angel.png)">
                 <div class="cover"  >
                     <a href="/forum-coding-factory/public/message/message.php" >
                         <h3 class="name">Demorest Axel </h3>
                         <p class="title">Son Profil </p>
                         <div class="social"> <a href="#"> <i class="fa fa-github"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a>  <a href="#"><i class="fa fa-twitter"></i></a> </div>
                        </a> </div>
                 </div>
             </div>

             <div class="col-md-4 col-lg-3 item">
                 <div class="box" style="background-image:url(merwan.png)">
                 <div class="cover"  >
                     <a href="/forum-coding-factory/public/message/message.php" >
                         <h3 class="name">Demorest Axel </h3>
                         <p class="title">Son Profil </p>
                         <div class="social"> <a href="#"> <i class="fa fa-github"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a>  <a href="#"><i class="fa fa-twitter"></i></a> </div>
                        </a> </div>
                 </div>
             </div>


         </div>
     </div>
 </div>






<!-- fin profil -->


    <!-- Javascript -->
    <script src="../header/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>