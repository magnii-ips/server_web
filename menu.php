<?php
function generateMenu($activeAction = 'view', $activeSort = 'id') {
    $menu = '<div class="menu">';
    
    // Основные пункты меню
    $menuItems = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    ];
    
    $menu .= '<div class="main-menu">';
    foreach ($menuItems as $action => $label) {
        $class = ($activeAction === $action) ? 'select' : '';
        $menu .= '<a href="index.php?action=' . $action . '" class="' . $class . '">' . $label . '</a> ';
    }
    $menu .= '</div>';
    
    // Дополнительные пункты (сортировка) - только для Просмотра
    if ($activeAction === 'view') {
        $menu .= '<div class="submenu">';
        $sortItems = [
            'id' => 'По порядку добавления',
            'surname' => 'По фамилии',
            'date' => 'По дате рождения'
        ];
        
        foreach ($sortItems as $sort => $label) {
            $class = ($activeSort === $sort) ? 'select' : '';
            $menu .= '<a href="index.php?action=view&sort=' . $sort . '" class="' . $class . '">' . $label . '</a> ';
        }
        $menu .= '</div>';
    }
    
    $menu .= '</div>';
    
    return $menu;
}
?>