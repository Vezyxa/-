<?php
require 'db.php';

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Центр тестирования - LinguaFlow</title>
    <link rel="stylesheet" href="style.css"> <!-- Подключаем основной файл стилей -->
    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #10b981;
            --accent: #f59e0b;
            --bg-dark: #0f172a;
            --glass: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        body {
            background: radial-gradient(circle at top left, #1e293b, #0f172a);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }

        .hub-container {
            max-width: 1000px;
            width: 100%;
            text-align: center;
        }

        .header-section h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            background: linear-gradient(to right, #818cf8, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header-section p {
            color: #94a3b8;
            margin-bottom: 50px;
        }

        .test-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .test-card {
            background: var(--glass);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 40px 30px;
            text-decoration: none;
            color: white;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .test-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .test-card i.icon {
            font-size: 3rem;
            margin-bottom: 20px;
            display: block;
        }

        .test-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .test-card p {
            font-size: 0.95rem;
            color: #94a3b8;
            line-height: 1.5;
        }

        .btn-back {
            margin-top: 50px;
            display: inline-block;
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .btn-back:hover {
            color: white;
        }

        /* Цветовые акценты для карточек */
        .card-1:hover { box-shadow: 0 10px 30px rgba(79, 70, 229, 0.3); }
        .card-2:hover { box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3); }
        .card-3:hover { box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3); }

    </style>
</head>
<body>

    <div class="hub-container">
        <div class="header-section">
            <h1>Тренировка знаний</h1>
            <p>Выбери режим тестирования, чтобы закрепить изученные слова</p>
        </div>

        <div class="test-grid">
            <!-- Тест 1: Выбор варианта -->
            <a href="test_choice.php" class="test-card card-1">
                <span class="icon">🎯</span>
                <h3>Выбор варианта</h3>
                <p>Классический тест: выберите один правильный перевод из четырех предложенных.</p>
            </a>

            <!-- Тест 3: Конструктор слов -->
            <a href="test_select.php" class="test-card card-3">
                <span class="icon">🧩</span>
                <h3>Выбор варианта</h3>
                <p>Обратный режим классическому тесту.</p>
            </a>

            <!-- Тест 2: Обратный перевод -->
            <a href="test_reverse.php" class="test-card card-2">
                <span class="icon">🔄</span>
                <h3>Обратный перевод</h3>
                <p>Усложненный режим: вспомните слово на иностранном языке по его переводу.</p>
            </a>

            <a href="test.php" class="test-card card-1">
                <span class="icon">📗</span>
                <h3>Прямой перевод</h3>
                <p>Вспомни перевод к слову</p>
            </a>
        </div>

        <a href="dashboard.php" class="btn-back">← Вернуться в личный кабинет</a>
    </div>

</body>
</html>
