<?php
require 'db.php';
checkAuth();
$stmt = $pdo->query("SELECT * FROM cards ORDER BY RAND() LIMIT 1");
$word = $stmt->fetch();



?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<title>Тестирование</title>
<link rel="stylesheet" href="style.css">
<a href="tests_gallery.php" class="back-btn">← В меню</a>
<style>
/* Общий стиль центрирования контента */
.page-center {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: calc(100vh - 40px);
  padding: 20px;
}
.card-box {
  background: rgba(255,255,255,0.05);
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 0 15px rgba(0,0,0,0.3);
  max-width: 400px;
  width: 100%;
  text-align: center;
  animation: fadeInUp 0.8s;
}
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
h2 {
  margin-bottom: 15px;
  font-size: 1.8em;
  color: #ffd700;
}
#target-word {
  font-size: 2em;
  margin: 20px 0;
}
#user-answer {
  width: 80%;
  padding: 14px;
  margin: 10px 0;
  border-radius: 12px;
  border: 1px solid rgba(255,255,255,0.1);
  background: #0f172a;
  color: #fff;
}
.btn-main {
  padding: 14px 25px;
  border: none;
  border-radius: 25px;
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: #fff;
  font-size: 1.1em;
  cursor: pointer;
  margin-top: 15px;
  transition: all 0.3s;
}
.btn-main:hover {
  transform: scale(1.05);
}
.feedback {
  margin-top: 15px;
  font-weight: bold;
  font-size: 1.2em;
}
</style>
</head>
<body>
<div class="page-center">
  <div class="card-box">
    <p style="color: var(--text-dim)">Как переводится это слово на английский язык?</p>
    <h1 id="target-word"><?= htmlspecialchars($word['translation']) ?></h1>
    <input type="text" id="user-answer" placeholder="Введите перевод" autocomplete="off">
    <button class="btn-main" onclick="checkTest()">Проверить</button>
    <div id="feedback" class="feedback"></div>
  </div>
</div>
<script>
const correct = "<?= trim($word['word']) ?>".toLowerCase();

async function checkTest() {
  const userInp = document.getElementById('user-answer').value.trim().toLowerCase();
  const feedback = document.getElementById('feedback');

  if (userInp === correct) {
    feedback.style.color = "var(--accent)";
    feedback.innerText = "✨ Правильно! +10 XP";
    await fetch('update_xp.php');
    setTimeout(() => location.reload(), 1200);
    add_test_progress($user_id, $pdo);
  } else {
    feedback.style.color = "#fb7185";
    feedback.innerText = "❌ Ошибка. Верно: " + correct;
  }
}
</script>
</body>
</html>
