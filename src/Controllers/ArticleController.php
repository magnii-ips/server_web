<?php
namespace App\Controllers;

use App\Models\Article;

class ArticleController {
    private Article $model;
    
    public function __construct() {
        $this->model = new Article();
    }
    
    public function index(): void {
        $articles = $this->model->getAll();
        $title = 'Все обзоры автомобилей';
        require_once __DIR__ . '/../Views/articles/index.php';
    }
    
    public function view(int $id): void {
        $article = $this->model->getWithDetails($id);
        
        if ($article) {
            $canEdit = false;
            if (isset($_SESSION['user_id'])) {
                $canEdit = $this->model->canEdit($id, $_SESSION['user_id']);
            }
            
            $title = $article['title'];
            require_once __DIR__ . '/../Views/articles/view.php';
        } else {
            http_response_code(404);
            echo '<h1>404 - Статья не найдена</h1>';
        }
    }
    
    public function edit(int $id): void {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        if (!$this->model->canEdit($id, $_SESSION['user_id'])) {
            http_response_code(403);
            echo '<h1>403 - Доступ запрещен</h1>';
            exit;
        }
        
        $message = '';
        $article = $this->model->getWithDetails($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'price' => (int)$_POST['price'],
                'year' => (int)$_POST['year'],
                'mileage' => (int)$_POST['mileage'],
                'engine' => $_POST['engine'],
                'power' => (int)$_POST['power'],
                'drivetrain' => $_POST['drivetrain'],
                'transmission' => $_POST['transmission'],
                'fuel_type' => $_POST['fuel_type'],
                'acceleration' => (float)$_POST['acceleration'],
                'consumption' => (float)$_POST['consumption']
            ]);
            $message = '<div class="success">Автомобиль обновлен!</div>';
            $article = $this->model->getWithDetails($id);
        }
        
        $title = 'Редактирование: ' . ($article['title'] ?? '');
        require_once __DIR__ . '/../Views/articles/edit.php';
    }
    
    public function create(): void {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $message = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create([
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'category_id' => (int)$_POST['category_id'],
                'price' => (int)$_POST['price'],
                'year' => (int)$_POST['year'],
                'mileage' => (int)$_POST['mileage'],
                'engine' => $_POST['engine'],
                'power' => (int)$_POST['power'],
                'drivetrain' => $_POST['drivetrain'],
                'transmission' => $_POST['transmission'],
                'fuel_type' => $_POST['fuel_type'],
                'acceleration' => (float)$_POST['acceleration'],
                'consumption' => (float)$_POST['consumption'],
                'image' => $_POST['image'] ?? ''
            ], $_SESSION['user_id']);
            header('Location: /articles');
            exit;
        }
        
        $categories = $this->model->getCategories();
        $title = 'Добавить обзор автомобиля';
        require_once __DIR__ . '/../Views/articles/create.php';
    }
    
    public function delete(int $id): void {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        if (!$this->model->canEdit($id, $_SESSION['user_id'])) {
            http_response_code(403);
            echo '<h1>403 - Доступ запрещен</h1>';
            exit;
        }
        
        $this->model->delete($id);
        header('Location: /articles');
        exit;
    }
}