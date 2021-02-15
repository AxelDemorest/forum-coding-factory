<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="accountModif.css">
    <link href="../header/header.css" rel="stylesheet" />
    <link href="../footer/footer.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modif-Compte</title>
</head>
<body>
<?php session_start();
    include "../header/header.php"; ?>
 

 <div class="container-fluid d-flex p-2 justify-content-center">
        <div class="block">
            <h1>Parametre Profil </h1>
            <form method="POST" action="">
            <ul>
            <p class="Ps"> Pseudo : <input name="pseudo" type="text" placeholder="Pseudo" ></p> 
<!--             <p class="Cl"> Classe : <input name="classe" type="text" placeholder="Classe"></p> -->
            <p class="Age">Age    : <input  name="age" type="text" placeholder="Age"></p>
            <p class="Li"> Lieux  : <input name="lieux" type="text" placeholder="Lieux"></p>
            <button name="submit" type="submit" value="valider">Valider</button>
            </ul>
            </form>

        </div>
    </div>

    <?php 

    require_once '../../database/db.php';

    // Vérifier si le formulaire est soumis 
   if ( isset( $_POST['submit'] ) ) {
    /* récupérer les données du formulaire en utilisant 
       la valeur des attributs name comme clé 
      */
    $pseudo = $_POST['pseudo']; 
/*     $classe = $_POST['classe']; */
    $age = $_POST['age']; 
    $lieux = $_POST['lieux'];

    $req = $pdo->prepare('UPDATE users SET pseudo = ?, age = ?, position = ? WHERE id = ?');

    $req->execute([$pseudo , $age , $lieux, $_SESSION["auth"]->id]);

    $_SESSION["auth"]->pseudo = $pseudo;
    $_SESSION["auth"]->age = $age;
    $_SESSION["auth"]->position = $lieux;
   }

    

    ?>
 


 <?php include "../footer/footer.html";?>
</body>
</html>