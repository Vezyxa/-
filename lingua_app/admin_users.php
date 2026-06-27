<?php 
require 'db.php'; 
if($_SESSION['role'] !== 'admin') header('Location: index.php'); 

// Запрос всех пользователей
$users = $pdo->query("SELECT * FROM users ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Управление клиентами - LinguaFlow</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<nav>
    <div style="font-weight: 800; font-size: 1.5rem; color: var(--primary);">LinguaFlow <span style="color:#ccc;">/ Управление</span></div>
    <a href="admin_dashboard.php" class="btn" style="background: var(--glass);">Назад</a>
</nav>

<div class="container" style="margin-top:30px;">
<h1 style="margin-bottom:20px;">Управление пользователями</h1>
<table style="width:100%; border-collapse: collapse;">
    <thead>
        <tr style="background: var(--glass);">
            <th style="padding:10px; border-bottom: 1px solid var(--glass-border);">ID</th>
            <th style="padding:10px; border-bottom: 1px solid var(--glass-border);">Имя</th>
            <th style="padding:10px; border-bottom: 1px solid var(--glass-border);">Email</th>
            <th style="padding:10px; border-bottom: 1px solid var(--glass-border);">Роль</th>
            <th style="padding:10px; border-bottom: 1px solid var(--glass-border);">Статус</th>
            <th style="padding:10px; border-bottom: 1px solid var(--glass-border);">Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr style="background: var(--glass);">
            <td style="padding:10px; border-bottom: 1px solid var(--glass-border);"><?= $user['id'] ?></td>
            <td style="padding:10px; border-bottom: 1px solid var(--glass-border);"><?= htmlspecialchars($user['username']) ?></td>
            <td style="padding:10px; border-bottom: 1px solid var(--glass-border);"><?= htmlspecialchars($user['email']) ?></td>
            <td style="padding:10px; border-bottom: 1px solid var(--glass-border);"><?= $user['role'] ?></td>
            <td style="padding:10px; border-bottom: 1px solid var(--glass-border);">
                <?= $user['is_banned'] ? '<span style="color:#f87171;">Заблокирован</span>' : '<span style="color:#34d399;">Активен</span>' ?>
            </td>
            <td style="padding:10px; border-bottom: 1px solid var(--glass-border);">
                <?php if(!$user['is_banned']): ?>
                <form method="POST" action="ban_user.php" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <button class="btn btn-primary" style="background: rgba(239, 68, 68, 0.2); color:#f87171;">Блокировать</button>
                </form>
                <?php else: ?>
                <form method="POST" action="unban_user.php" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <button class="btn btn-primary" style="background: rgba(16, 185, 129, 0.2); color:#22c55e;">Разблокировать</button>
                </form>
                <?php endif; ?>
                <a href="edit_user.php?user_id=<?= $user['id'] ?>" class="btn btn-primary" style="background: rgba(99, 102, 241, 0.2); color:#6366f1;">Редактировать</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</body>
</html>
