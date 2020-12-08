<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="connexion.css" rel="stylesheet" />
    <link href="../header/header.css" rel="stylesheet" />
    <link href="../footer/footer.css" rel="stylesheet" />
    <title>Forum - Coding factory</title>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <?php include "../header/header.html"; ?>

    <!-- Body -->
    <div class="d-flex align-items-center" style="height: 80vh">
        <div class="container-fluid bg-light pt-4 pb-5">
            <div class="row">
                <div class="col-12 d-flex flex-column align-items-center">
                    <h1 class="pb-3">Se connecter</h1>
                    <div></div>
                    <form class="w-50 fz-text p-5 rounded border border-secondary">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Adresse Email" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">Indique ton adresse email.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mot de passe</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" aria-describedby="passwordHelp">
                            <small id="passwordHelp" class="form-text text-muted"><a href="">
                                    Mot de passe oublié ?
                                </a></small>
                        </div>
                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" disabled>
                            <label class="form-check-label" for="disabledFieldsetCheck">
                                Se rappeler de moi (non-fonctionnel)
                            </label>
                        </div>
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>