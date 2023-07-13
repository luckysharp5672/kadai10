<?php
header('Content-Type: application/json');
$host = 'localhost';
$db   = 'test';
$user = 'root';
$pass = 'password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$text = $input['text'];
$boardId = $input['boardId'];

$query = "INSERT INTO messages (username, text, boardId) VALUES (:username, :text, :boardId)";
$statement = $pdo->prepare($query);
$statement->execute([
    ':username' => $username,
    ':text' => $text,
    ':boardId' => $boardId
]);

$message = ['username' => $username, 'text' => $text];

echo json_encode($message);
?>
