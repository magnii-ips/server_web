<?php
$message = '';
$messageClass = '';

// Если форма отправлена — обновляем запись
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button'])) {
    $id = $_POST['id'] ?? 0;
    $surname = trim($_POST['surname'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $date = $_POST['date'] ?? '';
    $phone = trim($_POST['phone'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $comment = trim($_POST['comment'] ?? '');

    if (!empty($surname) && !empty($name)) {
        try {
            $stmt = $pdo->prepare("UPDATE contacts SET 
                surname=?, name=?, lastname=?, gender=?, date=?, phone=?, location=?, email=?, comment=? 
                WHERE id=?");
            $stmt->execute([
                $surname, $name, $lastname, $gender, $date, 
                $phone, $location, $email, $comment, $id
            ]);
            $message = 'Запись обновлена';
            $messageClass = 'success';
        } catch (PDOException $e) {
            $message = 'Ошибка при обновлении';
            $messageClass = 'error';
        }
    } else {
        $message = 'Ошибка: заполните фамилию и имя';
        $messageClass = 'error';
    }
}

// Получаем ID для редактирования (из GET или POST)
$editId = $_GET['id'] ?? $_POST['id'] ?? null;

// Получаем все контакты для списка
$stmt = $pdo->query("SELECT id, surname, name FROM contacts ORDER BY surname, name");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Если выбран конкретный контакт — загружаем его данные
$row = null;
if ($editId) {
    $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
    $stmt->execute([$editId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif (!empty($contacts)) {
    // Если ничего не выбрано — берём первую запись
    $editId = $contacts[0]['id'];
    $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
    $stmt->execute([$editId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!-- Список контактов для выбора -->
<div class="div-edit">
    <?php foreach ($contacts as $contact): ?>
        <a href="?action=edit&id=<?= $contact['id'] ?>" 
           class="<?= ($contact['id'] == $editId) ? 'currentRow' : '' ?>">
            <?= htmlspecialchars($contact['surname']) ?> <?= htmlspecialchars(substr($contact['name'], 0, 1)) ?>.
        </a><br>
    <?php endforeach; ?>
</div>

<!-- Форма редактирования -->
<?php if ($row): ?>
<form method="post">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="column">
        <?php if ($message): ?>
            <div class="<?= $messageClass ?>">
                <p><?= $message ?></p>
            </div>
        <?php endif; ?>

        <div class="add">
            <label>Фамилия *</label>
            <input type="text" name="surname" value="<?= htmlspecialchars($row['surname']) ?>">
        </div>
        <div class="add">
            <label>Имя *</label>
            <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>">
        </div>
        <div class="add">
            <label>Отчество</label>
            <input type="text" name="lastname" value="<?= htmlspecialchars($row['lastname']) ?>">
        </div>
        <div class="add">
            <label>Пол</label>
            <select name="gender">
                <option value="">Выберите пол</option>
                <option value="мужской" <?= ($row['gender'] == 'мужской') ? 'selected' : '' ?>>мужской</option>
                <option value="женский" <?= ($row['gender'] == 'женский') ? 'selected' : '' ?>>женский</option>
            </select>
        </div>
        <div class="add">
            <label>Дата рождения</label>
            <input type="date" name="date" value="<?= $row['date'] ?>">
        </div>
        <div class="add">
            <label>Телефон</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($row['phone']) ?>">
        </div>
        <div class="add">
            <label>Адрес</label>
            <input type="text" name="location" value="<?= htmlspecialchars($row['location']) ?>">
        </div>
        <div class="add">
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>">
        </div>
        <div class="add">
            <label>Комментарий</label>
            <textarea name="comment"><?= htmlspecialchars($row['comment']) ?></textarea>
        </div>
        <button type="submit" name="button" value="Сохранить" class="form-btn">Сохранить</button>
    </div>
</form>
<?php endif; ?>