<?php
include 'dbconnect.php';

// ユーザーの現在の緯度・経度
$currentLatitude = $_POST['latitude'];
$currentLongitude = $_POST['longitude'];

// 緯度・経度1度あたりのおおよその距離 (メートル)
$distancePerDegree = 111000;  // 地球の周囲の長さ (約40000km) を360で割ったもの

// 検索範囲 (メートル)
$searchRange = 50;

// 緯度・経度の差分
$delta = $searchRange / $distancePerDegree;

// 緯度・経度の範囲を計算
$minLatitude = $currentLatitude - $delta;
$maxLatitude = $currentLatitude + $delta;
$minLongitude = $currentLongitude - $delta;
$maxLongitude = $currentLongitude + $delta;

// 現在地から半径50m以内のメッセージを検索
$query = "SELECT * FROM boards WHERE latitude BETWEEN :minLat AND :maxLat AND longitude BETWEEN :minLng AND :maxLng";
$statement = $pdo->prepare($query);
$statement->execute([
    ':minLat' => $minLatitude,
    ':maxLat' => $maxLatitude,
    ':minLng' => $minLongitude,
    ':maxLng' => $maxLongitude
]);
$nearbyMessages = $statement->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($nearbyMessages);
?>
