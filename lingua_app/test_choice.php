<?php
require 'db.php';
checkAuth();
$stmt = $pdo->query("SELECT * FROM cards ORDER BY RAND() LIMIT 4");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$correct = $rows[rand(0,3)];


?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<title>Тест | LinguaFlow</title>

<link rel="stylesheet" href="style.css">
<a href="tests_gallery.php" class="back-btn">← В меню</a>

<style>
/* Общий стиль для центрирования всей страницы */
.page-centered {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: calc(100vh - 40px);
  padding: 20px;
}

/* Стиль для блока теста */
.quiz-box {
  background: rgba(255,255,255,0.05);
  padding: 30px;
  border-radius: 100px;
  box-shadow: 0 0 15px rgba(0,0,0,0.3);
  max-width: 400px;
  width: 100%;
  text-align: center;
  animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
  0% { opacity: 0; transform: translateY(20px); }
  100% { opacity: 1; transform: translateY(0); }
}

h2 {
  margin-bottom: 10px;
  font-size: 1.8em;
  color: #ffd700;
}
#question, .answer-btn {
  margin-top: 15px;
}
.answer-btn {
  padding: 12px 60px;
  border: none;
  border-radius: 25px;
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: #fff;
  font-size: 1em;
  cursor: pointer;
  transition: all 0.3s;
  display:inline-block;
  margin: 10px;
}
.answer-btn:hover { transform: scale(1.05); }
</style>

</head>
<body>
<div class="page-centered">
  <div class="quiz-box">
    <h2>Как переводится?</h2>
    <div id="question"><?= htmlspecialchars($correct['word']) ?></div>
    <div id="answers">
      <?php foreach ($rows as $row): ?>
        <button class="answer-btn" onclick="checkAnswer('<?= htmlspecialchars($row['translation']) ?>', this)">
          <?= htmlspecialchars($row['translation']) ?>
        </button>
      <?php endforeach; ?>
    </div>
    <div id="result" style="margin-top:15px;font-weight: bold;"></div>
  </div>
</div>
<script>
const correct = '<?= strtolower(trim($correct['translation'])) ?>';
let answered = false;

function normalize(str) {
  return str.trim().toLowerCase();
}

function checkAnswer(ans, btn) {
  if(answered) return;
  answered=true;
  document.querySelectorAll('.answer-btn').forEach(b => b.disabled=true);
  const ansNorm=normalize(ans);
  const correctNorm=normalize(correct);
  if(ansNorm===correctNorm) {
    document.getElementById('result').innerHTML='✨ Правильно! +10 XP';
    btn.classList.add('answer-btn', 'correct');
    fetch('update_xp.php').then(() => setTimeout(()=>location.reload(),1500));
    add_test_progress($user_id, $pdo);
  } else {
    document.getElementById('result').innerHTML='❌ Неправильно. Верно: '+correct;
    btn.classList.add('answer-btn', 'wrong');
    document.querySelectorAll('.answer-btn').forEach(b => {
      if(normalize(b.innerText)===correctNorm) b.classList.add('correct');
    });
    setTimeout(()=>location.reload(),2500);
  }
}
</script>
</body>
</html>
