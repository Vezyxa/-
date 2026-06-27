<?php
require 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if ($subject && $message) {
        $pdo->prepare("INSERT INTO support_tickets (user_id, subject, message, status) VALUES (?, ?, ?, 'open')")
            ->execute([$_SESSION['user_id'], $subject, $message]);
        $_SESSION['msg'] = "Ваш вопрос отправлен! Администратор скоро ответит.";
    } else {
        $_SESSION['msg'] = "Пожалуйста, заполните все поля.";
    }
    header('Location: support.php'); // Перенаправление без отображения сообщения на новой странице
    exit;
}
