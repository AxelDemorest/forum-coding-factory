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
