<?php
require 'db.php';
checkAuth();

$user_id = $_SESSION['user_id'];
// Получим текущие данные
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['change_password'])) {
        $current_pass = $_POST['current_password'];
        $new_pass = $_POST['new_password'];

        // Проверка текущего пароля
        if (password_verify($current_pass, $user['password'])) {
            if (ctype_digit($new_pass)) {
                $message = 'Пароль не должен состоять только из цифр!';
            } elseif (strlen($new_pass) < 6) {
                $message = 'Пароль должен быть не менее 6 символов!';
            } else {
                $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
                $pdo->prepare("UPDATE users SET password = ? WHERE id = ?")->execute([$new_hash, $user_id]);
                $message = 'Пароль успешно изменен.';
            }
        } else {
            $message = 'Текущий пароль неверен.';
        }
    }
    if (isset($_POST['change_email'])) {
        $new_email = $_POST['new_email'];
        if (filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            // Проверка, занят ли email
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$new_email]);
            if ($stmt->fetch()) {
                $message = 'Этот email уже занят.';
            } else {
                $pdo->prepare("UPDATE users SET email = ? WHERE id = ?")->execute([$new_email, $user_id]);
                $message = 'Email успешно обновлен.';
            }
        } else {
            $message = 'Некорректный email.';
        }
    }
    if (isset($_POST['update_bio'])) {
        $bio = $_POST['bio'];
        $pdo->prepare("UPDATE users SET bio = ? WHERE id = ?")->execute([$bio, $user_id]);
        $message = 'Информация обновлена.';
    }
}

// Обновим данные для формы
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<title>Настройки профиля</title>
<link rel="stylesheet" href="style.css">


<style>
body {
   --bg-gradient: linear-gradient(135deg, #0f2027, #203a43);
  font-family: 'Arial', sans-serif;
  margin: 0; padding: 20px; color: #fff;
}
h1 { text-align: center; margin-bottom: 20px; font-size: 2.5em; }
.form-container {
  max-width: 900px; margin: 0 auto;
  display: flex; flex-wrap: wrap; gap:20px; justify-content: center;
}
.form-box {
  background: rgba(255,255,255,0.05);
  padding: 30px;
  border-radius: 20px;
  width: 100%; max-width: 450px;
  box-shadow: 0 0 20px rgba(0,0,0,0.3);
}
h2 { margin-bottom: 15px; font-size: 2em; }
input[type=text], input[type=email], input[type=password], textarea {
  width: 80%;
  padding: 12px;
  margin: 10px 0;
  border-radius: 12px;
  border: 1px solid #2d3748;
  background: #0f172a;
  color: #fff;
}
button {
  padding: 12px 25px;
  border: none;
  border-radius: 25px;
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: #fff;
  font-size: 1.1em;
  cursor: pointer;
  transition: all 0.3s;
}
button:hover { transform: scale(1.05); }
.message {
  margin-top: 15px; font-weight: bold; text-align: center;
}
</style>

</head>
<body>

<h1>Настройки профиля</h1>

<div class="form-container">
  <!-- Обновление пароля -->
  <div class="form-box">
    <h2>Сменить пароль</h2>
    <form method="POST">
      <input type="password" name="current_password" placeholder="Текущий пароль" required>
      <input type="password" name="new_password" placeholder="Новый пароль" required>
      <button type="submit" name="change_password">Сохранить пароль</button>
    </form>
  </div>

  <!-- Обновление email -->
  <div class="form-box">
    <h2>Обновить email</h2>
    <form method="POST">
      <input type="email" name="new_email" placeholder="Новый email" required>
      <button type="submit" name="change_email">Обновить email</button>
    </form>
  </div>

</div>

<?php if ($message): ?>
<div class="message" style="color: #ffd700;"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<a href="dashboard.php" style="display:block; text-align:center; margin-top:30px; font-size:1.3em;">↞ Вернуться к обучению</a>

</body>
</html>
