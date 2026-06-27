<?php
$host = 'localhost';
$db   = 'lingua_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Ошибка подключения к базе: ' . $e->getMessage());
}

session_start();

/**
 * Проверка авторизации.
 * Если пользователь не вошёл – редирект на главную страницу.
 */
function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }
}


?>
