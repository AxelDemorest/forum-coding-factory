<?php

function badge_color($user_status){
    if($user_status == "bachelor") {
        echo '<span class="badge rounded-pill bg-danger">Bachelor</span>';
    }

    if($user_status == "master") {
        echo '<span class="badge rounded-pill bg-warning">Master</span>';
    }

    if($user_status == "reconversion") {
        echo '<span class="badge rounded-pill bg-info">Reconversion</span>';
    }

    if($user_status == "po") {
        echo '<span class="badge rounded-pill bg-success">PO</span>';
    }
}
