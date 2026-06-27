<?php
require 'db.php';

if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }

$category = $_GET['category'] ?? 'all';
$random = isset($_GET['random']);

$sql = "SELECT * FROM cards";
$params = [];

if ($category !== 'all') {
    $sql .= " WHERE category = ?";
    $params[] = $category;
}

if ($random) {
    $sql .= " ORDER BY RAND()";
} else {
    $sql .= " ORDER BY id DESC";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$cards = $stmt->fetchAll();

$categories_stmt = $pdo->query("SELECT DISTINCT category FROM cards WHERE category IS NOT NULL");
$categories = $categories_stmt->fetchAll(PDO::FETCH_COLUMN);

$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<title>Карточки - LinguaFlow</title>
<link rel="stylesheet" href="style.css" />
<a href="dashboard.php" class="back-btn">← В меню</a>
<style>
/* Общий стиль карточки */
#card-display {
  width:350px;
  height:200px;
  margin:50px auto;
  perspective:1000px;
}
.card-inner {
  width:100%;
  height:100%;
  position:relative;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}
.card-inner.flipped {
  transform: rotateY(180deg);
}
.card-front, .card-back {
  position:absolute;
  width:100%;
  height:100%;
  backface-visibility:hidden;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:2rem;
  border-radius:12px;
}
.card-front {
  background: rgba(255,255,255,0.05);
  color:#fff;
  cursor:pointer;
}
.card-back {
  background: rgba(255,255,255,0.07);
  transform: rotateY(180deg);
  color:#94a3b8;
  font-size:1.5rem;
}

/* Кнопка далее */
#nextBtn {
  margin-top:20px;
  display:block;
  padding:10px 20px;
  font-size:1rem;
  cursor:pointer;
  background: linear-gradient(135deg, var(--primary), #4338ca);
  border:none;
  border-radius:12px;
  margin:0 auto;
  transition:0.3s;
}
#nextBtn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
}

select {
  background-color: #333; /* тёмный фон для селекта */
  color: #fff;            /* светлый текст */
  border: 1px solid var(--glass-border);
  padding: 8px;
  border-radius: 8px;
  cursor: pointer;
}
select option {
  background-color: #444; /* чуть светлее для опций */
  color: #fff;
}
</style>
<script>
const cards = <?= json_encode($cards); ?>;
let currentIndex = 0;

function showCard(index) {
  const cardInner = document.querySelector('.card-inner');
  // Обязательно сбрасываем эффект переворота
  cardInner.classList.remove('flipped');
  document.getElementById('card-front').innerHTML = cards[index].word;
  document.getElementById('card-back').innerHTML = cards[index].translation;
}



function flipCard() {
  document.querySelector('.card-inner').classList.toggle('flipped');
}

function nextCard() {
  const cardInner = document.querySelector('.card-inner');

  // Через короткое время (например, 0.6 сек) показываем следующее слово
  // перед этим возвращаем карточку в лицо
  cardInner.classList.remove('flipped');

  setTimeout(() => {
    // Обнуляем содержимое и показываем лицевую сторону снова
    currentIndex++;
    if (currentIndex >= cards.length) currentIndex = 0;
    showCard(currentIndex);
  }, 600);
}

window.onload = () => {
  if (cards.length > 0) showCard(currentIndex);
}
</script>
</head>
<body>
<!-- Выбор категории и рандома -->
<div style="margin:20px auto; text-align:center;">
  <form method="GET" style="display:inline-block; margin-right:20px;">
    <select name="category" onchange="this.form.submit()">
      <option value="all" <?= $category=='all'?'selected':'' ?>>Все категории</option>
      <?php foreach($categories as $cat): ?>
        <option value="<?= $cat ?>" <?= $category==$cat?'selected':'' ?>><?= $cat ?></option>
      <?php endforeach; ?>
    </select>
  </form>
  <form method="GET" style="display:inline-block;">
    <input type="checkbox" name="random" <?= isset($_GET['random']) ? 'checked' : '' ?> onchange="this.form.submit()">
    <label>Рандом</label>
    <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
  </form>
</div>

<!-- Карточка -->
<div id="card-display">
  <div class="card-inner" onclick="flipCard()">
    <div class="card-front" id="card-front"></div>
    <div class="card-back" id="card-back"></div>
  </div>
</div>
<button id="nextBtn" onclick="nextCard()">Следующая</button>

</body>

</html>
