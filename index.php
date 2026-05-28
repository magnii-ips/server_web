<?php
header('Content-Type: text/html; charset=utf-8');
// ================= КОНТРОЛЛЕР =================

class Controller {
    // Метод sayBye принимает имя и возвращает прощание
    public function sayBye(string $name): string {
        return "Пока, $name";
    }
}

// ================= РОУТЕР =================

// Получаем путь из URL
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);
$path = trim($path, '/');
$parts = explode('/', $path);

// Создаём экземпляр контроллера
$controller = new Controller();

// Обрабатываем роут /bye/{name}
if ($parts[0] === 'bye' && isset($parts[1])) {
    $name = urldecode($parts[1]);
    // Дополнительно декодируем если нужно
    $name = mb_convert_encoding($name, 'UTF-8', 'UTF-8');
    $result = $controller->sayBye($name);
} else 
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №7: Роутинг</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.jpg" alt="Логотип МосПолитех">
        <h1>Лабораторная работа №7: Роутинг и Контроллер</h1>
    </header>

    <main>
        <div class="task-container">
            <h2>Результат выполнения роута:</h2>
            <div class="result">
                <?= htmlspecialchars($result) ?>
            </div>

            <hr>

            <h3>Примеры использования:</h3>
            <ul>
                <li><a href="/bye/Иван">/bye/Иван</a></li>
                <li><a href="/bye/Мария">/bye/Мария</a></li>
                <li><a href="/bye/Алексей">/bye/Алексей</a></li>
            </ul>
        </div>
    </main>

    <footer>
        <p>задание для самостоятельной работы</p>
    </footer>
</body>
</html>