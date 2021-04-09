<?php

if (isset($_SESSION['auth'])) : ?>

    <?php $user = $_SESSION['auth']; ?>

    <!-- Navbar de l'utilisateur connecté -->
    <nav class="navbar sticky-top navbar-light navbar-expand-xl bg-white fz-text shadow-sm d-flex align-items-center">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="/forum-coding-factory/public/home/home.php">
                <img class="ms-4" src="../../img/logo-bb.png" width="150" alt="" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" style="font-size: 15px" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 me-3 d-flex flex-wrap" style="font-weight:400">
                    <li class="nav-item d-flex flex-column px-lg-3 pt-2 pt-lg-0">
                        <a class="nav-link text-dark" aria-current="page" href="/forum-coding-factory/public/home/home.php">Accueil</a>
                        <span class="border-li bg-danger rounded-pill ms-2"></span>
                    </li>
                    <li class="nav-item d-flex flex-column px-lg-3">
                        <a class="nav-link text-dark" href="/forum-coding-factory/public/forum/forum.php">Forum</a>
                        <span class="border-li bg-danger rounded-pill ms-2"></span>
                    </li>

                    <li class="nav-item d-flex flex-column px-lg-3">
                        <a class="nav-link text-dark" href="http://localhost:8888/forum-coding-factory/public/battles/battle.php">Battles</a>
                        <span class="border-li bg-danger rounded-pill ms-2"></span>
                    </li>
                    </li>


        <!-- deroulant -->
                  
                
                    <li class="nav-item dropdown  ">
                    <li class="nav-item d-flex flex-column px-lg-3">
                    
                    <a class="nav-link dropdown-toggle nav-link text-dark px-lg-4 " data-bs-toggle="dropdown"
                    
                        href="#" role="button" aria-expanded="false">Autres</a>
                    <ul class="dropdown-menu" >
                    <li><a class="dropdown-item" href="/forum-coding-factory/public/account/note.php">Notes</a></li>
                    <li><a class="dropdown-item" href="/forum-coding-factory/public/account/nouveaute.php">Nouveautées</a></li>
                    <li><a class="dropdown-item" href="/forum-coding-factory/public/message/message.php">Chat </a></li>

                       
                    
                         <li>
                            <hr class="dropdown-divider">
                        </li> <!-- ligne séparatrice -->

                        <li><a class="dropdown-item  " href="/forum-coding-factory/public/nous/nous.php"> Nous  </a></li>
                    </ul>          
                            <span class="border-li bg-danger rounded-pill ms-2"></span>
              
                    </li>
                    </li>
            



                 



                     








                    <li class="nav-item d-flex flex-column px-lg-3">
                        <a class="nav-link text-dark" href="/forum-coding-factory/public/account/account.php">Profil</a>
                        <span class="border-li bg-warning rounded-pill ms-2"></span>
                    </li>
                    <li class="nav-item d-flex flex-column px-lg-3">
                        <a class="nav-link text-dark" href="/forum-coding-factory/public/deconnexion/deconnexion.php">Se déconnecter</a>
                        <span class="border-li bg-warning rounded-pill ms-2"></span>
                    </li>
                    <?php if ($user->rank == 1) : ?>
                        <li class="nav-item d-flex flex-column px-lg-3">
                            <a class="nav-link text-dark" href="/forum-coding-factory/admin/dashboard.php">Administration</a>
                            <span class="border-li bg-warning rounded-pill ms-2"></span>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

<?php else : ?>

    <!-- Navbar de l'utilisateur non connecté -->
    <nav class="navbar sticky-top navbar-light navbar-expand-xl bg-white fz-text shadow-sm d-flex align-items-center">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="/forum-coding-factory/public/home/home.php">
                <img class="ms-4" src="../../img/logo-bb.png" width="150" alt="" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" style="font-size: 15px" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 me-3" style="font-weight:400">
                    <li class="nav-item d-flex flex-column px-lg-3 pt-2 pt-lg-0">
                        <a class="nav-link text-dark" aria-current="page" href="/forum-coding-factory/public/home/home.php">Accueil</a>
                        <span class="border-li bg-danger rounded-pill ms-2"></span>
                    </li>
                    <li class="nav-item d-flex flex-column px-lg-3">
                        <a class="nav-link text-dark" href="/forum-coding-factory/public/forum/forum.php">Forum</a>
                        <span class="border-li bg-danger rounded-pill ms-2"></span>
                    </li>
                    <li class="nav-item d-flex flex-column px-lg-3">
                        <a class="nav-link text-dark" href="http://localhost:8888/forum-coding-factory/public/battles/battle.php">Battles</a>
                        <span class="border-li bg-danger rounded-pill ms-2"></span>
                    </li>


        <!-- deroulant -->
                  
                
        <li class="nav-item dropdown  ">
                    <li class="nav-item d-flex flex-column px-lg-3">
                    
                    <a class="nav-link dropdown-toggle nav-link text-dark px-lg-4 " data-bs-toggle="dropdown"
                    
                        href="#" role="button" aria-expanded="false">Autres</a>
                    <ul class="dropdown-menu" >
                    <li><a class="dropdown-item" href="/forum-coding-factory/public/account/note.php">Notes</a></li>
                    <li><a class="dropdown-item" href="/forum-coding-factory/public/account/nouveaute.php">Nouveautées</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li> <!-- ligne séparatrice -->
                        <li><a class="dropdown-item  " href=""> Chat </a></li>
                    </ul>          
                            <span class="border-li bg-danger rounded-pill ms-2"></span>
              
                    </li>
                    </li>
            




                    <li class="nav-item d-flex flex-column px-lg-3">
                        <a class="nav-link text-dark" href="/forum-coding-factory/public/inscription-connexion/connexion.php">Connexion</a>
                        <span class="border-li bg-warning rounded-pill ms-2"></span>
                    </li>
                    <li class="nav-item d-flex flex-column px-lg-3">
                        <a class="nav-link text-dark" href="/forum-coding-factory/public/inscription-connexion/inscription.php">Inscription</a>
                        <span class="border-li bg-warning rounded-pill ms-2"></span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<?php endif; ?>