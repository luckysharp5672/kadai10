<?php
session_start();

require 'dbconnect.php';

// URLからidパラメータを取得
$id = $_GET['id'];

// メッセージを取得
$query = "SELECT * FROM boards WHERE boardId = :id ORDER BY messageId";
$statement = $pdo->prepare($query);
$statement->execute([':id' => $id]);
$boards = $statement->fetchAll(PDO::FETCH_ASSOC);

// ログインしているかをチェックし、username を取得
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

?>
<!DOCTYPE html>
<html>
<head>
    <title>掲示板</title>
    <style>
        #chatContainer {
            display: flex;
            flex-direction: column;
        }

        .chatBubble {
            max-width: 80%;
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .chatBubble.right {
            background-color: #dcf8c6;
            text-align: right;
        }

        .chatBubble.left {
            background-color: #f0f0f0;
            text-align: left;
        }
    </style>
</head>
<body>
    <div>
        <div>
            名前：<span id="username"><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></span>
        </div>
        <div>
            <textarea id="text" cols="30" rows="10"></textarea>
            <button id="send">送信</button>
        </div>
        <div id="chatContainer">
            <?php
            foreach ($messages as $message) {
                echo '<div class="chatBubble ' . ($message['username'] === $username ? 'right' : 'left') . '">';
                echo htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8');
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script>
        document.getElementById('send').addEventListener('click', function() {
            var text = document.getElementById('text').value;
            var username = document.getElementById('username').textContent;

            // メッセージをPOSTで送信
            fetch('post_message.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    username: username,
                    text: text,
                    boardId: <?php echo $id; ?>
                }),
            })
            .then(response => response.json())
            .then(data => {
                var chatBubble = document.createElement('div');
                chatBubble.className = 'chatBubble ' + (data.username === username ? 'right' : 'left');
                chatBubble.textContent = data.text;

                document.getElementById('chatContainer').appendChild(chatBubble);
            });

            document.getElementById('text').value = '';
        });
    </script>
</body>
</html>
