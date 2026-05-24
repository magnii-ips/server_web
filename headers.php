<!DOCTYPE html>
<!-- Страница 2: Результат функции get_headers -->
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Headers - Страница 2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- HEADER: Логотип слева, название по центру -->
    <header>
        <img src="logo.jpg" alt="Логотип МосПолитех" class="logo">
        <h1>Лабораторная работа №2: Feedback Form</h1>
    </header>

    <!-- MAIN 2: Результат get_headers -->
    <main>
        <div class="content">
            <h2>Результат работы функции get_headers()</h2>
            
            <p class="description">
                Заголовки ответа от сервера https://httpbin.org:
            </p>

            <!-- Выводим результат get_headers в textarea -->
            <textarea class="headers-output" rows="20" readonly>
<?php
// Получаем заголовки от сервера
$url = "https://httpbin.org";
$headers = get_headers($url, 1);

// Форматируем вывод
if ($headers) {
    echo "=== ЗАГОЛОВКИ СЕРВЕРА ===\n\n";
    foreach ($headers as $key => $value) {
        if (is_array($value)) {
            // Если значение - массив (несколько одинаковых заголовков)
            echo $key . ": " . implode(", ", $value) . "\n";
        } else {
            echo $key . ": " . $value . "\n";
        }
    }
} else {
    echo "Не удалось получить заголовки";
}
?>
            </textarea>

            <!-- Ссылка обратно на форму -->
            <div class="nav-link">
                <a href="index.php" class="btn-secondary">← Вернуться к форме</a>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <p>задание для самостоятельной работы</p>
    </footer>
</body>
</html>