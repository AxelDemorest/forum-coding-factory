<?php

session_start();

require_once '../../database/db.php';

if (!empty($_POST)) {

  $errors = array();

  $valid = true;

  if (isset($_POST['button_submit'])) {

    $message = htmlspecialchars(trim($_POST['content_chatMessage']));

    if (empty($message)) {
      $errors['message'] = "Tu n'as rien envoyé";
      $valid = false;
    }

    if ($valid && empty($errors)) {

      $req = $pdo->prepare("
                    INSERT INTO chatMessage(content_chatMessage,author_chatMessage)
                    VALUES (?, ?)
                ");

      $req->execute([$message, $_SESSION['auth']->id]);
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="../header/header.css" rel="stylesheet" />
  <link href="chatgeneral.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Forum - Coding factory</title>

</head>


<body>


  <?php
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fra_fra');

  include "../header/header.php";

  require_once '../../functions/functions.php';

  $reqInCategory = $pdo->query("SELECT * FROM in_category");

  $ListinCategory = $reqInCategory->fetchAll(PDO::FETCH_ASSOC);

  $reqCategories = $pdo->query("SELECT * FROM categories ORDER BY name ASC");

  $resultatCategories = $reqCategories->fetchAll(PDO::FETCH_ASSOC);

  ?>


  <!-- -- chat  general -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>
  <div class="container pt-5">
    <div class="content container-fluid bootstrap snippets bootdey">
      <div class="row row-broken">

        <!-- ce qui son online  changer en backend pour afficher seul ceux dans le salle  -->

        <div class="col-sm-3 col-xs-12">
          <div class="col-inside-lg decor-default chat" style="overflow: hidden; outline: none;" tabindex="5000">
            <div class="chat-users">
              <h6>Salons vocaux</h6>
            </div>
          </div>
        </div>

        <!-- fin des gens online -->

        <?php

        $fetchMessages = $pdo->query("SELECT * FROM chatMessage ORDER BY date_chatMessage ASC");

        $fetchMessages = $fetchMessages->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <!-- chat general -->

        <div class="col-sm-9 col-xs-12 chat" style="overflow: hidden; outline: none;" tabindex="5001">
          <div class="col-inside-lg decor-default">
            <div class="chat-body">
              <h6>Discussion</h6> <!-- meyttre le nom des salle -_>-->

              <?php foreach ($fetchMessages as $key => $value) :

                $fetchUser = $pdo->prepare("SELECT * FROM users WHERE id = ?");

                $fetchUser->execute([$value['author_chatMessage']]);

                $fetchUser = $fetchUser->fetch(PDO::FETCH_ASSOC);

              ?>

                <div class="answer left">
                  <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                    <div class="status offline"></div>
                  </div>
                  <div class="name"><?= $fetchUser['pseudo'] ?></div>
                  <div class="text">
                    <?= $value['content_chatMessage'] ?>
                  </div>
                  <div class="time"><?= timeAgo($value['date_chatMessage']) ?></div>
                </div>
              <?php endforeach; ?>

              <!--               <div class="answer right">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                  <div class="status offline"></div>
                </div>
                <div class="name">Alexander Herthic</div>
                <div class="text">
                  Lorem ipsum dolor amet, consectetur adipisicing elit Lorem ipsum dolor amet, consectetur adipisicing elit Lorem ipsum dolor amet, consectetur adiping elit
                </div>
                <div class="time">5 min ago</div>
              </div> -->

              <?php if (isset($_SESSION['auth'])) : ?>
                <div class="answer-add">
                  <form action="" method="POST" class="d-flex justify-content-between">
                    <input name="content_chatMessage" type="text" placeholder="Write a message" class="px-3" style="border: 1px solid lightgrey;border-radius:10px">
                    <button name="button_submit" type="submit" class="btn btn-danger mx-4" value="Submit">Submit</button>
                  </form>

                  <span class="answer-btn answer-btn-1"></span>
                  <span class="answer-btn answer-btn-2"></span>
                </div>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>









  <!-- fin chat general --<>-->





  <!-- Javascript -->
  <script src="chatgeneral.js"></script>

  <script src="../header/header.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>