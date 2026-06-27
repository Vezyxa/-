<?php
/* -------------------------------------------------
   progress.php
   -------------------------------------------------
   1) Проверяем, что пользователь авторизован
   2) Прибавляем опыт (по умолчанию 10 XP)
   3) Пересчитываем:
        - общий опыт (points)
        - текущий уровень
        - XP внутри уровня
        - сколько XP нужно до следующего уровня
   4) Формируем JSON‑ответ (можно использовать в AJAX)
   5) Выводим страницу с прогресс‑баром, где
      анимация сброса происходит автоматически,
      если пользователь только что повысил уровень.
   ------------------------------------------------- */
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

/* ---------- 1. Параметры ---------- */
$user_id   = $_SESSION['user_id'];
$xp_gain   = 10;                     // сколько XP начисляем за действие
$xp_per_lvl = 100;                  // сколько XP требуется для одного уровня
/* ----------------------------------- */

/* ---------- 2. Обновляем общий опыт ---------- */
$pdo->prepare("UPDATE users SET points = points + ? WHERE id = ?")
    ->execute([$xp_gain, $user_id]);

/* ---------- 3. Читаем новый общий опыт ---------- */
$current_points = (int)$pdo->query(
    "SELECT points FROM users WHERE id = $user_id"
)->fetchColumn();

/* ---------- 4. Вычисляем уровень и прогресс ---------- */
// Уровень считается так: каждый 100 XP — новый уровень
$level          = floor($current_points / $xp_per_lvl) + 1;
$xp_in_level    = $current_points % $xp_per_lvl;   // остаток в текущем уровне
$xp_for_next    = $xp_per_lvl;                     // порог до следующего уровня
$progress_pct   = ($xp_in_level / $xp_for_next) * 100;

/* ---------- 5. Флаг «только что повысил уровень» ---------- */
$just_leveled_up = ($xp_in_level === 0 && $current_points !== 0);

/* ---------- 6. Формируем JSON‑ответ (на случай AJAX) ---------- */
$json_response = json_encode([
    'status'        => 'ok',
    'level'         => $level,
    'xp_current'    => $xp_in_level,
    'xp_needed'     => $xp_for_next,
    'progress_pct'  => $progress_pct,
    'justLeveled'   => $just_leveled_up
]);
/* Если файл вызывается через fetch/AJAX, можно сразу вернуть JSON:
   header('Content-Type: application/json');
   echo $json_response;
   exit;
   (закомментировано, потому что дальше выводим HTML)
*/
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Уровень и прогресс</title>
<link rel="stylesheet" href="style.css">
<style>
/* ------------ стили прогресс‑бара ------------ */
#xp-container{
    width:100%;
    height:30px;
    background:#e0e0e0;
    border-radius:8px;
    overflow:hidden;
    position:relative;
    margin-top:10px;
}
#xp-bar{
    height:100%;
    background:var(--primary, #4caf50);
    width:0%;                /* будет анимировано JS‑ом */
    transition:width 0.8s ease;
}
#xp-text{
    position:absolute;
    width:100%;
    top:0;
    left:0;
    line-height:30px;
    text-align:center;
    color:#fff;
    font-weight:bold;
    pointer-events:none;
}
</style>
</head>
<body>

<div class="container" style="max-width:600px;margin:auto;padding:20px;">
    <h2>Ваш уровень и прогресс</h2>
    <div>Уровень: <span id="levelNumber"><?= $level ?></span></div>

    <div id="xp-container">
        <div id="xp-bar"></div>
        <div id="xp-text"></div>
    </div>
</div>

<script>
// ---------- Данные, полученные из PHP ----------
const data = {
    level       : <?= $level ?>,
    xpCurrent   : <?= $xp_in_level ?>,
    xpNeeded    : <?= $xp_for_next ?>,
    progressPct : <?= $progress_pct ?>,
    justLeveled : <?= $just_leveled_up ? 'true' : 'false' ?>
};

// ---------- Функция обновления UI ----------
function renderProgress() {
    const bar   = document.getElementById('xp-bar');
    const txt   = document.getElementById('xp-text');
    const lvl   = document.getElementById('levelNumber');

    // Обновляем уровень (может измениться после level‑up)
    lvl.textContent = data.level;

    // Текст внутри прогресс‑бара
    txt.textContent = `${data.xpCurrent} / ${data.xpNeeded} XP (Уровень ${data.level})`;

    // Плавно задаём ширину
    bar.style.width = data.progressPct + '%';
}

// ---------- Инициализация ----------
renderProgress();

// ---------- Анимация сброса при повышении уровня ----------
if (data.justLeveled) {
    // 1) На мгновение показываем заполненный бар (чтобы пользователь видел "полный")
    const bar = document.getElementById('xp-bar');
    bar.style.transition = 'none';
    bar.style.width = '100%';

    // 2) Через 200 мс убираем переход и сбрасываем до 0 %
    setTimeout(() => {
        bar.style.transition = 'width 0.8s ease';
        bar.style.width = '0%';
    }, 200);

    // 3) Через 1 секунду (после анимации) показываем новый уровень и 0 XP
    setTimeout(() => {
        data.xpCurrent = 0;
        data.progressPct = 0;
        renderProgress();
    }, 1200);
}
</script>
</body>
</html>
