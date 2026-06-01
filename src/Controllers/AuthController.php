<?php
namespace App\Controllers;

use App\Services\Db;

class AuthController {
    private \PDO $db;
    
    public function __construct() {
        $this->db = Db::getInstance();
    }
    
    public function login(): void {
        $error = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $stmt = $this->db->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->execute([$username]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nickname'] = $user['nickname'];
                header('Location: /');
                exit;
            } else {
                $error = 'Неверный логин или пароль';
            }
        }
        
        $title = 'Вход';
        require_once __DIR__ . '/../Views/auth/login.php';
    }
    
    public function register(): void {
        $error = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $nickname = $_POST['nickname'] ?? '';
            
            if (strlen($password) < 4) {
                $error = 'Пароль должен быть не менее 4 символов';
            } else {
                try {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $this->db->prepare('INSERT INTO users (username, password, nickname) VALUES (?, ?, ?)');
                    $stmt->execute([$username, $hashedPassword, $nickname]);
                    
                    $_SESSION['user_id'] = $this->db->lastInsertId();
                    $_SESSION['username'] = $username;
                    $_SESSION['nickname'] = $nickname;
                    
                    header('Location: /');
                    exit;
                } catch (\PDOException $e) {
                    $error = 'Пользователь с таким именем уже существует';
                }
            }
        }
        
        $title = 'Регистрация';
        require_once __DIR__ . '/../Views/auth/register.php';
    }
    
    public function logout(): void {
        session_destroy();
        header('Location: /');
        exit;
    }
}