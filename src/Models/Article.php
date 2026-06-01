<?php
namespace App\Models;

use App\Services\Db;

class Article {
    private \PDO $db;
    
    public function __construct() {
        $this->db = Db::getInstance();
    }
    
    public function getAll(): array {
        $stmt = $this->db->query('
            SELECT a.*, e.nickname, c.name as cat_name 
            FROM articles a 
            LEFT JOIN experts e ON a.expert_id = e.id 
            LEFT JOIN categories c ON a.category_id = c.id
            ORDER BY a.created_at DESC
        ');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function getWithDetails(int $id): ?array {
        $stmt = $this->db->prepare('
            SELECT a.*, e.nickname, c.name as cat_name, u.username
            FROM articles a 
            LEFT JOIN experts e ON a.expert_id = e.id 
            LEFT JOIN categories c ON a.category_id = c.id
            LEFT JOIN users u ON a.user_id = u.id
            WHERE a.id = ?
        ');
        $stmt->execute([$id]);
        $article = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $article ?: null;
    }
    
    public function canEdit(int $articleId, int $userId): bool {
        $stmt = $this->db->prepare('SELECT user_id FROM articles WHERE id = ?');
        $stmt->execute([$articleId]);
        $article = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return $article && $article['user_id'] == $userId;
    }
    
    public function create(array $data, int $userId): bool {
        $stmt = $this->db->prepare('
            INSERT INTO articles (title, content, user_id, expert_id, category_id, price, year, mileage, engine, power, drivetrain, transmission, fuel_type, acceleration, consumption, image) 
            VALUES (?, ?, ?, 1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');
        return $stmt->execute([
            $data['title'],
            $data['content'],
            $userId,
            $data['category_id'],
            $data['price'],
            $data['year'],
            $data['mileage'],
            $data['engine'],
            $data['power'],
            $data['drivetrain'],
            $data['transmission'],
            $data['fuel_type'],
            $data['acceleration'],
            $data['consumption'],
            $data['image']
        ]);
    }
    
    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare('
            UPDATE articles SET title = ?, content = ?, price = ?, year = ?, mileage = ?, 
            engine = ?, power = ?, drivetrain = ?, transmission = ?, fuel_type = ?, 
            acceleration = ?, consumption = ? WHERE id = ?
        ');
        return $stmt->execute([
            $data['title'],
            $data['content'],
            $data['price'],
            $data['year'],
            $data['mileage'],
            $data['engine'],
            $data['power'],
            $data['drivetrain'],
            $data['transmission'],
            $data['fuel_type'],
            $data['acceleration'],
            $data['consumption'],
            $id
        ]);
    }
    
    public function delete(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM articles WHERE id = ?');
        return $stmt->execute([$id]);
    }
    
    public function getCategories(): array {
        return $this->db->query('SELECT * FROM categories')->fetchAll(\PDO::FETCH_ASSOC);
    }
}