<?php

if (isset($_SESSION['auth'])) : ?>

    <?php $user = $_SESSION['auth']; ?>

    <!-- Navbar de l'utilisateur connecté -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top py-2 fz-text">
        <div class="container-fluid">
            <a class="navbar-brand" href="/forum-coding-factory/public/home/home.php">
                <img class="ms-4" src="../../img/logocodingfactory-ptt.jpg" width="190" alt="" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item px-lg-3 pt-2 pt-lg-0">
                        <a class="nav-link active text-danger" aria-current="page" href="/forum-coding-factory/public/home/home.php">Accueil</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Équipe</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Forum</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Nouveautés</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-center">
                    <a href="/forum-coding-factory/public/account/account.php"><button type="button" class="btn btn-outline-secondary me-4">Profil</button></a>
                    <?php if ($user->rank == 1) : ?>
                        <a href="/forum-coding-factory/admin/dashboard.php"><button type="button" class="btn btn-warning me-4">Administration</button></a>
                    <?php endif; ?>
                    <a href="/forum-coding-factory/public/deconnexion/deconnexion.php"><button type="button" class="btn btn-danger me-md-4">Se déconnecter</button></a>
                </div>
            </div>
        </div>
    </nav>

<?php else : ?>

    <!-- Navbar de l'utilisateur non connecté -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top py-2 fz-text">
        <div class="container-fluid">
            <a class="navbar-brand" href="/forum-coding-factory/public/home/home.php">
                <img class="ms-4" src="../../img/logocodingfactory-ptt.jpg" width="190" alt="" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item px-lg-3 pt-2 pt-lg-0">
                        <a class="nav-link active text-danger" aria-current="page" href="/forum-coding-factory/public/home/home.php">Accueil</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Équipe</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Forum</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Nouveautés</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-center">
                    <a href="/forum-coding-factory/public/inscription-connexion/connexion.php"><button type="button" class="btn btn-outline-secondary me-4">Se connecter</button></a>
                    <a href="/forum-coding-factory/public/inscription-connexion/inscription.php"><button type="button" class="btn btn-danger me-md-4">S'inscrire</button></a>
                </div>
            </div>
        </div>
    </nav>

<?php endif; ?>