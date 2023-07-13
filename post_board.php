<?php
include 'dbconnect.php';

// リクエストからユーザー名、メッセージ、緯度、経度を取得
$username = $_POST['username'];
$boardTitle = $_POST['boardTitle'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// メッセージをデータベースに保存
$query = "INSERT INTO boards (username, boardTitle, latitude, longitude) VALUES (:username, :boardTitle, :latitude, :longitude)";
$statement = $pdo->prepare($query);
$statement->execute([
    ':username' => $username,
    ':boardTitle' => $boardTitle,
    ':latitude' => $latitude,
    ':longitude' => $longitude
]);

// 最後に挿入されたメッセージのIDを取得
$boardId = $pdo->lastInsertId();

echo "board.php?id=" . $boardId;

?>
