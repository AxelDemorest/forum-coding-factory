<?php

if(isset($_POST['submitInfo'])) {

    $valid = true;

    $errors = array();

    if(empty($_POST['pseudoModif']) || empty($_POST['emailModif'])) {

        $errors['nothing'] = "Un des champs n'a pas été complété.";

        $valid = false;

    }

    if(($_POST['pseudoModif'] === $_SESSION['auth']->pseudo) && ($_POST['emailModif'] === $_SESSION['auth']->mail)) {

        $errors['already'] = "Les deux champs n'ont pas été modifié...";

        $valid = false;

    }

    if($valid && empty($errors)) {

        $updateUser = $pdo->prepare('UPDATE users SET pseudo = ?, mail = ? WHERE id = ?');

        $updateUser->execute([$_POST['pseudoModif'], $_POST['emailModif'], $_SESSION['auth']->id]);

        $_SESSION['successMessageUpdateUser'] = "Profil modifié avec succès";

        $_SESSION["auth"]->pseudo = $_POST['pseudoModif'];

        $_SESSION["auth"]->mail = $_POST['emailModif'];
    }

}

if(isset($_POST['SubmitMdp'])) {

    $valid = true;

    $errors2 = array();

    if(empty($_POST['firstPassword']) || empty($_POST['secondPassword']) || empty($_POST['thirdPassword'])) {

        $errors2['nothing'] = "Un des champs n'a pas été complété.";

        $valid = false;

    } else {

        if($_POST['firstPassword'] != password_verify($_POST['firstPassword'], $_SESSION['auth']->password)) {

            $errors2['1'] = "Ancien mot de passe incorrect";
    
            $valid = false;
    
        }
    
        if($_POST['secondPassword'] !== $_POST['thirdPassword']) {
    
            $errors2['1'] = "Les deux nouveaux mots de passe ne correspondent pas";
    
            $valid = false;
    
        }
    
        if($valid && empty($errors2)) {
    
            $password = password_hash($_POST['secondPassword'], PASSWORD_BCRYPT);
    
            $updatePasswordUser = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
    
            $updatePasswordUser->execute([$password, $_SESSION['auth']->id]);
    
            $_SESSION['successMessageUpdatePasswordUser'] = "Mot de passe modifié avec succès";
    
            $_SESSION["auth"]->password = $password;
        }

    }

}