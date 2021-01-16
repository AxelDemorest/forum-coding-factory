<?php

require_once '../../../database/db.php';

$queryDeleteTopic = $pdo->prepare("DELETE FROM topics WHERE idTopic = ?");

$queryDeleteTopic->execute([$_POST['topicID']]);