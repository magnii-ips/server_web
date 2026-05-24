<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.jpg" alt="Логотип МосПолитех" class="logo">
        <h1>Лабораторная работа №1: Hello, World!</h1>
    </header>

    <main>
        <div class="content">
            <!-- ДИНАМИЧЕСКИЙ КОНТЕНТ НА PHP -->
            <h2><?php echo "Hello, World!"; ?></h2>
            
            <p>Текущая дата и время: 
                <strong><?php echo date("d.m.Y H:i:s"); ?></strong>
            </p>
            
            <p>День недели: 
                <strong><?php 
                    $days = ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"];
                    echo $days[date("w")]; 
                ?></strong>
            </p>

            <p>Приветствие: 
                <strong><?php 
                    $hour = date("H");
                    if ($hour < 12) {
                        echo "Доброе утро!";
                    } elseif ($hour < 18) {
                        echo "Добрый день!";
                    } else {
                        echo "Добрый вечер!";
                    }
                ?></strong>
            </p>
        </div>
    </main>

    <footer>
        <p>задание для самостоятельной работы</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>