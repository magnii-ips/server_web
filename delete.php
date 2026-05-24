<?php
$message = '';

// Если передан ID — удаляем запись
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Получаем фамилию перед удалением (для сообщения)
    $stmt = $pdo->prepare("SELECT surname FROM contacts WHERE id = ?");
    $stmt->execute([$id]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($contact) {
        $surname = $contact['surname'];
        
        // Удаляем запись
        $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->execute([$id]);
        
        $message = "Запись с фамилией <strong>$surname</strong> удалена";
    } else {
        $message = "Запись не найдена";
    }
}

// Получаем список всех контактов для отображения
$stmt = $pdo->query("SELECT id, surname, name FROM contacts ORDER BY surname, name");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Сообщение об удалении -->
<?php if ($message): ?>
    <div class="success">
        <p><?= $message ?></p>
    </div>
<?php endif; ?>

<!-- Список контактов для удаления -->
<div class="column" style="text-align: left;">
    <h3>Выберите запись для удаления:</h3>
    <?php if (!empty($contacts)): ?>
        <ul style="list-style: none; padding: 0;">
            <?php foreach ($contacts as $contact): ?>
                <li style="margin: 10px 0;">
                    <a href="?action=delete&id=<?= $contact['id'] ?>" 
                       style="color: var(--color_a); text-decoration: none; border-bottom: 1px dashed;">
                        <?= htmlspecialchars($contact['surname']) ?> 
                        <?= htmlspecialchars(substr($contact['name'], 0, 1)) ?>.
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>В базе данных нет записей.</p>
    <?php endif; ?>
</div>