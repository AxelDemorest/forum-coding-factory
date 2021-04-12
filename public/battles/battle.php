<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="battle.css">
    <link href="../header/header.css" rel="stylesheet" />
    <link href="../footer/footer.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body>

    <?php session_start();

    include "../../functions/functions.php";

    require "../../database/db.php";

    include "../header/header.php";

    ?>

    <div class="container-fluid fz-text">
        <div class="block-battles">

        </div>
        <div class="list-battles-on">
            <h4 class="mx-auto text-center mt-4">Battles en cours</h4>
        </div>
    </div>

</body>

</html>