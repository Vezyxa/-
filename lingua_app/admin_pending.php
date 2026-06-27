<?php require 'db.php'; if($_SESSION['role'] !== 'admin') header('Location: index.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Модерация слов - LinguaFlow</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h1>Заявки на добавление</h1>
            <a href="admin_dashboard.php" class="btn" style="background: var(--glass);">Назад</a>
        </div>

        <div style="display: flex; flex-direction: column; gap: 15px;">
            <?php
            $stmt = $pdo->query("SELECT p.*, u.username FROM pending_words p JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC");
            while ($row = $stmt->fetch()):
            ?>
            <div class="glass-card" style="display: flex; justify-content: space-between; align-items: center; padding: 20px;">
                <div>
                    <span style="color: var(--primary); font-weight: bold; font-size: 1.2rem;"><?= $row['word'] ?></span>
                    <span style="color: var(--text-dim); margin: 0 15px;">—</span>
                    <span style="color: white;"><?= $row['translation'] ?></span>
                    <div style="font-size: 0.8rem; color: var(--text-dim); margin-top: 5px;">От: <?= $row['username'] ?></div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <form action="approve_word.php" method="POST">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn" style="background: rgba(16, 185, 129, 0.2); color: #34d399; font-size: 0.9rem;">Одобрить</button>
                    </form>
                    <form action="reject_word.php" method="POST">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn" style="background: rgba(239, 68, 68, 0.2); color: #f87171; font-size: 0.9rem;">Удалить</button>
                    </form>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
