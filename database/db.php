<?php

    $servname = "localhost";
    $dbname = "forum-factory";
    $user = "root";
    $pass = "root";

    $pdo = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);