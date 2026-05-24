<?php
// Подключение к SQLite базе данных
$pdo = new PDO('sqlite:' . __DIR__ . '/contacts.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Создаём таблицу, если её нет
$pdo->exec("CREATE TABLE IF NOT EXISTS contacts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    surname TEXT NOT NULL,
    name TEXT NOT NULL,
    lastname TEXT,
    gender TEXT,
    date TEXT,
    phone TEXT,
    location TEXT,
    email TEXT,
    comment TEXT
)");
?>