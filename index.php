<?php
// Подключаем базу данных
require_once 'bd.php';

// Подключаем модули
require_once 'menu.php';
require_once 'viewer.php';

// Получаем параметры из URL
$action = $_GET['action'] ?? 'view';
$sort = $_GET['sort'] ?? 'id';
$page = $_GET['page'] ?? 1;

// Начинаем вывод HTML
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Записная книжка</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.jpg" alt="Логотип МосПолитех">
        <h1>Записная книжка</h1>
    </header>

    <main>
        <!-- Выводим меню -->
        <?=generateMenu($action, $sort)?>

        <!-- Подключаем нужный модуль в зависимости от действия -->
        <?php
        switch ($action) {
            case 'view':
                // Показываем таблицу
                echo showTable($pdo, $sort, $page);
                break;
            
            case 'add':
                // Добавление записи
                require_once 'add.php';
                break;
            
            case 'edit':
                // Редактирование
                require_once 'edit.php';
                break;
            
            case 'delete':
                // Удаление
                require_once 'delete.php';
                break;
            
            default:
                echo showTable($pdo, $sort, $page);
        }
        ?>
    </main>

    <footer>
        <p>задание для самостоятельной работы</p>
    </footer>
</body>
</html>