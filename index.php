<?php
// Подключаем файлы с логикой
require_once 'encapsulation.php';
require_once 'interfaces.php';
require_once 'inheritance.php';
require_once 'abstract_classes.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №6: ООП в PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- HEADER -->
    <header>
        <img src="logo.jpg" alt="Логотип МосПолитех">
        <h1>Лабораторная работа №6: ООП в PHP</h1>
    </header>

    <!-- MAIN CONTENT -->
    <main>
        
        <!-- ЗАДАНИЕ 1 -->
        <section class="task">
            <h2>Задание 1: Инкапсуляция</h2>
            <div class="result">
                <p><?= $catTaskResult->sayHello() ?></p>
                <p><strong>Геттер color:</strong> <?= $catTaskResult->getColor() ?></p>
            </div>
        </section>

        <!-- ЗАДАНИЕ 2 -->
        <section class="task">
            <h2>Задание 2: Интерфейсы + get_class()</h2>
            <div class="result">
                <?php foreach ($interfaceResults as $res): ?>
                    <p><?= $res ?></p>
                    <hr>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ЗАДАНИЕ 3 -->
        <section class="task">
            <h2>Задание 3: Наследование + PaidLesson</h2>
            <div class="result">
                <h3>Объект PaidLesson:</h3>
                <pre><?php var_dump($paidLessonTask) ?></pre>
                <p><strong>Цена урока:</strong> <?= $paidLessonTask->getPrice() ?> ₽</p>
            </div>
        </section>

        <!-- ЗАДАНИЕ 4 -->
        <section class="task">
            <h2> Задание 4: Абстрактные классы</h2>
            <div class="result">
                <p><?= $ruHuman->introduceYourself() ?></p>
                <p><?= $enHuman->introduceYourself() ?></p>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer>
        <p>задание для самостоятельной работы</p>
    </footer>
</body>
</html>