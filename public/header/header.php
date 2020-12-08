<?php

if (isset($_SESSION['auth'])) : ?>

    <!-- Navbar de l'utilisateur connecté -->
    <div class="w-100 d-flex align-items-center" style="height: 70px">
        <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white fz-text" style="height: 70px">
            <div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="/forum-coding-factory/public/home/home.php">
                    <img class="ml-4" src="../../img/logocodingfactory-ptt.jpg" width="190" alt="" loading="lazy">
                </a>
            </div>
            <div class="d-none d-md-inline-block d-lg-none">
                <a href="/forum-coding-factory/public/account/account.php"><button type="button" class="btn btn-outline-secondary mr-md-4">Profil</button></a>
                <a href="/forum-coding-factory/public/deconnexion/deconnexion.php"><button type="button" class="btn btn-danger mr-md-4">Se déconnecter</button></a>
            </div>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto pl-lg-3">
                    <li class="nav-item active">
                        <a class="nav-link px-lg-4 pt-4 pt-lg-2" href="/forum-coding-factory/public/home/home.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-4" href="#">Équipe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-4" href="#">Forum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-4" href="#">Nouveautés</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-center d-md-none d-lg-inline-block">
                    <a href="/forum-coding-factory/public/account/account.php"><button type="button" class="btn btn-outline-secondary mr-4">Profil</button></a>
                    <a href="/forum-coding-factory/public/deconnexion/deconnexion.php"><button type="button" class="btn btn-danger mr-md-4">Se déconnecter</button></a>
                </div>
            </div>
        </nav>
    </div>

<?php else : ?>

    <!-- Navbar de l'utilisateur non connecté -->
    <div class="w-100 d-flex align-items-center" style="height: 70px">
        <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white fz-text" style="height: 70px">
            <div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="/forum-coding-factory/public/home/home.php">
                    <img class="ml-4" src="../../img/logocodingfactory-ptt.jpg" width="190" alt="" loading="lazy">
                </a>
            </div>
            <div class="d-none d-md-inline-block d-lg-none">
                <a href="/forum-coding-factory/public/inscription-connexion/connexion.php"><button type="button" class="btn btn-outline-secondary mr-md-4">Se connecter</button></a>
                <a href="/forum-coding-factory/public/inscription-connexion/inscription.php"><button type="button" class="btn btn-danger mr-md-4">S'inscrire</button></a>
            </div>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto pl-lg-3">
                    <li class="nav-item active">
                        <a class="nav-link px-lg-4 pt-4 pt-lg-2" href="/forum-coding-factory/public/home/home.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-4" href="#">Équipe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-4" href="#">Forum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-4" href="#">Nouveautés</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-center d-md-none d-lg-inline-block">
                    <a href="/forum-coding-factory/public/inscription-connexion/connexion.php"><button type="button" class="btn btn-outline-secondary mr-4">Se connecter</button></a>
                    <a href="/forum-coding-factory/public/inscription-connexion/inscription.php"><button type="button" class="btn btn-danger mr-md-4">S'inscrire</button></a>
                </div>
            </div>
        </nav>
    </div>


<?php endif; ?>