<?php
/* -------------------------------------------------
   profile.php (Адаптированный под ваш проект)
   -------------------------------------------------
   1) Проверка сессии и подключение к БД
   2) Получение статистики слов и тестов
   3) Расчет XP-прогресса и уровня пользователя
   4) Отображение всех данных с обновленным UX
   ------------------------------------------------- */
require 'db.php';


if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$xp_per_lvl = 100; // XP для одного уровня

// --- 2. Получение данных о пользователе и его опыте ---
$stmt = $pdo->prepare("SELECT points, username, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$current_points = (int)$user['points'];
$username       = $user['username'];
$email          = $user['email'];

// Расчет уровня и XP-прогресса внутри уровня
$level          = floor($current_points / $xp_per_lvl) + 1;
$xp_in_level    = $current_points % $xp_per_lvl;
$xp_for_next    = $xp_per_lvl;
$progress_pct   = ($xp_in_level / $xp_for_next) * 100;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Мой профиль - LinguaFlow</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Стили для прогресс-бара */
        #xp-container {
            width: 100%;
            height: 25px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            margin-top: 15px;
            border: 1px solid var(--glass-border);
        }
        #xp-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            width: 0%; /* Анимируется JS */
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #xp-text {
            position: absolute;
            width: 100%;
            top: 0;
            text-align: center;
            line-height: 23px;
            font-size: 0.85rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 0 1px 2px rgba(0,0,0,0.5);
        }
    </style>
</head>
<body>
  
    <div class="container" style="max-width: 600px;">
        <a href="dashboard.php" style="color: var(--text-dim); text-decoration: none;">← Вернуться</a>
        
        <div class="glass-card" style="margin-top: 20px; text-align: center;">
            <!-- Аватарка -->
            <div style="width: 120px; height: 120px; background: var(--primary); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; color: white; box-shadow: 0 10px 20px rgba(0,0,0,0.2);">
                <?= strtoupper(substr($username, 0, 1)) ?>
            </div>
            
            <h1><?= htmlspecialchars($username) ?></h1>
            <p style="color: var(--text-dim);"><?= htmlspecialchars($email) ?></p>

            <!-- Группа уровня и XP -->
            <div style="margin-top: 25px; padding: 15px; background: rgba(255,255,255,0.03); border-radius: 15px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-weight: bold; color: var(--accent);">Уровень <?= $level ?></span>
                    <span style="font-size: 0.9rem; color: var(--text-dim);"><?= $current_points ?> общее XP</span>
                </div>
                
                <div id="xp-container">
                    <div id="xp-bar"></div>
                    <div id="xp-text"><?= $xp_in_level ?> / <?= $xp_for_next ?> XP</div>
                </div>
            </div>

            <!-- Форма обновления Bio -->
            <form action="update_profile.php" method="POST" style="margin-top: 30px; text-align: left;">
                <label style="font-size: 0.9rem; color: var(--text-dim);">О себе</label>
                <textarea name="bio" class="input" style="background: var(--glass); border: 1px solid var(--glass-border); width: 100%; color: white; border-radius: 12px; padding: 15px; margin-top: 10px; resize: vertical;" rows="4" placeholder="Расскажи немного о себе..."></textarea>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Сохранить изменения</button>
            </form>
        </div>
    </div>

    <script>
    // Анимация прогресс-бара при загрузке
    window.addEventListener('DOMContentLoaded', () => {
        const bar = document.getElementById('xp-bar');
        const progress = <?= (float)$progress_pct ?>;
        
        // Маленький таймаут для запуска анимации после того как страница отрисуется
        setTimeout(() => {
            bar.style.width = progress + '%';
        }, 300);
    });
    </script>
    
</body>
</html>
