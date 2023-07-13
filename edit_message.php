<?php
require 'dbconnect.php';

// POSTデータを取得
$id = $_POST['id'];
$newBoardTitle = $_POST['boardTitle'];

// メッセージを更新
$query = "UPDATE boards SET boardTitle = :boardTitle WHERE id = :id";
$statement = $pdo->prepare($query);
$statement->execute([
    'boardTitle' => $newBoardTitle,
    'id' => $id
]);
