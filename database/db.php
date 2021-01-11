<?php

    //Création de la base de donnée
    $servname = "localhost"; // Je travail en local donc localhost
    $dbname = "forum-factory"; // nom de la base de donnée
    $user = "root"; // Toujours ça sur mac
    $pass = "root"; // Toujours ça sur mac

    $pdo = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass); // je me connecte

    //On gère les exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);



