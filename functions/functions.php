<?php

function badge_color($user_status)
{
    if ($user_status == "bachelor") {
        echo '<span class="badge rounded-pill bg-danger">Bachelor</span>';
    }

    if ($user_status == "master") {
        echo '<span class="badge rounded-pill bg-warning">Master</span>';
    }

    if ($user_status == "reconversion") {
        echo '<span class="badge rounded-pill bg-info">Reconversion</span>';
    }

    if ($user_status == "po") {
        echo '<span class="badge rounded-pill bg-success">PO</span>';
    }
}

function if_admin_user($user_rank)
{
    if ($user_rank == 1) {
        echo '<span class="badge rounded-pill bg-warning text-dark">Administrateur</span>';
    }
}


function timeAgo($date)
{
    if (!ctype_digit($date))
        $date = strtotime($date);
    if (date('Ymd', $date) == date('Ymd')) {
        $diff = time() - $date;
        if ($diff < 60) /* moins de 60 secondes */
            return 'Il y a ' . $diff . ' sec';
        else if ($diff < 3600) /* moins d'une heure */
            return 'Il y a ' . round($diff / 60, 0) . ' min';
        else if ($diff < 10800) /* moins de 3 heures */
            return 'Il y a ' . round($diff / 3600, 0) . ' heures';
        else /*  plus de 3 heures ont affiche ajourd'hui à HH:MM:SS */
            return 'Aujourd\'hui à ' . date('H:i:s', $date);
    } else if (date('Ymd', $date) == date('Ymd', strtotime('- 1 DAY')))
        return 'Hier à ' . date('H:i:s', $date);
    else if (date('Ymd', $date) == date('Ymd', strtotime('- 2 DAY')))
        return 'Il y a 2 jours à ' . date('H:i:s', $date);
    else if (date('Ymd', $date) == date('Ymd', strtotime('- 3 DAY')))
        return 'Il y a 3 jours à ' . date('H:i:s', $date);
    else if (date('Ymd', $date) == date('Ymd', strtotime('- 4 DAY')))
        return 'Il y a 4 jours à ' . date('H:i:s', $date);
    else if (date('Ymd', $date) == date('Ymd', strtotime('- 5 DAY')))
        return 'Il y a 5 jours à ' . date('H:i:s', $date);
    else if (date('Ymd', $date) == date('Ymd', strtotime('- 6 DAY')))
        return 'Il y a 6 jours à ' . date('H:i:s', $date);
    else if (date('Ymd', $date) == date('Ymd', strtotime('- 7 DAY')))
        return 'Il y a 7 jours à ' . date('H:i:s', $date);
    else
        return 'Le ' . date('d/m/Y à H:i:s', $date);
}

function tronque($chaine, $max)
{
    // Nombre de caractère
    if (strlen($chaine) >= $max) {
        // Met la portion de chaine dans $chaine
        $chaine = substr($chaine, 0, $max);
        // position du dernier espace
        $espace = strrpos($chaine, " ");
        // test si il ya un espace
        if ($espace)
            // si ya 1 espace, coupe de nouveau la chaine
            $chaine = substr($chaine, 0, $espace);
        // Ajoute ... à la chaine
        $chaine .= '...';
    }
    return $chaine;
}


function advanced_pagination($perPageParameter, $totalItems, $pathFile) { ?>
    <nav aria-label="Page navigation example">
                    <ul class="pagination">

                        <?php
                        $currentPage = (isset($_GET["page"])) ? $_GET["page"] : 1;
                        $perPage = $perPageParameter;

                        $totalPages = ceil($totalItems / $perPage);
                        $currentPage = min(max(1, $currentPage), $totalPages);
                        /* $firstHalf = ($currentPage < $totalPages / 2) ? 'true' : 'false'; */
                        ?>

                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="<?= $pathFile ?>page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>

                        <!-- <li class="disabled"><a>...</a></li> -->

                        <?php for ($i = 1; $i < $currentPage; ++$i) { ?>
                            <?php if ($i < 3 || $i > $currentPage - 3 || $totalPages < 10) { ?>
                                <li class="page-item"><a class="page-link" href="<?= $pathFile ?>page=<?= $i ?>"><?= $i ?></a></li>
                            <?php } elseif ($i == $currentPage - 3) { ?>
                                <li class="disabled"><a class="page-link">...</a></li>
                            <?php } ?>
                        <?php } ?>

                        <li class="page-item disabled"><a class="page-link"><?= $currentPage ?></a></li>

                        <?php for ($i = $currentPage + 1; $i <= $totalPages; ++$i) { ?>
                            <?php if ($i < $currentPage + 3 || $i > $totalPages - 2 || $totalPages < 10) { ?>
                                <li class="page-item"><a class="page-link" href="<?= $pathFile ?>page=<?= $i ?>"><?= $i ?></a></li>
                            <?php } elseif ($i == $currentPage + 3) { ?>
                                <li class="disabled"><a class="page-link">...</a></li>
                            <?php } ?>
                        <?php } ?>

                        <li class="page-item <?= ($currentPage == $totalPages) ? "disabled" : "" ?>">
                            <a href="<?= $pathFile ?>page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>
                    </ul>
                </nav>
<?php } ?>
