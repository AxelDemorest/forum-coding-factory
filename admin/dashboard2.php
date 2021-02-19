<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .sidebar {
            width: 15%;
            height: 100vh;
            background-color: #2D3744;
        }

        .content-sidebar {
            display: flex;
            flex-direction: column;
        }

        .text_title_sidebar {
            opacity: 0.3;
            font-size: 14px;
            font-weight: bold;
            color: white;
        }

        .link-sidebar {
            text-decoration: none;
            color: white;
            opacity: 0.3;
            font-weight: normal;
            font-size: 14px;
            margin-left: 25px;
        }

        .link-sidebar:hover {
            color: white;
            opacity: 0.7;
        }

        .content-dashboard {
            background-color: #F7F7F7;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex flex-row">
            <div class="sidebar border-end">
                <div class="mt-4 ms-4 content-sidebar">
                    <p class="text-uppercase text_title_sidebar">Statistiques</p>
                    <a href="" class="mb-3 link-sidebar">Utilisateurs</a>
                    <a href="" class="mb-3 link-sidebar">Forum</a>
                    <a href="" class="mb-3 link-sidebar">Classes</a>
                    <a href="" class="mb-3 link-sidebar">Battles</a>
                    <p class="text-uppercase text_title_sidebar">Forum</p>
                    <a href="" class="mb-3 link-sidebar">Catégorie</a>
                    <a href="" class="mb-3 link-sidebar">Topics</a>
                    <a href="" class="mb-3 link-sidebar">Réponses</a>
                    <p class="text-uppercase text_title_sidebar">Utilisateurs</p>
                </div>
            </div>
            <div class="px-0" style="width:85%">
                <nav class="border-bottom" style="width:100%;height:70px">
                    <p class="mb-0 text-end me-4 mt-3" style="opacity:0.6;"><?= $_SESSION['auth']->pseudo ?></p>
                    <p style="font-size:13px" class="text-muted text-end me-4">Administrateur</p>
                </nav>
                <div class="content-dashboard" style="height:20em">

                </div>
            </div>
        </div>
    </div>
</body>

</html>