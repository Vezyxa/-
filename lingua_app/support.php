<?php
require 'db.php';


// Выводим сообщение, если есть
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
} else {
    $msg = null;
}

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if ($subject && $message) {
        // Вставляем тикет
        $pdo->prepare("INSERT INTO support_tickets (user_id, subject, message, status) VALUES (?, ?, ?, 'open')")
            ->execute([$_SESSION['user_id'], $subject, $message]);
        $_SESSION['msg'] = "Ваш вопрос отправлен! Администратор скоро ответит.";
        header('Location: support.php'); // Перенаправляем, чтобы не было повторной отправки
        exit;
    } else {
        $_SESSION['msg'] = "Пожалуйста, заполните все поля.";
        header('Location: support.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<title>Мои обращения - Support</title>

<link rel="stylesheet" href="style.css">


<style>
/* Стиль формы */
.support-form {
  max-width: 600px;
  margin: 40px auto;
  padding: 25px;
  background: rgba(255,255,255,0.05);
  border: 1px solid var(--glass-border);
  border-radius: 20px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}
.support-form h2 {
  margin-bottom: 20px;
  font-size: 1.8rem;
  color: var(--primary);
  text-align: center;
}
.support-form label {
  display: block;
  margin-top: 15px;
  font-size: 0.95rem;
  color: var(--text-dim);
}
.support-form input[type="text"],
.support-form textarea {
  width: 100%;
  padding: 14px 20px;
  margin-top: 8px;
  border: 1px solid var(--glass-border);
  border-radius: 15px;
  background: rgba(255,255,255,0.1);
  font-size: 1rem;
  color: #fff;
  outline: none;
  transition: background 0.3s, border-color 0.3s;
}
.support-form input[type="text"]:focus,
.support-form textarea:focus {
  background: rgba(255,255,255,0.2);
  border-color: var(--primary);
}
.support-form button {
  width: 100%;
  padding: 16px;
  margin-top: 20px;
  border: none;
  border-radius: 15px;
  background: linear-gradient(135deg, var(--primary), var(--secondary));
  font-size: 1.2rem;
  font-weight: 600;
  cursor: pointer;
  box-shadow: 0 6px 15px rgba(0,0,0,0.3);
  transition: all 0.3s;
}
.support-form button:hover {
  box-shadow: 0 10px 20px rgba(0,0,0,0.4);
  transform: translateY(-2px);
}
</style>
</head>
<body>



<!-- В вашем HTML поставьте где-то в начале перед основным контентом -->
<?php if ($msg): ?>
<div id="notification" style="position:fixed; top:20px; right:20px; background:linear-gradient(135deg, var(--primary), var(--secondary)); padding:15px 20px; border-radius:8px; box-shadow:0 4px 15px rgba(0,0,0,0.2); color:#fff; font-family:'Arial'; z-index:9999; font-size:1rem;">
  <?= htmlspecialchars($msg) ?>
</div>
<?php endif; ?>


<div class="container" style="max-width: 600px;">
  <div style="display:flex; justify-content: space-between; align-items: center; margin-bottom:20px;">
    <h1>Обращения в поддержку</h1>
    <a href="dashboard.php" class="btn" style="background: var(--glass); padding:8px 12px; border-radius:8px;">← В меню</a>
</div>


  <!-- Форма для отправки обращения -->
  <div class="support-form">
    <h2>Создать новое обращение</h2>
    
    <form action="" method="POST">
      <label>Тема обращения</label>
      <input type="text" name="subject" placeholder="Например: Проблема с приложением" required>
      <label>Сообщение</label>
      <textarea name="message" rows="5" placeholder="Опишите проблему..." required></textarea>
      <button type="submit">Отправить запрос</button>
    </form>
  </div>

  <!-- История обращений -->
  <h2 style="margin-top:40px; text-align:center;">История ваших обращений</h2>
  <?php
    $stmt = $pdo->prepare("SELECT s.*, u.username FROM support_tickets s JOIN users u ON s.user_id = u.id WHERE s.user_id = ? ORDER BY s.created_at DESC");
    $stmt->execute([$_SESSION['user_id']]);
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$tickets) {
      echo "<p style='text-align:center; margin-top:20px;'>У вас еще не было обращений.</p>";
    } else {
      foreach ($tickets as $ticket):
  ?>
  <div class="support-card" style="margin-top:15px;">
    <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
      <strong style="color:var(--accent);">Тикет #<?= $ticket['id'] ?>: <?= htmlspecialchars($ticket['subject']) ?></strong>
      <span style="font-size:0.8rem; color:var(--text-dim);"><?= $ticket['created_at'] ?></span>
    </div>
    <div><?= nl2br(htmlspecialchars($ticket['message'])) ?></div>
    <?php if ($ticket['admin_reply']): ?>
      <div style="margin-top:10px; padding:10px; background: rgba(255,255,255,0.1); border-radius:10px;">
        <strong>Ответ администратора:</strong>
        <div><?= nl2br(htmlspecialchars($ticket['admin_reply'])) ?></div>
      </div>
    <?php else: ?>
      <div style="margin-top:10px; font-size:0.9rem; color:var(--text-dim);">Ожидает ответа...</div>
    <?php endif; ?>
  </div>
  <?php endforeach; } ?>
</div>

</body>
</html>
