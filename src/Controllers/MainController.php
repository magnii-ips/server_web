<?php
namespace App\Controllers;

class MainController {
    
    public function index(): void {
        $title = 'AutoReview - Обзоры автомобилей';
        require_once __DIR__ . '/../Views/main/home.php';
    }
    
    public function bye(string $name): void {
        $title = 'До свидания';
        require_once __DIR__ . '/../Views/main/bye.php';
    }
}