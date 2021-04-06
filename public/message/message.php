<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../header/header.css" rel="stylesheet" />
    <link href="message.css" rel="stylesheet" />
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



 <!--- chat  -->


<div class="container py-5 px-4">
  <!-- For demo purpose-->
  

  <div class="row rounded-lg overflow-hidden shadow">
    <!-- Users box-->
    <div class="col-5 px-0">
      <div class="bg-white">

        <div class="bg-gray px-4 py-2 bg-light">
          <p class="h5 mb-0 py-1">Recent</p>
        </div>

<!-- a gauche avec qui on as parler rentrer en dur -->

        <div class="messages-box">
          <div class="list-group rounded-0">


  <!-- debut 1 personne -->  

            <a class="list-group-item list-group-item-action active text-white rounded-0">
              <div class="media"><img src="iconchat.png" alt="user" width="50" class="rounded-circle"> <!-- image a recupere des utilisateur ou mettre icon random -->
                <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0">mettre le nom des mec backend </h6><small class="small font-weight-bold"> mettre ici quand on as reçu message </small>   <!-- mettre ici image ou icon + date du message reçu -->
                  </div>
                  <p class="font-italic mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>   <!-- ici s'affiche le message en petit dans l'historique -->
                </div>
              </div>
            </a>
<!-- fin de une personne --> 



<!-- une autre personne a gauche historique des message --> 


            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0  ">
              <div class="media"><img src="iconchat.png" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0">axel </h6><small class="small font-weight-bold">14 Dec</small>    <!-- cahnger nom et heure -->
                  </div>
                  <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur. incididunt ut labore.</p>
                </div>
              </div>
            </a>
<!-- fin -->


            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
              <div class="media"><img src="iconchat.png" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0">alexis </h6><small class="small font-weight-bold">9 Nov</small>
                  </div>
                  <p class="font-italic text-muted mb-0 text-small">consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                </div>
              </div>
            </a>

            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
              <div class="media"><img src="iconchat.png" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0">angel </h6><small class="small font-weight-bold">18 Oct</small>
                  </div>
                  <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                </div>
              </div>
            </a>

            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
              <div class="media"><img src="iconchat.png" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0">merwan</h6><small class="small font-weight-bold">17 Oct</small>
                  </div>
                  <p class="font-italic text-muted mb-0 text-small">consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                </div>
              </div>
            </a>

            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
              <div class="media"><img src="iconchat.png" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0">bootstrapp</h6><small class="small font-weight-bold">2 Sep</small>
                  </div>
                  <p class="font-italic text-muted mb-0 text-small">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
              </div>
            </a>

            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
              <div class="media"><img src="iconchat.png" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0">oueoue </h6><small class="small font-weight-bold">30 Aug</small>
                  </div>
                  <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                </div>
              </div>
            </a>

            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
              <div class="media"><img src="iconchat.png" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-4">
                  <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="mb-0">andre </h6><small class="small font-weight-bold">21 Aug</small>
                  </div>
                  <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                </div>
              </div>
            </a>

          </div>
        </div>
      </div>
    </div>


<!-- le chat priver a droite -->

    
    <div class="col-7 px-0">
      <div class="px-4 py-5 chat-box bg-white">   <!-- backoground du Chat Box-->
      
        <!-- l'autre  Message-->
        <div class="media w-50 mb-3"><img src="iconchat.png" alt="user" width="50" class="rounded-circle">
          <div class="media-body ml-3">
            <div class="bg-light rounded py-2 px-3 mb-2   ">
              <p class="text-small mb-0 text-muted  "> php c'est dla merde  </p>   <!-- ici c le message faudras l'afficher ici -->
            </div>
            <p class="small text-muted">12:00 PM | Aug 13</p>   <!-- mettre ici si possible lheure et la date -->
          </div>
        </div>

        <!-- nous  Message-->
        <div class="media w-50 ml-auto mb-3">
          <div class="media-body">
            <div class="bg-danger rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-white">oueoue </p>
            </div>
            <p class="small text-muted">12:00 PM | Aug 13</p>
          </div>
        </div>

        <!-- lautre Message-->
        <div class="media w-50 mb-3"><img src="iconchat.png" alt="user" width="50" class="rounded-circle">
          <div class="media-body ml-3">
            <div class="bg-light rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-muted">oeueou </p>
            </div>
            <p class="small text-muted">12:00 PM | Aug 13</p>
          </div>
        </div>

        <!-- nous Message-->
        <div class="media w-50 ml-auto mb-3">
          <div class="media-body">
            <div class="bg-danger rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-white">oueoeu </p>
            </div>
            <p class="small text-muted">12:00 PM | Aug 13</p>
          </div>
        </div>

        <!-- l'autre  Message-->
        <div class="media w-50 mb-3"><img src="iconchat.png" alt="user" width="50" class="rounded-circle">
          <div class="media-body ml-3">
            <div class="bg-light rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam sit optio blanditiis culpa fuga assumenda soluta! Nam modi dicta porro, et quidem, suscipit dolorum ad eos rerum sit architecto laborum!</p>
            </div>
            <p class="small text-muted">12:00 PM | Aug 13</p>
          </div>
        </div>

        <!-- nous Message-->
        <div class="media w-50 ml-auto mb-3">
          <div class="media-body">
            <div class="bg-danger rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-white">ououz</p>
            </div>
            <p class="small text-muted">12:00 PM | Aug 13</p>
          </div>
        </div>

      </div>

      <!-- l'autre  area -->
      <form action="#" class="bg-light">
        <div class="input-group">
          <input type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
          <div class="input-group-append">
            <button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>








<!--- chat  -->






    <!-- Javascript -->
    <script src="../header/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>