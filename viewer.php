<?php
function showTable($pdo, $sort = 'id', $page = 1) {
    $recordsPerPage = 10;
    $offset = ($page - 1) * $recordsPerPage;
    
    // Определение порядка сортировки
    $sortOptions = ['id', 'surname', 'date'];
    if (!in_array($sort, $sortOptions)) {
        $sort = 'id';
    }
    
    // Получаем общее количество записей
    $totalStmt = $pdo->query("SELECT COUNT(*) FROM contacts");
    $totalRecords = $totalStmt->fetchColumn();
    $totalPages = ceil($totalRecords / $recordsPerPage);
    
    // Получаем записи
    $stmt = $pdo->prepare("SELECT * FROM contacts ORDER BY $sort ASC LIMIT ? OFFSET ?");
    $stmt->execute([$recordsPerPage, $offset]);
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Формируем HTML
    $html = '<table border="1" cellpadding="5">';
    $html .= '<tr><th>№</th><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Пол</th><th>Дата рождения</th><th>Телефон</th><th>Email</th></tr>';
    
    foreach ($contacts as $contact) {
        $html .= '<tr>';
        $html .= '<td>' . $contact['id'] . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['surname']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['lastname']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['gender']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['date']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['phone']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['email']) . '</td>';
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    
    // Пагинация
    if ($totalPages > 1) {
        $html .= '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            $class = ($i === $page) ? 'select' : '';
            $html .= '<a href="index.php?action=view&sort=' . $sort . '&page=' . $i . '" class="' . $class . '">' . $i . '</a> ';
        }
        $html .= '</div>';
    }
    
    return $html;
}
?>