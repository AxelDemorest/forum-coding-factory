<?php

require_once '../../../database/db.php';

// On va chercher tous les messages du topic

$querySelectallMessages = $pdo->prepare("SELECT * FROM messages WHERE idTopicMessage = ? AND bestReply = 1");

$querySelectallMessages->execute([$_POST['topicID']]);

// On regarde s'il y a déjà une bestReply

$querySelectBestReply = $pdo->prepare("SELECT * FROM messages WHERE idMessage = ?");

$querySelectBestReply->execute([$_POST['messageID']]);

$valueMessageBestReply = $querySelectBestReply->fetch(PDO::FETCH_ASSOC);

if ($valueMessageBestReply['bestReply'] == 0) {

    if($value = $querySelectallMessages->fetch(PDO::FETCH_ASSOC)) {
        
        $queryUpdateMessage = $pdo->prepare("UPDATE messages SET bestReply = 0 WHERE idMessage = ?");

        $queryUpdateMessage->execute([$value['idMessage']]);

        $response['valeur1'] = $value['idMessage'];
    }

    $queryUpdateMessage = $pdo->prepare("UPDATE messages SET bestReply = 1 WHERE idMessage = ?");

    $queryUpdateMessage->execute([$_POST['messageID']]);

    $response['valeur2'] = "#64C43F";

    $response['valeur3'] = "<i class='fa fa-star'></i></i> Meilleure solution";

    $response['valeur4'] = "#64C43F solid 1px";

}

echo json_encode($response);
