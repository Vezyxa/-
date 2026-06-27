<?php 
require 'db.php';
if($_SESSION['role'] !== 'admin') header('Location: index.php'); 

// Получаем статистику для плиток
$total_users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$pending_count = $pdo->query("SELECT COUNT(*) FROM pending_words")->fetchColumn();
$tickets_count = $pdo->query("SELECT COUNT(*) FROM support_tickets WHERE status='open'")->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Админ-панель - LinguaFlow</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div style="font-weight: 800; font-size: 1.5rem; color: var(--accent);">LinguaFlow <span style="color:white; font-size: 0.8rem; border: 1px solid var(--accent); padding: 2px 8px; border-radius: 10px; margin-left: 10px;">ADMIN</span></div>
        <a href="logout.php" class="btn" style="background: rgba(239, 68, 68, 0.2); color: #f87171;">Выход</a>
    </nav>

    <div class="container">
        <h1 style="margin-bottom: 40px;">Панель управления</h1>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 40px;">
            <div class="glass-card" style="border-left: 4px solid var(--primary);">
                <p style="color: var(--text-dim);">Пользователей</p>
                <h2 style="font-size: 2.5rem;"><?= $total_users ?></h2>
            </div>

            <div class="glass-card" style="border-left: 4px solid var(--secondary);">
                <p style="color: var(--text-dim);">Открытых тикетов</p>
                <h2 style="font-size: 2.5rem;"><?= $tickets_count ?></h2>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div class="glass-card">
                <h3>Управление пользователями</h3>
                <p style="color: var(--text-dim); margin-bottom: 20px;">Баны - разбаны и редактирование.</p>
                <a href="admin_users.php" class="btn btn-primary" style="width: 100%;">Перейти</a>
            </div>
            <div class="glass-card">
                <h3>Поддержка пользователей</h3>
                <p style="color: var(--text-dim); margin-bottom: 20px;">Ответьте на сообщения и жалобы пользователей.</p>
                <a href="admin_support.php" class="btn btn-primary" style="width: 100%; background: linear-gradient(135deg, var(--secondary), #059669);">Тикеты (<?= $tickets_count ?>)</a>
            </div>
        </div>
    </div>
</body>
</html>
