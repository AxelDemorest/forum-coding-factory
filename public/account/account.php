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

    include "../header/header.php"; ?>

    <div class="container my-5">
        <div class="row d-flex flew-row">
            <div class="col-4">
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
            </div>
            <div class="col-8">

                <!-- Information utilisateur -->
                <div class="d-flex flex-column align-items-center bg-white shadow-sm border border-1 rounded">
                    <div class="d-flex flex-column align-items-center">
                        <h3 class="mt-4 mb-5">Modifier ses informations</h3>
                        <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5">
                            <form action="" style="font-size:15px">
                                <label for="pseudoModif">Pseudo : </label>
                                <input name="pseudoModif" id="pseudoModif" type="text" value="<?= $_SESSION['auth']->pseudo; ?>">
                                <label class="ms-4" for="emailModif">E-mail : </label>
                                <input name="mailModif" id="emailModif" type="text" value="<?= $_SESSION['auth']->mail; ?>">
                                <input name="submitInfo" type="submit" class="btn btn-outline-secondary ms-4" style="font-size:14px" value="Modifier">
                            </form>
                        </div>
                        <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5 w-75">
                            <form class="d-flex flex-column justify-content-center align-items-center" action="" style="font-size:15px">
                                <div class="mb-3">
                                    <label class="me-2" for="pseudoModif">Ancien mot de passe : </label>
                                    <input name="firstPassword" id="pseudoModif" type="text">
                                </div>
                                <div class="mb-3">
                                    <label class="me-2" for="emailModif">Nouveau mot de passe : </label>
                                    <input name="secondPassword" id="emailModif" type="text">
                                </div>
                                <div class="mb-3">
                                    <label class="text-center me-2" for="emailModif">Confirmation du<br /> nouveau mot de passe : </label>
                                    <input name="thirdPassword" id="emailModif" type="text">
                                </div>
                                <input name="SubmitMdp" type="submit" class="btn btn-outline-secondary ms-4" style="font-size:14px" value="Modifier">
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Information forum -->
                <div class="d-flex flex-column align-items-center bg-white shadow-sm border border-1 rounded mt-5">
                    <div class="d-flex flex-column align-items-center w-100">
                        <h3 class="mt-4 mb-5">Informations du forum</h3>
                        <div class="d-flex flex-row">
                            <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5">
                                <h5>Messages sur le forum</h5>
                                <h6><?= $_SESSION['auth']->numberMessage; ?></h6>
                            </div>
                            <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5 ms-4">
                                <h5>Nombre de votes positifs</h5>
                                <h6><?= $_SESSION['auth']->numberMessage; ?></h6>
                            </div>
                        </div>
                        <div class="bg-white shadow-sm border border-1 rounded p-3 mb-5 w-75">
                            <h5>Topics crées</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--     <div class="container-fluid d-flex p-2 justify-content-center">
        <div class="block">
            <div class="d-flex  justify-content-center align-items-center flex-column">
                <img src="../../img/avatar.jpg" alt="" class="cercle">
                <h2><?php echo $_SESSION['auth']->pseudo; ?> </h2>
                <p>Classe : <?php echo $_SESSION['auth']->status; ?> </p>
                <p>Age : <?php echo $_SESSION['auth']->age; ?> </p>
                <p>Lieux de l'ecole: <?php echo $_SESSION['auth']->position; ?> </p>
                <a href="accountModif.php"><button>Modifier profil</button></a>
            </div>

        </div>
    </div> -->
    <?php include "../footer/footer.html"; ?>
</body>

</html>