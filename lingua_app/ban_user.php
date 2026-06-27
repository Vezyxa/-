<?php
require 'db.php';
if($_SESSION['role'] !== 'admin') die('Нет доступа');
if (isset($_POST['user_id'])) {
    $id = intval($_POST['user_id']);
    $pdo->prepare("UPDATE users SET is_banned=1 WHERE id=?")->execute([$id]);
}
header('Location: admin_users.php');
exit;
?>