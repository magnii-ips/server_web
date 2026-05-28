<?php
// ================= КОНТРОЛЛЕР =================

class Controller {
    public function home(): string {
        return '<h2>Статья 1</h2><p>текст первой статьи</p><hr><h2>Статья 2</h2><p> текст второй статьи</p>';
    }

    public function aboutMe(): string {
        return '<h2>Обо мне</h2><p>Здесь будет информация обо мне.</p>';
    }

    public function hello(string $username): string {
        return "<h2>Привет, $username!</h2><p>Добро пожаловать на страницу приветствия.</p>";
    }

    // ================= ЛАБА 7 =================
    // Задание: создать экшн sayBye(string $name), который выводит "Пока, $name"
    public function sayBye(string $name): string {
        return "Пока, $name";
    }
    // ==========================================
}

// ================= РОУТЕР =================

$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);
$path = trim($path, '/');
$parts = explode('/', $path);

$controller = new Controller();
$pageContent = '';

// ================= ЛАБА 8 =================
// Задание: title через переменную, по умолчанию "Мой блог"
$pageTitle = 'Мой блог';
// ==========================================

if ($path === '' || $path === 'index.php' || $path === 'main.php') {
    $pageContent = $controller->home();
} 
elseif ($parts[0] === 'about-me') {
    $pageContent = $controller->aboutMe();
} 
elseif ($parts[0] === 'hello' && isset($parts[1])) {
    $username = urldecode($parts[1]);
    $pageContent = $controller->hello($username);
    
    // ================= ЛАБА 8 =================
    // Задание: для /hello/username title = "Страница приветствия"
    $pageTitle = 'Страница приветствия';
    // ==========================================
} 
elseif ($parts[0] === 'bye' && isset($parts[1])) {
    $name = urldecode($parts[1]);
    
    // ================= ЛАБА 7 =================
    // Задание: роут /bye/{name} вызывает sayBye()
    $pageContent = $controller->sayBye($name);
    // ==========================================
} 
else {
    $pageContent = '<h2>404 Not Found</h2><p>Маршрут не найден.</p>';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    
    <!-- ================= ЛАБА 8 =================
         Задание: динамический title через переменную $pageTitle
    ========================================== -->
    <title><?= htmlspecialchars($pageTitle) ?></title>
    
    <link rel="stylesheet" href="style/styles.css">
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
            <?= $pageContent ?>
        </div>

        <hr>

        <h3>Быстрые ссылки для теста:</h3>
        
        <!-- Кнопка для Лабы 8: проверяет динамический title -->
        <a href="/hello/Иван" class="btn btn-primary">
            Показать приветствие для Ивана
        </a>
        
        <!-- Кнопка для Лабы 7: проверяет роут /bye/{name} -->
        <a href="/bye/Мария" class="btn btn-secondary">
            Показать прощание для Марии
        </a>

        <hr>

        <h3>Другие маршруты:</h3>
        <ul>
            <li><a href="/">Главная страница</a></li>
            <li><a href="/about-me">Обо мне</a></li>
            <li><a href="/hello/Алексей">Приветствие (Алексей)</a></li>
            <li><a href="/bye/Дмитрий">Прощание (Дмитрий)</a></li>
        </ul>
    </div>
</main>

    <footer>
        <p>задание для самостоятельной работы</p>
    </footer>
</body>
</html>