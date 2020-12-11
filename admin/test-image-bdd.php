<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>dashboard - Forum Factory</title>
</head>

<body>

<?php

    require_once '../database/db.php';

    if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {

        $tailleMax = 2097152;
        $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');

        if($_FILES['avatar']['size'] <= $tailleMax) {
            $extensionUpload = strtolower(substr(strchr($_FILES['avatar']['name'], '.'), 1));
            if(in_array($extensionUpload, $extensionsValides)) {
                $chemin = "../img/imgCategory/test.".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

                echo $_FILES['avatar']['name'];

                if($resultat) {
                /*     $updateavatar = $pdo->prepare("
                    INSERT INTO test(avatar)
                    VALUES (:avatar)
                ");
                    $updateavatar->execute([
                        'avatar' => 'test'.$extensionUpload
                    ]); */
                } else {
                    echo "il y a eu une erreur pendant l'importation du fichier";
                }
            } else {
                echo "La pdp doit être au format jpg, jpeg, gif ou png";
            }
        } else {
            echo "c'est foiré";
        }
    }

?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input name="avatar" class="form-control" type="file" id="formFile">
        </div>
        <button name="formImage" type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>