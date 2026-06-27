<?php require 'db.php';

if (isset($_GET['error']) && $_GET['error'] == 'ban'):
?>
<p style="color: red; text-align:center;">Ваш аккаунт заблокирован. Обратитесь к администратору.</p>
<?php
endif;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>LinguaFlow - Вход</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="glass-panel login-card">
            <h2 style="margin-bottom: 20px; text-align: center;">Добро пожаловать</h2>
            <form action="login_handler.php" method="POST">
                <div style="margin-bottom: 15px;">
                    <label style="display:block; margin-bottom: 5px; color: var(--text-dim);">Email</label>
                    <input type="email" name="email" required placeholder="example@mail.com">
                </div>
                <div style="margin-bottom: 25px;">
                    <label style="display:block; margin-bottom: 5px; color: var(--text-dim);">Пароль</label>
                    <input type="password" name="password" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Войти в систему</button>
            </form>
            <p style="margin-top: 20px; text-align: center; color: var(--text-dim);">
                Нет аккаунта? <a href="register.php" style="color: var(--primary); text-decoration: none;">Создать</a>
            </p>
        </div>
    </div>
</body>
</html>
