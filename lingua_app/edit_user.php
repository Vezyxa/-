<?php 
require 'db.php'; 
if($_SESSION['role'] !== 'admin') header('Location: index.php');

$user_id = intval($_GET['user_id']);
$user = $pdo->query("SELECT * FROM users WHERE id=$user_id")->fetch();
if (!$user) die('Пользователь не найден');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Редактировать - <?= htmlspecialchars($user['username']) ?></title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="container" style="max-width:500px;">
<h2>Редактировать - <?= htmlspecialchars($user['username']) ?></h2>
<form action="save_user.php" method="POST">
    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
    <label>Имя</label>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required />

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required />

    <label>Роль</label>
    <select name="role">
        <option value="user" <?= $user['role']=='user'?'selected':'' ?>>Пользователь</option>
        <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Админ</option>
    </select>

    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top:15px;">Сохранить</button>
</form>
</div>
</body>
</html>
