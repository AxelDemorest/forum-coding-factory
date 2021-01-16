<?php

require_once '../../../database/db.php';

$queryDeleteTopic = $pdo->prepare("DELETE FROM messages WHERE idMessage = ?");

$queryDeleteTopic->execute([$_POST['messageID']]);