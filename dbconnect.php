<?php
$servername = "localhost";
$username = "luckysharp";
$password = "123456";
$dbname = "yama_board";

try {
  // Create connection using PDO
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully"; 
}
catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>