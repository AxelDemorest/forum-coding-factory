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

    session_start();

    include "../header/header.php";

    require_once '../../functions/functions.php';

    require_once '../../database/db.php';

    $reqInCategory = $pdo->query("SELECT * FROM in_category");

    $ListinCategory = $reqInCategory->fetchAll(PDO::FETCH_ASSOC);

    $reqCategories = $pdo->query("SELECT * FROM categories ORDER BY name ASC");

    $resultatCategories = $reqCategories->fetchAll(PDO::FETCH_ASSOC);

    ?>


                <!-- -- chat  general -->





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>
<div class="container">
<div class="content container-fluid bootstrap snippets bootdey">
      <div class="row row-broken">

      <!-- ce qui son online  changer en backend pour afficher seul ceux dans le salle  --> 

        <div class="col-sm-3 col-xs-12">
          <div class="col-inside-lg decor-default chat" style="overflow: hidden; outline: none;" tabindex="5000">
            <div class="chat-users">
              <h6>Online</h6>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                    <div class="status off"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User name">
                    <div class="status online"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="User name">
                    <div class="status busy"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="User name">
                    <div class="status offline"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="User name">
                    <div class="status off"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User name">
                    <div class="status online"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                    <div class="status busy"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User name">
                    <div class="status offline"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="User name">
                    <div class="status off"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="User name">
                    <div class="status online"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="User name">
                    <div class="status busy"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User name">
                    <div class="status offline"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="User name">
                    <div class="status off"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                    <div class="status off"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User name">
                    <div class="status online"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="User name">
                    <div class="status busy"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="User name">
                    <div class="status offline"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="User name">
                    <div class="status off"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User name">
                    <div class="status online"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="User name">
                    <div class="status busy"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                    <div class="status offline"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User name">
                    <div class="status off"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="User name">
                    <div class="status online"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="User name">
                    <div class="status busy"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="User name">
                    <div class="status offline"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
                <div class="user">
                    <div class="avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User name">
                    <div class="status off"></div>
                    </div>
                    <div class="name">User name</div>
                    <div class="mood">User mood</div>
                </div>
            </div>
          </div>
        </div>

                <!-- fin des gens online -->



                <!-- chat general -->

        <div class="col-sm-9 col-xs-12 chat" style="overflow: hidden; outline: none;" tabindex="5001">
          <div class="col-inside-lg decor-default">
            <div class="chat-body">
              <h6>Nom de la salle </h6>  <!-- meyttre le nom des salle -_>-->

              <div class="answer left">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                  <div class="status offline"></div>
                </div>
                <div class="name">Alexander Herthic</div>
                <div class="text">
                  Lorem ipsum dolor amet, consectetur adipisicing elit Lorem ipsum dolor amet, consectetur adipisicing elit Lorem ipsum dolor amet, consectetur adiping elit
                </div>
                <div class="time">5 min ago</div>
              </div>

              <div class="answer right">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User name">
                  <div class="status offline"></div>
                </div>
                <div class="name">Alexander Herthic</div>
                <div class="text">
                  Lorem ipsum dolor amet, consectetur adipisicing elit Lorem ipsum dolor amet, consectetur adipisicing elit Lorem ipsum dolor amet, consectetur adiping elit
                </div>
                <div class="time">5 min ago</div>
              </div>

              <div class="answer left">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                  <div class="status online"></div>
                </div>
                <div class="name">Alexander Herthic</div>
                <div class="text">
                  ...
                </div>
                <div class="time">5 min ago</div>
              </div>

              <div class="answer right">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User name">
                  <div class="status busy"></div>
                </div>
                <div class="name">Alexander Herthic</div>
                <div class="text">
                  It is a long established fact that a reader will be. Thanks Mate!
                </div>
                <div class="time">5 min ago</div>
              </div>

              <div class="answer right">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                  <div class="status off"></div>
                </div>
                <div class="name">Alexander Herthic</div>
                <div class="text">
                  It is a long established fact that a reader will be. Thanks Mate!
                </div>
                <div class="time">5 min ago</div>
              </div>

              <div class="answer left">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User name">
                  <div class="status offline"></div>
                </div>
                <div class="name">Alexander Herthic</div>
                <div class="text">
                  Lorem ipsum dolor amet, consectetur adipisicing elit Lorem ipsum dolor amet, consectetur adipisicing elit Lorem ipsum dolor amet, consectetur adiping elit
                </div>
                <div class="time">5 min ago</div>
              </div>

              <div class="answer right">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                  <div class="status offline"></div>
                </div>
                <div class="name">Alexander Herthic</div>
                <div class="text">
                  Lorem ipsum dolor amet, consectetur adipisicing elit Lorem ipsum dolor amet, consectetur adipisicing elit Lorem ipsum dolor amet, consectetur adiping elit
                </div>
                <div class="time">5 min ago</div>
              </div>

              <div class="answer left">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User name">
                  <div class="status online"></div>
                </div>
                <div class="name">Alexander Herthic</div>
                <div class="text">
                  ...
                </div>
                <div class="time">5 min ago</div>
              </div>

              <div class="answer right">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                  <div class="status busy"></div>
                </div>
                <div class="name">Alexander Herthic</div>
                <div class="text">
                  It is a long established fact that a reader will be. Thanks Mate!
                </div>
                <div class="time">5 min ago</div>
              </div>

              <div class="answer right">
                <div class="avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User name">
                  <div class="status off"></div>
                </div>
                <div class="name">Alexander Herthic</div>
                <div class="text">
                  It is a long established fact that a reader will be. Thanks Mate!
                </div>
                <div class="time">5 min ago</div>
              </div>

              <div class="answer-add">
                <input placeholder="Write a message">
                <span class="answer-btn answer-btn-1"></span>
                <span class="answer-btn answer-btn-2"></span>
              </div>

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