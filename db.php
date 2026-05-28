<?php
// db.php - подключение к SQLite и создание таблиц для Лабы 9

$dsn = 'sqlite:database.db';
$pdo = new PDO($dsn);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Создаём таблицу users, если её нет
$pdo->exec('
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nickname TEXT NOT NULL
    )
');

// Создаём таблицу articles, если её нет
$pdo->exec('
    CREATE TABLE IF NOT EXISTS articles (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        content TEXT NOT NULL,
        author_id INTEGER,
        FOREIGN KEY (author_id) REFERENCES users(id)
    )
');

// Добавляем тестовые данные, если таблица users пустая
$check = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
if ($check == 0) {
    // Добавляем авторов
    $pdo->exec("INSERT INTO users (id, nickname) VALUES 
        (1, 'Иванов'),
        (2, 'Петров'),
        (3, 'Сидоров')
    ");
    
    // Добавляем статьи
    $pdo->exec("INSERT INTO articles (id, title, content, author_id) VALUES 
        (1, 'Первая статья', 'Это текст первой статьи. Она написана Ивановым.', 1),
        (2, 'Вторая статья', 'Это текст второй статьи. Автор - Петров.', 2),
        (3, 'Третья статья', 'Это текст третьей статьи. Написал Сидоров.', 3)
    ");
}
?>