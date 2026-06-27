<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Проверка, что данные отправлены
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $bio = $_POST['bio'] ?? null;

    // Валидация данных (например, ограничение длины)
    if ($bio !== null && strlen($bio) > 1000) {
        $bio = substr($bio, 0, 1000);
    }

    // Обновляем поле bio в таблице users
    $stmt = $pdo->prepare("UPDATE users SET bio = ? WHERE id = ?");
    $stmt->execute([$bio, $user_id]);

    // Перенаправляем обратно на профиль или другую страницу
    header('Location: profile.php');
    exit;
} else {
    // Если пришел запрос не POST, редирект или сообщение
    header('Location: profile.php');
    exit;
}
?>
