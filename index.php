<!DOCTYPE html>
<!-- Страница 1: Форма обратной связи -->
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form - Страница 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- HEADER: Логотип слева, название по центру -->
    <header>
        <img src="logo.jpg" alt="Логотип МосПолитех" class="logo">
        <h1>Лабораторная работа №2: Feedback Form</h1>
    </header>

    <!-- MAIN 1: Форма обратной связи -->
    <main>
        <div class="content">
            <h2>Форма обратной связи</h2>
            
            <!-- Форма отправляется на https://httpbin.org/post -->
            <form action="https://httpbin.org/post" method="POST" class="feedback-form">
                
                <!-- Имя пользователя -->
                <div class="form-group">
                    <label for="name">Имя пользователя:</label>
                    <input type="text" id="name" name="name" required placeholder="Введите ваше имя">
                </div>

                <!-- E-mail пользователя -->
                <div class="form-group">
                    <label for="email">E-mail пользователя:</label>
                    <input type="email" id="email" name="email" required placeholder="example@mail.ru">
                </div>

                <!-- Тип обращения (выпадающий список) -->
                <div class="form-group">
                    <label for="type">Тип обращения:</label>
                    <select id="type" name="type" required>
                        <option value="" disabled selected>Выберите тип</option>
                        <option value="complaint">Жалоба</option>
                        <option value="suggestion">Предложение</option>
                        <option value="gratitude">Благодарность</option>
                    </select>
                </div>

                <!-- Текст обращения -->
                <div class="form-group">
                    <label for="message">Текст обращения:</label>
                    <textarea id="message" name="message" rows="5" required placeholder="Опишите ваше обращение..."></textarea>
                </div>

                <!-- Вариант ответа (checkbox) -->
                <div class="form-group">
                    <label>Вариант ответа:</label>
                    <div class="checkbox-group">
                        <label>
                            <input type="checkbox" name="response[]" value="sms"> СМС
                        </label>
                        <label>
                            <input type="checkbox" name="response[]" value="email"> E-mail
                        </label>
                    </div>
                </div>

                <!-- Кнопка отправить -->
                <button type="submit" class="btn-submit">Отправить</button>
            </form>

            <!-- Ссылка на 2 страницу -->
            <div class="nav-link">
                <a href="headers.php" class="btn-secondary">Перейти на страницу 2 (get_headers)</a>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <p>задание для самостоятельной работы</p>
    </footer>
</body>
</html>