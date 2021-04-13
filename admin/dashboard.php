<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
<link href="dashboard.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">




    <title>dashboard - Forum Factory</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');

        body {
            background-color: #232323;
        }

        .fz-text {
            font-family: 'Quicksand', sans-serif;
        }

        .navbar {
            z-index: 1010;
            background-color: #2D2D2D;
        }
    </style>
</head>

<body>
    <?php

    session_start();

    if (isset($_SESSION['auth'])) : ?>

        <?php if ($_SESSION['auth']->rank == 1) : ?>

            <!-- ici on demande le mdp d'accès et si c'est bon on affiche le dashboard -->

            <nav class="navbar navbar-expand-lg navbar-dark fixed-top fz-text" style="height: 60px;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Forum Factory - Administration</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/forum-coding-factory/public/home/home.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Forum Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#dashboardStats">Statistiques</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Users</a>
                            </li>
                        </ul>
                        <span class="navbar-text me-3">
                            Connecté en tant que <?php echo $_SESSION['auth']->pseudo ?>
                        </span>
                    </div>
                </div>
            </nav>

            <!-- Traitement de l'ajout d'une catégorie au forum -->
            <?php

            require_once '../database/db.php';

            $errors = array();

            $valid = true;

            if (isset($_POST['addCategoryForumSubmit'])) {

                $nameCategory  = htmlspecialchars(trim($_POST['nameCategory']));

                if (empty($nameCategory)) {
                    $errors['nameCategory'] = "Le nom de la catégorie est incorrect.";
                    $valid = false;
                }

                if ($valid) {

                    if (isset($_FILES['imageCategory']) and !empty($_FILES['imageCategory']['name'])) {

                        $tailleMax = 2097152;
                        $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');

                        if ($_FILES['imageCategory']['size'] <= $tailleMax) {

                            $extensionUpload = strtolower(substr(strchr($_FILES['imageCategory']['name'], '.'), 1));

                            if (in_array($extensionUpload, $extensionsValides)) {

                                $chemin = "../img/imgCategory/" . $nameCategory . '.' . $extensionUpload;
                                $resultat = move_uploaded_file($_FILES['imageCategory']['tmp_name'], $chemin);

                                if ($resultat) {

                                    $updateavatar = $pdo->prepare("
                                    INSERT INTO categories(name, image)
                                    VALUES (:name, :image)
                                ");

                                    $updateavatar->execute([
                                        'name' => $nameCategory,
                                        'image' => $nameCategory . '.' . $extensionUpload,
                                    ]);
                                } else {

                                    $errors['errorImport'] = "Il y a eu une erreur pendant l'importation du fichier.";
                                }
                            } else {

                                $errors['errorFormat'] = "L'image doit être au format jpg, jpeg, gif ou png.";
                            }
                        } else {

                            $errors['errorSize'] = "La taille du fichier est trop élevée";
                        }
                    } else {

                        $errors['errorImage'] = "Tu dois indiquer une image";
                    }
                }
            }

            ?>

            <!-- Ajouter une catégorie au forum -->
            <div class="main-content text-white" style="margin-top: 60px;">
                <div class="container">
                    <div class="row">
                        <h1 class="pt-4 text-center">Forum dashboard</h1>
                    </div>
                    <div class="row pt-5">
                        <div class="col-4 p-5 rounded" style="background-color: #323232">
                            <h2 class="pb-4">Ajouter une catégorie</h2>
                            <?php if (isset($resultat) && $resultat) : echo '<div class="alert alert-success">La catégorie ' . $nameCategory . ' a bien été ajoutée avec succès !</div>';
                            endif; ?>
                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger">
                                    <ul>

                                        <?php foreach ($errors as $error) : ?>

                                            <li><?= $error; ?></li>

                                        <?php endforeach; ?>

                                    </ul>
                                </div>

                            <?php endif; ?>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="addCategoryForum" class="form-label">Nom de la catégorie</label>
                                    <input name="nameCategory" type="text" class="form-control" id="addCategoryForum" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Image de la catégorie</label>
                                    <input name="imageCategory" class="form-control" type="file" id="formFile" required>
                                </div>
                                <button name="addCategoryForumSubmit" type="submit" class="btn btn-primary">Envoyer</button>
                            </form>
                        </div>
                    </div>
                </div>

                <hr class="mx-auto my-5 w-75 rounded" style="height: 10px; background-color: white !important;">

                    <!-- Statisqtique -->

                <div class="container">
                    <div class="row">
                        <h1 id="dashboardStats" class="pt-4 text-center">Les Statistiques</h1>
                    </div>
                    <div class="row pt-5">
                        <div class="col-4 p-5 rounded" style="background-color: #323232">
                            <h2 class="pb-4">Ajouter une catégorie</h2>

                        </div>
                    </div>

ddddddd ddddd ddddd dddd
<div class="grey-bg container-fluid">
  <section id="minimal-statistics">
    <div class="row">
     
    </div>
    <div class="row">
      <div class="col-xl-3 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="icon-pencil primary font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3>278</h3>
                  <span>New Posts</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="icon-speech warning font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3>156</h3>
                  <span>New Comments</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="icon-graph success font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3>64.89 %</h3>
                  <span>Bounce Rate</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="icon-pointer danger font-large-2 float-left"></i>
                </div>
                <div class="media-body text-right">
                  <h3>423</h3>
                  <span>Total Visits</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div class="row">
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="danger">278</h3>
                  <span>New Projects</span>
                </div>
                <div class="align-self-center">
                  <i class="icon-rocket danger font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="success">156</h3>
                  <span>New Clients</span>
                </div>
                <div class="align-self-center">
                  <i class="icon-user success font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="warning">64.89 %</h3>
                  <span>Conversion Rate</span>
                </div>
                <div class="align-self-center">
                  <i class="icon-pie-chart warning font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="primary">423</h3>
                  <span>Support Tickets</span>
                </div>
                <div class="align-self-center">
                  <i class="icon-support primary font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div class="row">
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="primary">278</h3>
                  <span>New Posts</span>
                </div>
                <div class="align-self-center">
                  <i class="icon-book-open primary font-large-2 float-right"></i>
                </div>
              </div>
              <div class="progress mt-1 mb-0" style="height: 7px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="warning">156</h3>
                  <span>New Comments</span>
                </div>
                <div class="align-self-center">
                  <i class="icon-bubbles warning font-large-2 float-right"></i>
                </div>
              </div>
              <div class="progress mt-1 mb-0" style="height: 7px;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="success">64.89 %</h3>
                  <span>Bounce Rate</span>
                </div>
                <div class="align-self-center">
                  <i class="icon-cup success font-large-2 float-right"></i>
                </div>
              </div>
              <div class="progress mt-1 mb-0" style="height: 7px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="danger">423</h3>
                  <span>Total Visits</span>
                </div>
                <div class="align-self-center">
                  <i class="icon-direction danger font-large-2 float-right"></i>
                </div>
              </div>
              <div class="progress mt-1 mb-0" style="height: 7px;">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  

  <div class="row">
    <div class="col-xl-6 col-md-12">
      <div class="card overflow-hidden">
        <div class="card-content">
          <div class="card-body cleartfix">
            <div class="media align-items-stretch">
              <div class="align-self-center">
                <i class="icon-pencil primary font-large-2 mr-2"></i>
              </div>
              <div class="media-body">
                <h4>Total Posts</h4>
                <span>Monthly blog posts</span>
              </div>
              <div class="align-self-center">
                <h1>18,000</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-6 col-md-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body cleartfix">
            <div class="media align-items-stretch">
              <div class="align-self-center">
                <i class="icon-speech warning font-large-2 mr-2"></i>
              </div>
              <div class="media-body">
                <h4>Total Comments</h4>
                <span>Monthly blog comments</span>
              </div>
              <div class="align-self-center"> 
                <h1>84,695</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-6 col-md-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body cleartfix">
            <div class="media align-items-stretch">
              <div class="align-self-center">
                <h1 class="mr-2">$76,456.00</h1>
              </div>
              <div class="media-body">
                <h4>Total Sales</h4>
                <span>Monthly Sales Amount</span>
              </div>
              <div class="align-self-center">
                <i class="icon-heart danger font-large-2"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-6 col-md-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body cleartfix">
            <div class="media align-items-stretch">
              <div class="align-self-center">
                <h1 class="mr-2">$36,000.00</h1>
              </div>
              <div class="media-body">
                <h4>Total Cost</h4>
                <span>Monthly Cost</span>
              </div>
              <div class="align-self-center">
                <i class="icon-wallet success font-large-2"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>

















                </div>

                                <!-- fin des stat-->


            </div> <!-- FIN CONTENT -->

            <!-- debut nouveauter alexis -->

                <hr class="mx-auto my-5 w-75 rounded" style="height: 10px; background-color: white !important;">

                <div class="main-content text-white" style="margin-top: 60px;">
                <div class="container">
                    <div class="row">
                        <h1 class="pt-4 text-center">Les Nouveautés</h1>
                    </div>
                    <div class="row pt-5">
                        <div class="col-4 p-5 rounded" style="background-color: #323232">
                            <h2 class="pb-4">Ajouter une nouveautés</h2>
                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger">
                                    <ul>

                                        <?php foreach ($errors as $error) : ?>

                                            <li><?= $error; ?></li>

                                        <?php endforeach; ?>

                                    </ul>
                                </div>

                            <?php endif; ?>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="addNouveauteForum" class="form-label">Nom de la nouveauté</label>
                                    <input name="nameNouveaute" type="text" class="form-control" id="addNouveauteForum" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="contentNouveaute" class="form-label">Contenue de la nouveauté</label>
                                    <input name="contentNouveaute" type="text" class="form-control" id="contentNouveaute" required>
                                </div>

                                <button name="addNouveauteSubmit" type="submit" class="btn btn-primary">Envoyer</button>
                            </form>
                        </div>
                    </div>
                </div>            

            <?php

                if (isset($_POST["addNouveauteSubmit"])) {
                               $updateNouveaute = $pdo->prepare("
                                INSERT INTO nouveaute(titleNouveaute , contentNouveaute )
                                VALUES (:titleNouveaute, :contentNouveaute)
                                ");    
                             
                  $updateNouveaute->execute([
                                        'titleNouveaute' => $_POST["nameNouveaute"],
                                        'contentNouveaute' => $_POST["contentNouveaute"], 
                                    ]);  
                  }

                    ?>

                    
                <!-- ,,,,,,,,,,,,,,,,,,,,,,,,,,,,-->


        <?php endif; ?>

    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>