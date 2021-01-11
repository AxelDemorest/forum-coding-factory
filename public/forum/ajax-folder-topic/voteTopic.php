<?php

require_once '../../../database/db.php';

// Si on le trouve dans up

$querySelectVoteUser = $pdo->prepare("SELECT * FROM votesTopics WHERE votesTopicsIdUser = ? AND votesTopicsIdContentTopic = ? AND votesTopicsStatus = ? ");

$querySelectVoteUser->execute([$_POST['userID'], $_POST['id'], "up"]);

// Si on le trouve dans down

$querySelectVoteUserDown = $pdo->prepare("SELECT * FROM votesTopics WHERE votesTopicsIdUser = ? AND votesTopicsIdContentTopic = ? AND votesTopicsStatus = ? ");

$querySelectVoteUserDown->execute([$_POST['userID'], $_POST['id'], "down"]);

if ($_POST['status'] == "up") {

    if ($value = $querySelectVoteUser->fetch()) {

        // Enlève -1 au vote si on le trouve dans up

        $reqVoteDown = $pdo->prepare("UPDATE topics SET topicVote = topicVote - 1 WHERE idTopic = ?");

        $reqVoteDown->execute([$_POST['id']]);

        // On supprime l'user

        $reqUserVoteDelete = $pdo->prepare("DELETE FROM votesTopics WHERE votesTopicsIdUser = ? AND votesTopicsIdContentTopic = ? AND votesTopicsStatus = ?");

        $reqUserVoteDelete->execute([$_POST['userID'], $_POST['id'], $_POST['status']]);

        $response['srcUp'] = "../../img/up-arrow.png";

        $response['srcDown'] = "../../img/down-arrow.png";
    } else {

        if ($valueDown = $querySelectVoteUserDown->fetch()) {

            // AJoute +1 au vote si on le trouve dans down

            $reqVoteDown2 = $pdo->prepare("UPDATE topics SET topicVote = topicVote + 1 WHERE idTopic = ?");

            $reqVoteDown2->execute([$_POST['id']]);

            // On delete l'user de down

            $reqUserVoteDeleteDown = $pdo->prepare("DELETE FROM votesTopics WHERE votesTopicsIdUser = ? AND votesTopicsIdContentTopic = ? AND votesTopicsStatus = ?");

            $reqUserVoteDeleteDown->execute([$_POST['userID'], $_POST['id'], "down"]);
        }

        // AJoute +1 au vote si on le trouve pas dans up

        $reqVoteUp = $pdo->prepare("UPDATE topics SET topicVote = topicVote + 1 WHERE idTopic = ?");

        $reqVoteUp->execute([$_POST['id']]);

        // On ajoute l'user à votesTopics up

        $reqUserVote = $pdo->prepare("INSERT INTO votesTopics(votesTopicsIdUser, votesTopicsIdContentTopic, votesTopicsStatus) VALUES (?, ?, ?)");

        $reqUserVote->execute([$_POST['userID'], $_POST['id'], $_POST['status']]);

        // On change le src des images

        $response['srcUp'] = "../../img/up-arrow-already.png";

        $response['srcDown'] = "../../img/down-arrow.png";
    }

    // On select le nombre de vote du topic

    $querySelectVote = $pdo->prepare("SELECT topicVote FROM topics WHERE idTopic = ?");

    $querySelectVote->execute([$_POST['id']]);

    // On fetch la valeur

    $value = $querySelectVote->fetch(PDO::FETCH_ASSOC);

    // Puis on l'affiche

    $response['valeur1'] = $value['topicVote'];

    echo json_encode($response);
}

if ($_POST['status'] == "down") {

    if ($valueDown3 = $querySelectVoteUserDown->fetch()) {

        // Enlève -1 au vote si on le trouve dans down

        $reqVoteDown = $pdo->prepare("UPDATE topics SET topicVote = topicVote + 1 WHERE idTopic = ?");

        $reqVoteDown->execute([$_POST['id']]);

        // On supprime l'user

        $reqUserVoteDelete = $pdo->prepare("DELETE FROM votesTopics WHERE votesTopicsIdUser = ? AND votesTopicsIdContentTopic = ? AND votesTopicsStatus = ?");

        $reqUserVoteDelete->execute([$_POST['userID'], $_POST['id'], $_POST['status']]);

        $response['srcUp'] = "../../img/up-arrow.png";

        $response['srcDown'] = "../../img/down-arrow.png";

    } else {

        if ($valueUp = $querySelectVoteUser->fetch()) {

            // AJoute +1 au vote si on le trouve dans up

            $reqVoteDown2 = $pdo->prepare("UPDATE topics SET topicVote = topicVote - 1 WHERE idTopic = ?");

            $reqVoteDown2->execute([$_POST['id']]);

            // On delete l'user de up

            $reqUserVoteDeleteDown = $pdo->prepare("DELETE FROM votesTopics WHERE votesTopicsIdUser = ? AND votesTopicsIdContentTopic = ? AND votesTopicsStatus = ?");

            $reqUserVoteDeleteDown->execute([$_POST['userID'], $_POST['id'], "up"]);
        }

        // AJoute +1 au vote si on le trouve pas dans down

        $reqVoteUp = $pdo->prepare("UPDATE topics SET topicVote = topicVote - 1 WHERE idTopic = ?");

        $reqVoteUp->execute([$_POST['id']]);

        // On ajoute l'user à votesTopics down

        $reqUserVote = $pdo->prepare("INSERT INTO votesTopics(votesTopicsIdUser, votesTopicsIdContentTopic, votesTopicsStatus) VALUES (?, ?, ?)");

        $reqUserVote->execute([$_POST['userID'], $_POST['id'], $_POST['status']]);

        // On change le src des images

        $response['srcDown'] = "../../img/down-arrow-already.png";

        $response['srcUp'] = "../../img/up-arrow.png";
    }

        // On select le nombre de vote du topic

        $querySelectVote = $pdo->prepare("SELECT topicVote FROM topics WHERE idTopic = ?");

        $querySelectVote->execute([$_POST['id']]);
    
        // On fetch la valeur
    
        $value = $querySelectVote->fetch(PDO::FETCH_ASSOC);
    
        // Puis on l'affiche
    
        $response['valeur1'] = $value['topicVote'];
    
        echo json_encode($response);
}
