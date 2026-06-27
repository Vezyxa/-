<?php require 'db.php'; if(!isset($_SESSION['user_id'])) header('Location: index.php'); 
// Получение текущих XP и уровня пользователя
$stmt = $pdo->prepare("SELECT points FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$current_points = $stmt->fetchColumn();

$level = floor($current_points / 100) + 1; // уровень
$xpt_next = $level * (10 + rand(10, 20)); // XP для следующего уровня
$xp_current_in_level = $current_points % 100; // опыт в текущем уровне
$xp_percentage = ($xp_current_in_level / 100) * 100; // прогресс внутри уровня

?>
<!DOCTYPE html>
<html>
<head>
    <title>Главная - LinguaFlow</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div style="font-weight: 800; font-size: 1.5rem; color: var(--primary);">LinguaFlow</div>
        <div style="display: flex; gap: 20px;">
            <a href="settings.php" class="btn" style="background: var(--glass);">Настройки</a>
            <a href="profile.php" class="btn" style="background: var(--glass);">Профиль</a>
            <a href="logout.php" class="btn" style="background: rgba(239, 68, 68, 0.2); color: #f87171;">Выход</a>
        </div>
    </nav>

    <div class="container">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
            
            <section>
                <h1 style="margin-bottom: 30px;">Привет, <?= $_SESSION['username'] ?>! 👋</h1>
                <div class="glass-card" style="margin-bottom: 30px; background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(16, 185, 129, 0.1));">
                    <!-- Внутри блока "Твой прогресс" -->
                    <h2>Твой прогресс</h2>
                    <p style="color: var(--text-dim);">Уровень: <span style="color: var(--accent); font-weight: bold;"><?= $level ?> (<?= $current_points ?> XP)</span></p>
                    <div style="width: 100%; height: 10px; background: rgba(255,255,255,0.1); border-radius: 5px; margin-top: 15px; overflow: hidden;">
                        <div style="width: <?= $xp_percentage ?>%; height: 100%; background: var(--primary); transition: width 0.5s ease;"></div>
                    </div>

                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <a href="cards.php" class="glass-card" style="text-decoration: none; display: block;">
                        <h3>📚 Мои слова</h3>
                        <p style="color: var(--text-dim); margin-top: 10px;">Изучай новые карточки по категориям.</p>
                    </a>
                    <a href="tests_gallery.php" class="glass-card" style="text-decoration: none; display: block;">
                        <h3>🎯 Тестирование</h3>
                        <p style="color: var(--text-dim); margin-top: 10px;">Закрепи знания в игровых режимах.</p>
                    </a>
                </div>
            </section>

            <aside>
                <div class="glass-card">
                    <h3>Поддержка</h3>
                    <p style="color: var(--text-dim); font-size: 0.9rem; margin: 15px 0;">Нужна помощь или нашел баг?</p>
                    <a href="support.php" class="btn btn-primary" style="width: 100%;">Написать нам</a>
                </div>
            </aside>

        </div>
    </div>
</body>
</html>
