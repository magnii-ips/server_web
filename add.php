<?php
$message = '';
$messageClass = '';

// Если форма отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button'])) {
    // Получаем данные из формы
    $surname = trim($_POST['surname'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $date = $_POST['date'] ?? '';
    $phone = trim($_POST['phone'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $comment = trim($_POST['comment'] ?? '');

    // Проверяем обязательные поля
    if (!empty($surname) && !empty($name)) {
        try {
            // Добавляем запись в базу
            $stmt = $pdo->prepare("INSERT INTO contacts 
                (surname, name, lastname, gender, date, phone, location, email, comment) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->execute([
                $surname, $name, $lastname, $gender, $date, 
                $phone, $location, $email, $comment
            ]);
            
            $message = 'Запись добавлена';
            $messageClass = 'success';
        } catch (PDOException $e) {
            $message = 'Ошибка: запись не добавлена';
            $messageClass = 'error';
        }
    } else {
        $message = 'Ошибка: заполните обязательные поля (фамилия и имя)';
        $messageClass = 'error';
    }
}
?>

<!-- Форма добавления -->
<form name="form_add" method="post">
    <div class="column">
        <?php if ($message): ?>
            <div class="<?=$messageClass?>">
                <p><?=$message?></p>
            </div>
        <?php endif; ?>

        <div class="add">
            <label>Фамилия *</label>
            <input type="text" name="surname" placeholder="Фамилия" value="">
        </div>
        
        <div class="add">
            <label>Имя *</label>
            <input type="text" name="name" placeholder="Имя" value="">
        </div>
        
        <div class="add">
            <label>Отчество</label>
            <input type="text" name="lastname" placeholder="Отчество" value="">
        </div>
        
        <div class="add">
            <label>Пол</label>
            <select name="gender">
                <option value="">Выберите пол</option>
                <option value="мужской">мужской</option>
                <option value="женский">женский</option>
            </select>
        </div>
        
        <div class="add">
            <label>Дата рождения</label>
            <input type="date" name="date" value="">
        </div>
        
        <div class="add">
            <label>Телефон</label>
            <input type="text" name="phone" placeholder="Телефон" value="">
        </div>
        
        <div class="add">
            <label>Адрес</label>
            <input type="text" name="location" placeholder="Адрес" value="">
        </div>
        
        <div class="add">
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" value="">
        </div>
        
        <div class="add">
            <label>Комментарий</label>
            <textarea name="comment" placeholder="Краткий комментарий"></textarea>
        </div>
        
        <button type="submit" value="Добавить" name="button" class="form-btn">Добавить</button>
    </div>
</form>