<!DOCTYPE html>
<html>
<body>

<h2>編集フォーム</h2>

<form action="/php4_yoshii_53/edit_message.php" method="post">
  <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>">
  <label for="boardTitle">新しい掲示板のタイトル:</label><br>
  <input type="text" id="boardTitle" name="boardTitle">
  <input type="submit" value="送信">
</form>

</body>
</html>
