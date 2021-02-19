<?php
session_start();

require_once "../../database/db.php";

if (isset($_POST['messages']) and !empty($_POST['messages'])) {

    $pseudo = htmlspecialchars($_SESSION['auth']->pseudo);
    $msg = htmlspecialchars($_POST['messages']);

    $insertmsg = $pdo->prepare('INSERT INTO chat(pseudo, msg) VALUES (?,?)');
    
    $insertmsg->execute(array($pseudo, $msg));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="../header/header.css" rel="stylesheet" />
    <link href="../footer/footer.css" rel="stylesheet" />
    <title>chat direct</title>
    <style>
    </style>
</head>

<body>
    <?php

    include "../header/header.php"; ?>

    <div id="body">

        <div id="chat-circle" class="btn btn-raised">
            <div id="chat-overlay"></div>
        </div>

        <div class="d-flex align-items-center flex-column mt-3">
            <div class="mb-3 fz-text">
                <h1 style="font-size:35px">Chat Coding</h1>
            </div>
            <div class="p-3 bg-light rounded shadow-sm w-50 border border-2" style="overflow:scroll;max-height:30em">

                <?php
                $allmsg = $pdo->query('SELECT * FROM chat ORDER BY id ASC');
                while ($msg = $allmsg->fetch(PDO::FETCH_ASSOC)) : ?>
                    <?php if ($msg['pseudo'] === $_SESSION['auth']->pseudo) : ?>
                        <div class="mb-1 d-flex justify-content-end mt-2">
                            <span class="p-2 rounded" style="background-color: skyblue">
                                <strong><?php echo $msg['pseudo'] ?></strong> : <?php echo $msg['msg']; ?>
                            </span>
                        </div>
                    <?php else : ?>
                        <div class="mb-3">
                            <span class="p-2 rounded" style="background-color:lightgrey">
                                <strong><?php echo $msg['pseudo'] ?></strong> : <?php echo $msg['msg']; ?>
                            </span>
                        </div>
                    <?php endif; ?>

                <?php endwhile; ?>
                <div class="chat-input">
                    <form method="post" action="">
                    <hr>
                        <input class="rounded border border-none" style="font-size: 20px; width:80%;" type="text" name="messages" placeholder="Ecrire ici...">
                        <input class="rounded border border-none" name="test" type="submit" value="Envoyer">
                    </form>
                </div>
            </div>
        </div>


    </div>
    <?php include "../footer/footer.html"; ?>
</body>

</html>