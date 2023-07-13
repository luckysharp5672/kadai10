<?php
session_start();

require 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username']; // ログイン成功時にユーザー名をセッションに保存
        $_SESSION['chk_ssid']  = session_id();
        $_SESSION['kanri_flg'] = $user['kanri_flg']; //権限で判断剃る際に利用
        header("Location: main.php");
        exit;
    } else {
        echo 'ログインに失敗しました';
    }
}
?>
