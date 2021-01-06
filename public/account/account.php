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
    include "../header/header.php"; ?>



    <div class="container-fluid d-flex p-2 justify-content-center">
        <div class="block ">
            <div class="d-flex p-2 justify-content-center align-items-center flex-column">
                <img src="../../img/avatar.jpg" alt="" class="cercle">
                <h2>NOM ET PRENOM</h2>
                <p>Classe : </p>
                <p>Age :</p>
                <p>Lieux de l'ecole (Paris ou Cergy)</p>
            </div>

        </div>
    </div>

                                                        
                            


     <?php include "../footer/footer.html";?>       
</body>
</html>