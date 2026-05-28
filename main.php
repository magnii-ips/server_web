<?php
// ================= ПОДКЛЮЧЕНИЕ К БД (для Лабы 9) =================
require_once 'db.php';
// =================================================================

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

// ================= ЛАБА 9 =================
// Контроллер статей с работой с БД
class ArticlesController {
    private $pdo;
    
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    
    // ================= ЛАБА 9 =================
    // Задание: в экшне show() после получения статьи, 
    // добавить запрос на получение автора из таблицы users
    public function show(int $id): array {
        // 1. Получаем статью по ID
        $stmt = $this->pdo->prepare('SELECT * FROM articles WHERE id = ?');
        $stmt->execute([$id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$article) {
            return null;
        }
        
        // 2. Получаем автора статьи из таблицы users (ЗАДАНИЕ ЛАБЫ 9)
        $stmt = $this->pdo->prepare('SELECT nickname FROM users WHERE id = ?');
        $stmt->execute([$article['author_id']]);
        $author = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // 3. Возвращаем статью + никнейм автора
        return [
            'article' => $article,
            'author_nickname' => $author['nickname'] ?? 'Неизвестный автор'
        ];
    }
    // ==========================================
}
// ==========================================

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

// Инициализируем контроллер статей (Лаба 9)
$articlesController = new ArticlesController($pdo);

if ($path === '' || $path === 'index.php' || $path === 'main.php') {
    // Главная - список статей (Лаба 9)
    $stmt = $pdo->query('SELECT id, title FROM articles');
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $pageContent = '<h2>Список статей:</h2><ul>';
    foreach ($articles as $art) {
        $pageContent .= '<li><a href="/article/' . $art['id'] . '">' . htmlspecialchars($art['title']) . '</a></li>';
    }
    $pageContent .= '</ul>';
} 
elseif ($parts[0] === 'article' && isset($parts[1])) {
    // ================= ЛАБА 9 =================
    // Роут /article/{id} → показывает статью с автором
    $articleId = (int)$parts[1];
    $data = $articlesController->show($articleId);
    
    if ($data) {
        // Выводим статью + никнейм автора (ЗАДАНИЕ ЛАБЫ 9)
        $pageContent = '
            <h2>' . htmlspecialchars($data['article']['title']) . '</h2>
            <p><strong>Автор:</strong> ' . htmlspecialchars($data['author_nickname']) . '</p>
            <hr>
            <p>' . nl2br(htmlspecialchars($data['article']['content'])) . '</p>
        ';
    } else {
        $pageContent = '<h2>404</h2><p>Статья не найдена.</p>';
    }
    // ==========================================
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
    
    <link rel="stylesheet" href="/style/styles.css">
</head>
<body>
    <header>
        <img src="logo.jpg" alt="Логотип МосПолитех">
        <h1>Лабораторная работа №7-9: Роутинг, Контроллер и БД</h1>
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

        <h3>Статьи (Лаба 9):</h3>
        <ul>
            <li><a href="/article/1">Статья 1 (автор: Иванов)</a></li>
            <li><a href="/article/2">Статья 2 (автор: Петров)</a></li>
            <li><a href="/article/3">Статья 3 (автор: Сидоров)</a></li>
        </ul>

        <hr>

        <h3>Другие маршруты:</h3>
        <ul>
            <li><a href="/">Главная страница (список статей)</a></li>
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