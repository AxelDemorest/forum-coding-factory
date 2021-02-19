<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="account.css">
    <link href="../header/header.css" rel="stylesheet" />
    <link href="../footer/footer.css" rel="stylesheet" />
    <title>Account - BlackBoard Factory</title>
</head>

<body>
    <?php session_start();

    include "../../functions/functions.php";

    require "../../database/db.php";

    include "form_profil.php";

    include "../header/header.php";

    ?>

    <div class="container my-5">
        <div class="row d-flex flew-row">
            <div class="col-4">
                <?php if (isset($_GET['id']) && !empty($_GET['id'])) :

                    $selectUserGet = $pdo->prepare('SELECT * FROM users WHERE id = ?');

                    $selectUserGet->execute([$_GET['id']]);

                    $selectUserGet = $selectUserGet->fetch(PDO::FETCH_ASSOC);

                    if (empty($selectUserGet)) : ?>

                        <h2>Utilisateur introuvable</h2>

                    <?php exit;

                    endif; ?>
                    <div class="d-flex flex-column align-items-center bg-white shadow-sm border border-1 rounded" style="position: sticky;top:120px;">
                        <img class="mt-4 border border-3 border-secondary" style="border-radius:50%" src="https://drone-geofencing.com/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png" alt="" width="30%">
                        <h4 class="mt-3"><?= strtoupper($selectUserGet['nom']); ?> <?= $selectUserGet['prenom']; ?> (<?= $selectUserGet['age']; ?>)</h4>
                        <p class="mt-2 text-muted">Alias <?= $selectUserGet['pseudo']; ?></p>
                        <p><strong>E-mail :</strong> <?= $selectUserGet['mail']; ?></p>
                        <p><strong>Classe :</strong> Classe</p>
                        <p><strong>École :</strong> Campus de <?= ucfirst($selectUserGet['position']); ?></p>
                        <p><strong>Statut :</strong> <?= ucfirst($selectUserGet['status']); ?></p>
                        <p><strong>Date d'inscription :</strong> <?= $selectUserGet['dateInscription']; ?></p>
                    </div>
                <?php else : ?>
                    <div class="d-flex flex-column align-items-center bg-white shadow-sm border border-1 rounded" style="position: sticky;top:120px;">
                        <img class="mt-4 border border-3 border-secondary" style="border-radius:50%" src="https://drone-geofencing.com/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png" alt="" width="30%">
                        <h4 class="mt-3"><?= strtoupper($_SESSION['auth']->nom); ?> <?= $_SESSION['auth']->prenom; ?> (<?= $_SESSION['auth']->age; ?>)</h4>
                        <p class="mt-2 text-muted">Alias <?= $_SESSION['auth']->pseudo; ?></p>
                        <p><strong>E-mail :</strong> <?= $_SESSION['auth']->mail; ?></p>
                        <p><strong>Classe :</strong> Classe</p>
                        <p><strong>École :</strong> Campus de <?= ucfirst($_SESSION['auth']->position); ?></p>
                        <p><strong>Statut :</strong> <?= ucfirst($_SESSION['auth']->status); ?></p>
                        <p><strong>Date d'inscription :</strong> <?= $_SESSION['auth']->dateInscription; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-8">

                <?php if (!isset($_GET['id']) || $_GET['id'] === $_SESSION['auth']->id) : ?>
                    <!-- Information utilisateur -->
                    <div class="d-flex flex-column align-items-center bg-white shadow-sm border border-1 rounded">
                        <div class="d-flex flex-column align-items-center">
                            <h3 class="mt-4 mb-5">Modifier ses informations</h3>
                            <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5">
                                <?php if (isset($_SESSION['successMessageUpdateUser'])) : ?>
                                    <div class="alert alert-success" style="font-size:14px;">
                                        <?= $_SESSION['successMessageUpdateUser']; ?>
                                    </div>
                                <?php
                                    unset($_SESSION['successMessageUpdateUser']);
                                endif; ?>
                                <?php if (!empty($errors)) : ?>
                                    <div class="alert alert-danger pb-0 mt-3" style="font-size:14px;">
                                        <ul>

                                            <?php foreach ($errors as $error) : ?>

                                                <li><?= $error; ?></li>

                                            <?php endforeach; ?>

                                        </ul>
                                    </div>

                                <?php endif; ?>
                                <form action="" method="post" style="font-size:15px">
                                    <label for="pseudoModif">Pseudo : </label>
                                    <input name="pseudoModif" id="pseudoModif" type="text" value="<?= $_SESSION['auth']->pseudo; ?>">
                                    <label class="ms-4" for="emailModif">E-mail : </label>
                                    <input name="emailModif" id="emailModif" type="email" value="<?= $_SESSION['auth']->mail; ?>">
                                    <input name="submitInfo" type="submit" class="btn btn-outline-secondary ms-4" style="font-size:14px" value="Modifier">
                                </form>
                            </div>
                            <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5 w-75">
                                <?php if (isset($_SESSION['successMessageUpdatePasswordUser'])) : ?>
                                    <div class="alert alert-success" style="font-size:14px;">
                                        <?= $_SESSION['successMessageUpdatePasswordUser']; ?>
                                    </div>
                                <?php
                                    unset($_SESSION['successMessageUpdatePasswordUser']);
                                endif; ?>
                                <?php if (!empty($errors2)) : ?>
                                    <div class="alert alert-danger pb-0 mt-3" style="font-size:14px;">
                                        <ul>

                                            <?php foreach ($errors2 as $error) : ?>

                                                <li><?= $error; ?></li>

                                            <?php endforeach; ?>

                                        </ul>
                                    </div>

                                <?php endif; ?>
                                <form class="d-flex flex-column justify-content-center align-items-center" action="" method="post" style="font-size:15px">
                                    <div class="mb-3">
                                        <label class="me-2" for="oldMdp">Ancien mot de passe : </label>
                                        <input name="firstPassword" id="oldMdp" type="password">
                                    </div>
                                    <div class="mb-3">
                                        <label class="me-2" for="newMdp">Nouveau mot de passe : </label>
                                        <input name="secondPassword" id="newMdp" type="password">
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-center me-2" for="new2Mdp">Confirmation du<br /> nouveau mot de passe : </label>
                                        <input name="thirdPassword" id="new2Mdp" type="password">
                                    </div>
                                    <input name="SubmitMdp" type="submit" class="btn btn-outline-secondary ms-4" style="font-size:14px" value="Modifier">
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Note de l'élève -->
                    <?php

                    $selectNotes = $pdo->prepare('SELECT * FROM note WHERE userId = ?');

                    $selectNotes->execute([$_SESSION['auth']->id]);

                    $selectNotes = $selectNotes->fetchAll(PDO::FETCH_ASSOC);

                    ?>


                    <div class="d-flex flex-column align-items-center bg-white shadow-sm border border-1 rounded <?= !isset($_GET['id']) ? "mt-5" : null ?>">
                        <div class="d-flex flex-column align-items-center w-100 mb-3">
                            <h3 class="mt-4 mb-4">Liste des notes</h3>

                            <table class="table table-bordered w-50">
                                <thead>
                                    <tr>
                                        <th>Matières</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($selectNotes as $key => $value) : ?>

                                        <?php

                                        $selectmatiere = $pdo->prepare('SELECT matiereName FROM matiere WHERE matiereId = ?');

                                        $selectmatiere->execute([$value['matiereId']]);

                                        $selectmatiere = $selectmatiere->fetch(PDO::FETCH_ASSOC);

                                        ?>

                                        <tr>
                                            <td><?= $selectmatiere['matiereName'] ?></td>
                                            <td><?= $value['note'] ?></td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                <?php
                endif;

                if (isset($_GET['id']) && !empty($_GET['id'])) :

                    $selectTotalVotesTopics = $pdo->prepare('SELECT COUNT(*) AS nb_votes_user_topics FROM votesTopics WHERE votesTopicsIdUser = ? AND votesTopicsStatus = "up"');

                    $selectTotalVotesTopics->execute([$_GET['id']]);

                    $selectTotalVotesTopics = $selectTotalVotesTopics->fetch(PDO::FETCH_ASSOC);

                    $selectTotalVotesComments = $pdo->prepare('SELECT COUNT(*) AS nb_votes_user_comments FROM votesComments WHERE votesCommentsIdUser = ? AND votesCommentsStatus = "up"');

                    $selectTotalVotesComments->execute([$_GET['id']]);

                    $selectTotalVotesComments = $selectTotalVotesComments->fetch(PDO::FETCH_ASSOC);

                    $totalVotesUser = $selectTotalVotesComments['nb_votes_user_comments'] + $selectTotalVotesTopics['nb_votes_user_topics'];

                    $selectListTopics = $pdo->prepare('SELECT * FROM topics WHERE idCreator = ?');

                    $selectListTopics->execute([$_GET['id']]);

                    $selectListTopics = $selectListTopics->fetchAll(PDO::FETCH_ASSOC);

                    $selectUserGet = $pdo->prepare('SELECT * FROM users WHERE id = ?');

                    $selectUserGet->execute([$_GET['id']]);

                    $selectUserGet = $selectUserGet->fetch(PDO::FETCH_ASSOC);
                ?>

                    <!-- Information forum -->
                    <div class="d-flex flex-column align-items-center bg-white shadow-sm border border-1 rounded <?= !isset($_GET['id']) || $_GET['id'] === $_SESSION['auth']->id ? "mt-5" : null ?>">
                        <div class="d-flex flex-column align-items-center w-100">
                            <h3 class="mt-4 mb-5">Informations du forum</h3>
                            <div class="d-flex flex-row">
                                <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5">
                                    <h5>Messages sur le forum</h5>
                                    <p style="font-size:13px" class="text-muted">Nombre de messages postés<br /> sur le forum</p>
                                    <h6><?= $selectUserGet['numberMessage']; ?></h6>
                                </div>
                                <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5 ms-4">
                                    <h5>Nombre de votes positifs</h5>
                                    <p style="font-size:13px" class="text-muted">Nombre de votes positifs donnés par d'autres<br /> utilisateurs aux topics/réponses</p>
                                    <h6><?= $totalVotesUser ?></h6>
                                </div>
                            </div>
                            <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5 w-75">
                                <h5>Topics créés</h5>
                                <div class="d-flex justify-content-center flex-wrap mt-3" style="max-height:20em;overflow:scroll;">
                                    <?php foreach ($selectListTopics as $key => $value) : ?>
                                        <div class="bg-white border border-1 rounded px-3 py-2 me-3 mb-3" style="width:45%">
                                            <a target="_blank" href="http://localhost:8888/forum-coding-factory/public/forum/topic.php?idCategory=<?= $value['idCategory'] ?>&id=<?= $value['idTopic'] ?>" class="text-dark text-decoration-none"><?= $value['titleTopic']; ?></a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else :

                    $selectTotalVotesTopics = $pdo->prepare('SELECT COUNT(*) AS nb_votes_user_topics FROM votesTopics WHERE votesTopicsIdUser = ? AND votesTopicsStatus = "up"');

                    $selectTotalVotesTopics->execute([$_SESSION['auth']->id]);

                    $selectTotalVotesTopics = $selectTotalVotesTopics->fetch(PDO::FETCH_ASSOC);

                    $selectTotalVotesComments = $pdo->prepare('SELECT COUNT(*) AS nb_votes_user_comments FROM votesComments WHERE votesCommentsIdUser = ? AND votesCommentsStatus = "up"');

                    $selectTotalVotesComments->execute([$_SESSION['auth']->id]);

                    $selectTotalVotesComments = $selectTotalVotesComments->fetch(PDO::FETCH_ASSOC);

                    $totalVotesUser = $selectTotalVotesComments['nb_votes_user_comments'] + $selectTotalVotesTopics['nb_votes_user_topics'];

                    $selectListTopics = $pdo->prepare('SELECT * FROM topics WHERE idCreator = ?');

                    $selectListTopics->execute([$_SESSION['auth']->id]);

                    $selectListTopics = $selectListTopics->fetchAll(PDO::FETCH_ASSOC);
                ?>

                    <!-- Information forum -->
                    <div class="d-flex flex-column align-items-center bg-white shadow-sm border border-1 rounded <?= !isset($_GET['id']) ? "mt-5" : null ?>">
                        <div class="d-flex flex-column align-items-center w-100">
                            <h3 class="mt-4 mb-5">Informations du forum</h3>
                            <div class="d-flex flex-row">
                                <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5">
                                    <h5>Messages sur le forum</h5>
                                    <p style="font-size:13px" class="text-muted">Nombre de messages postés<br /> sur le forum</p>
                                    <h6><?= $_SESSION['auth']->numberMessage; ?></h6>
                                </div>
                                <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5 ms-4">
                                    <h5>Nombre de votes positifs</h5>
                                    <p style="font-size:13px" class="text-muted">Nombre de votes positifs donnés par d'autres<br /> utilisateurs aux topics/réponses</p>
                                    <h6><?= $totalVotesUser ?></h6>
                                </div>
                            </div>
                            <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5 w-75">
                                <h5>Topics créés</h5>
                                <div class="d-flex justify-content-center flex-wrap mt-3" style="max-height:20em;overflow:scroll;">
                                    <?php foreach ($selectListTopics as $key => $value) : ?>
                                        <div class="bg-white border border-1 rounded px-3 py-2 me-3 mb-3" style="width:45%">
                                            <a target="_blank" href="http://localhost:8888/forum-coding-factory/public/forum/topic.php?idCategory=<?= $value['idCategory'] ?>&id=<?= $value['idTopic'] ?>" class="text-dark text-decoration-none"><?= $value['titleTopic']; ?></a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include "../footer/footer.html"; ?>
</body>

</html>