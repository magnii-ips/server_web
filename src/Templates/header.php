<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'AutoReview') ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <div class="container nav">
            <a href="/" class="logo">AutoReview</a>
            <nav>
                <a href="/">Главная</a>
                <a href="/articles">Обзоры</a>
                <a href="/calculator">Калькулятор</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/articles/create" class="btn-nav">Добавить авто</a>
                    <a href="/logout" class="btn-nav" style="background: #e74c3c;">Выход (<?= htmlspecialchars($_SESSION['nickname']) ?>)</a>
                <?php else: ?>
                    <a href="/login" class="btn-nav">Вход</a>
                    <a href="/register" class="btn-nav">Регистрация</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container">