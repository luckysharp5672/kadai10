<!DOCTYPE html>
<html>
<head>
    <title>さんぽデジタル掲示板</title>
    <style>
        /* CSSスタイルをここに追加 */
    </style>
</head>
<body>
    <h1>さんぽデジタル掲示板</h1>

    <h1>アカウント登録</h1>
    <form id="registerForm" action="register.php" method="post">
        <label for="username">ユーザー名:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="email">メール:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">パスワード:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="登録">
    </form>
    <h1>ログイン</h1>
    <form action="login.php" method="post">
        <label for="email">メール:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">パスワード:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="ログイン">
    </form>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var username = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            fetch('register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'username': username,
                    'email': email,
                    'password': password,
                }),
            })
            .then(response => response.text())
            .then(data => {
                // レスポンスを処理（例: 成功メッセージを表示、ログインページにリダイレクト等）
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
