<?php
require 'db.php';
if($_SESSION['role'] !== 'admin') die('Нет доступа');

$user_id = intval($_POST['user_id']);
$username = $_POST['username'];
$email = $_POST['email'];
$role = $_POST['role'];

$pdo->prepare("UPDATE users SET username=?, email=?, role=? WHERE id=?")
    ->execute([$username, $email, $role, $user_id]);

header('Location: admin_users.php');
exit;
?>
