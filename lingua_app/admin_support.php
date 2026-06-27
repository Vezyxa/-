<?php require 'db.php'; if($_SESSION['role'] !== 'admin') header('Location: index.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Админ Поддержка - LinguaFlow</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <h1>Тикеты поддержки</h1>
            <a href="admin_dashboard.php" class="btn" style="background: var(--glass);">Назад</a>
        </header>

        <div style="display: grid; gap: 20px;">
            <?php
            $stmt = $pdo->query("SELECT s.*, u.username FROM support_tickets s JOIN users u ON s.user_id = u.id WHERE status='open' ORDER BY created_at ASC");
            while ($ticket = $stmt->fetch()):
            ?>
            <div class="glass-card">
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                    <span style="color: var(--accent); font-weight: bold;">Тикет #<?= $ticket['id'] ?></span>
                    <span style="color: var(--text-dim); font-size: 0.8rem;"><?= $ticket['username'] ?> | <?= $ticket['created_at'] ?></span>
                </div>
                <p style="margin-bottom: 20px; font-style: italic; color: #cbd5e1;">"<?= $ticket['message'] ?>"</p>
                
                <form action="reply_ticket.php" method="POST">
                    <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                    <textarea name="reply" placeholder="Ваш ответ..." style="background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border); width: 100%; color: white; border-radius: 12px; padding: 12px;"></textarea>
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px; width: 100%; padding: 8px;">Отправить ответ и закрыть</button>
                </form>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
