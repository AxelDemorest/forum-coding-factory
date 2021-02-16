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
    <link rel="stylesheet" type="text/css" href="note.css">

    <title>Pages Note</title>
</head>

<body>
    <?php

    include "../header/header.php";

    //Je récupère toutes les classes
    $fetchAllClasses = $pdo->query('SELECT classeName FROM classe');

    $fetchAllClasses = $fetchAllClasses->fetchAll(PDO::FETCH_ASSOC);

    //Je récupère toutes les matières
    $fetchAllMatieres = $pdo->query('SELECT matiereName FROM matiere');

    $fetchAllMatieres = $fetchAllMatieres->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <div class="d-flex flex-column align-items-center mt-5 mb-5">

        <div class="d-flex flex-column align-items-center">
            <h3>Choisir la classe</h3>
            <div class="mt-3">
                <?php foreach ($fetchAllClasses as $key => $value) : ?>
                    <?php if ($value['classeName'] !== "sans classe") : ?>
                        <a href="http://localhost:8888/forum-coding-factory/public/account/note.php?classe=<?= urlencode($value['classeName']) ?>" type="button" class="btn btn-outline-danger mx-2"><?= ucfirst($value['classeName']) ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if (isset($_GET['classe']) && !empty($_GET['classe'])) : ?>

            <div class="d-flex flex-column align-items-center mt-5">
                <h3>Choisir la matière</h3>
                <div class="mt-3">
                    <?php foreach ($fetchAllMatieres as $key => $value) : ?>
                        <a href="http://localhost:8888/forum-coding-factory/public/account/note.php?classe=<?= urlencode($_GET['classe']) ?>&matiere=<?= urlencode($value['matiereName']) ?>" type="button" class="btn btn-outline-danger mx-2"><?= ucfirst($value['matiereName']) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php endif; ?>

        <?php if (isset($_GET['classe']) && isset($_GET['matiere']) && !empty($_GET['classe']) && !empty($_GET['matiere'])) :

            $fetchAllEleves = $pdo->prepare('SELECT * FROM users LEFT JOIN classe ON users.classeId = classe.classeId WHERE classeName = ? ORDER BY nom');

            $fetchAllEleves->execute([urldecode($_GET['classe'])]);

            $fetchAllEleves = $fetchAllEleves->fetchAll(PDO::FETCH_ASSOC);

        ?>

            <div class="d-flex flex-column align-items-center mt-5">
                <h3>Les élèves</h3>
                <?php if (!empty($fetchAllEleves)) : ?>
                    <?php if (!empty($errors)) : ?>
                        <div class="alert alert-danger pb-0 mt-3">
                            <ul>

                                <?php foreach ($errors as $error) : ?>

                                    <li><?= $error; ?></li>

                                <?php endforeach; ?>

                            </ul>
                        </div>

                    <?php endif; ?>
                    <p class="text-muted mt-3">Remplir et envoyer un formulaire à la fois.</p>
                    <table class="table table-bordered border-secondary rounded">
                        <thead>
                            <tr>
                                <th>Matière</th>
                                <th>Élève</th>
                                <th>Note</th>
                                <th>Envoyer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($fetchAllEleves as $key => $value) : ?>
                                <tr>
                                    <td class="text-center"> <?= $_GET['matiere'] ?> </td>
                                    <form action="" method="POST">
                                        <td> <input type="hidden" name="pseudo" placeholder="Note de l'élève" value="<?= $value['pseudo'] ?>" /> <input type="text" name="pseudo" placeholder="Note de l'élève" value="<?= strtoupper($value['nom']) ?> <?= $value['prenom'] ?>" readonly /> </td>
                                        <td> <input type="text" name="note" placeholder="Note de l'élève" /> </td>
                                        <td> <input type="submit" name="submit" class="btn btn-danger"></td>
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <h4 class="mt-3">Aucun élève dans cette classe</h4>
                <?php endif; ?>
            </div>

        <?php endif; ?>

    </div>

    <!-- Footer -->
    <?php include "../footer/footer.html"; ?>

    <!-- Javascript -->
    <script src="../../header/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>