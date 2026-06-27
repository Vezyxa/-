<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ищем пользователя по email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Проверяем, не заблокирован ли пользователь
        if ($user['is_banned']) {
            // Можно вывести сообщение или переадресовать
            header('Location: index.php?error=ban');
            exit;
        }

        // Проверка пароля
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit;
        } else {
            header('Location: index.php?error=1');
            exit;
        }
    } else {
        header('Location: index.php?error=1');
        exit;
    }
}
?>
