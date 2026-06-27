<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticket_id = intval($_POST['ticket_id']);
    $reply = trim($_POST['reply']);

    if ($ticket_id && $reply) {
        // Обновляем сообщение и ставим статус 'closed'
        $stmt = $pdo->prepare("UPDATE support_tickets SET admin_reply = ?, status='closed' WHERE id = ?");
        $stmt->execute([$reply, $ticket_id]);
    }
}
header('Location: admin_support.php'); // или куда вас перенаправлять
exit;
?>
