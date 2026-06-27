<?php
require 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $word = trim($_POST['word']);
    $translation = trim($_POST['translation']);
    $lang_word = $_POST['lang_word'] ?? 'en';
    $lang_trans = $_POST['lang_trans'] ?? 'ru';
    $user_id = $_SESSION['user_id'] ?? 0;

    if (!$word || !$translation) {
        $message = 'Пожалуйста, заполните все поля.';
    } else {
        // Проверка дублирования в pending
        $stmt = $pdo->prepare("SELECT id FROM pending_words WHERE word=? AND translation=?");
        $stmt->execute([$word, $translation]);
        if ($stmt->fetch()) {
            $message = 'Это слово уже ожидает одобрения.';
        } else {
            // Вставка в таблицу pending
            $pdo->prepare("INSERT INTO pending_words (word, translation, lang_word, lang_trans, user_id) VALUES (?, ?, ?, ?, ?)")
                ->execute([$word, $translation, $lang_word, $lang_trans, $user_id]);
            $message = 'Заявка отправлена на рассмотрение.';
        }
    }
}
?>

<!-- Форма -->
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<title>Добавить слово — на рассмотрение</title>
<style>
        /* ВОЗВРАЩАЕМ ИЗНАЧАЛЬНЫЕ ПЕРЕМЕННЫЕ И СТИЛИ */
        :root {
          --primary-gradient: linear-gradient(135deg, #667eea, #764ba2);
          --background: linear-gradient(135deg, #1f1c2c, #928dab);
          --text-color: #f0f0f0;
          --hover-scale: 1.05;
          --transition-duration: 0.3s;
        }

        body {
          margin: 0;
          font-family: 'Poppins', sans-serif;
          background: var(--background);
          color: var(--text-color);
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 100vh;
          overflow-x: hidden;
        }

        /* Центрированный макет */
        .centered-layout {
          width: 100%;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          padding: 20px;
        }

        /* Стеклянная карточка (auth-box) */
        .auth-box {
          background: rgba(255, 255, 255, 0.05);
          padding: 40px;
          border-radius: 20px;
          backdrop-filter: blur(10px);
          box-shadow: 0 20px 50px rgba(0,0,0,0.2);
          max-width: 420px;
          width: 100%;
          text-align: center;
          animation: fadeInUp 0.8s forwards;
          border: 1px solid rgba(255,255,255,0.1);
        }

        @keyframes fadeInUp {
          0% { opacity: 0; transform: translateY(20px); }
          100% { opacity: 1; transform: translateY(0); }
        }

        h2 { color: #ffd700; margin-bottom: 20px; }

        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px 5px;
            font-size: 0.9em;
            color: #ccc;
        }

        input, select {
          width: 100%;
          padding: 14px;
          margin-bottom: 15px;
          background: rgba(0, 0, 0, 0.3);
          border: 1px solid rgba(255,255,255,0.1);
          border-radius: 12px;
          color: white;
          box-sizing: border-box;
          outline: none;
        }

        button {
          padding: 14px 20px;
          width: 100%;
          border: none;
          border-radius: 25px;
          background: var(--primary-gradient);
          color: #fff;
          font-size: 16px;
          font-weight: bold;
          cursor: pointer;
          margin-top: 10px;
          transition: transform 0.3s, box-shadow 0.3s;
        }

        button:hover {
          transform: scale(var(--hover-scale));
          box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        /* Навигация назад (как была в начале) */
        .back-btn {
          position: absolute;
          top: 20px;
          left: 20px;
          padding: 10px 18px;
          border-radius: 15px;
          background: rgba(255,255,255,0.1);
          backdrop-filter: blur(5px);
          transition: 0.3s;
          color: #f0f0f0;
          text-decoration: none;
          font-size: 14px;
          border: 1px solid rgba(255,255,255,0.1);
        }
        .back-btn:hover { background: rgba(255,255,255,0.2); transform: translateX(3px); }

        /* Сообщение */
        .status-msg {
            margin-top: 20px;
            padding: 10px;
            border-radius: 10px;
            font-size: 0.9em;
        }
        .success { background: rgba(16, 185, 129, 0.2); color: #10b981; border: 1px solid #10b981; }
        .error { background: rgba(251, 113, 133, 0.2); color: #fb7185; border: 1px solid #fb7185; }
    </style>
</head>
<body>
<div class="page-center">
<h1>Добавить слово для рассмотрения</h1>
<form method="POST">
  <label>Язык слова</label>
  <option value="en">Английский</option>
  <input type="text" name="word" placeholder="Слово" required>

  <label>Язык перевода</label>
  <option value="ru">Русский</option>
  <input type="text" name="translation" placeholder="Перевод" required>

  <button type="submit">Отправить заявку</button>
</form>
<?php if($message): ?>
<div style="margin-top:10px; color:<?= strpos($message, 'одобрения') !== false ? '#10b981' : '#fb7185'; ?>"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>
<a href="dashboard.php" style="display:block; margin-top:30px;">← В главное</a>
</div>
</body>
</html>
