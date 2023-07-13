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
$boardId = $input['boardId'];

$stmt = $pdo->prepare('SELECT * FROM boards WHERE boardId = ? ORDER BY messageId DESC');
$stmt->execute([$boardId]);

$boards = $stmt->fetchAll();

echo json_encode($boards);
?>
