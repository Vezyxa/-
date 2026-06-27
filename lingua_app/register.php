<?php require 'db.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<title>Регистрация - LinguaFlow</title>
<link rel="stylesheet" href="style.css" />

</head>
<body>
<div class="container" style="display:flex; justify-content:center; align-items:center; min-height:100vh;">
    <div class="glass-card" style="max-width:400px; width:100%; padding:40px;">
        <h2 style="text-align:center; margin-bottom:20px;">Создайте аккаунт</h2>
        <form action="register_handler.php" method="POST">
            <label style="color: var(--text-dim); display:block; margin-bottom:5px;">Имя пользователя</label>
            <input type="text" name="username" placeholder="Ваше имя" required />

            <label style="color: var(--text-dim); display:block; margin-top:20px; margin-bottom:5px;">Email</label>
            <input type="email" name="email" placeholder="example@mail.com" required />

            <label style="display:block; margin-top:20px; margin-bottom:5px;">Пароль</label>
            <div style="position:relative; display:flex; align-items:center;">
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    placeholder="Не менее 6 символов, латинские буквы" 
                    required
                    pattern="(?=.*[A-Za-z]).{6,}"
                    title="Пароль должен быть не менее 6 символов и содержать латинские буквы"
                />
            </div>

            <label style="display:block; margin-top:20px; margin-bottom:5px;">Повторите пароль</label>
            <input type="password" name="password" placeholder="••••••••" required />

            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:30px;">Зарегистрироваться</button>
        </form>
        <p style="margin-top:15px; text-align:center;">
            Уже есть аккаунт? <a href="index.php" style="color: var(--primary); font-weight:600;">Войти</a>
        </p>
    </div>
</div>
</body>
</html>
