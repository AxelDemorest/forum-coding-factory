<?php

session_start();

require_once '../../database/db.php';

/**
 * TODO:
 * - Afficher les notes de chaque élève quand il regarde son profil
 */

if (isset($_POST['submit'])) {

    $errors = array();

    $valid = true;

    if (empty($_POST['note']) && $_POST['note'] != 0) {
        $errors['nothingInput'] = "Un des champs de la ligne n'a pas été complété";
        $valid = false;
    }

    if ($valid && empty($errors)) {

        //Je récupère l'id de l'user
        $fetchUserId = $pdo->prepare('SELECT id FROM users WHERE pseudo = ?');

        $fetchUserId->execute([$_POST['pseudo']]);

        $fetchUserId = $fetchUserId->fetch();

        //Je récupère l'id de la matière dans l'url
        $fetchMatiere = $pdo->prepare('SELECT matiereId FROM matiere WHERE matiereName = ?');

        $fetchMatiere->execute([$_GET['matiere']]);

        $fetchMatiere = $fetchMatiere->fetch();

        //Je regarde si la note de l'user dans cette matière existe déjà
        $fetchUserMatiere = $pdo->prepare('SELECT * FROM note WHERE userId = ? AND matiereId = ?');

        $fetchUserMatiere->execute([$fetchUserId->id, $fetchMatiere->matiereId]);

        $fetchUserMatiere = $fetchUserMatiere->fetch();

        //Si elle existe, je l'update dans la table note
        if (!empty($fetchUserMatiere)) {

            $updateNote = $pdo->prepare('UPDATE note SET note = ? WHERE userId = ? AND matiereId = ?');

            $updateNote->execute([$_POST['note'], $fetchUserId->id, $fetchMatiere->matiereId]);

            //Si non, je l'ajoute à la table
        } else {

            $insertNote = $pdo->prepare('INSERT INTO note(userId, note, matiereId) VALUES (?, ?, ?)');

            $insertNote->execute([$fetchUserId->id, $_POST['note'], $fetchMatiere->matiereId]);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../header/header.css" rel="stylesheet" />
    <link href="../footer/footer.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="nouveaute.css">

    <title>Pages Note</title>
</head>

<body>
    <?php

    include "../header/header.php";

    ?>


    <div class="card" style="width: 20rem;">
        <img src="new.gif" class="card-img-top row align-items-center " alt="gifNew">
            <div class="card-body">
                <p class="card-text" > BIenvenue sur la page 1 des nouveauter en essaie ajzbfzaibdizab doauzbdoaz bdoazdboazidbazodbazldbazdlbazdjazjdkbazkj</p>
            </div>
    </div>



            

    <!-- Footer -->
    <?php include "../footer/footer.html"; ?>

    <!-- Javascript -->
    <script src="../../header/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>