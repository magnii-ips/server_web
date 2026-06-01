<?php
namespace App\Services;

class Db {
    private static ?\PDO $instance = null;
    
    public static function getInstance(): \PDO {
        if (self::$instance === null) {
            $dbPath = __DIR__ . '/../../data/autoreview.db';
            
            if (!file_exists(__DIR__ . '/../../data')) {
                mkdir(__DIR__ . '/../../data', 0777, true);
            }
            
            $dsn = 'sqlite:' . $dbPath;
            self::$instance = new \PDO($dsn);
            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::initTables();
        }
        return self::$instance;
    }
    
    private static function initTables(): void {
        $pdo = self::$instance;
        
        $pdo->exec('
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL UNIQUE,
                password TEXT NOT NULL,
                nickname TEXT NOT NULL,
                specialty TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ');
        
        $pdo->exec('
            CREATE TABLE IF NOT EXISTS experts (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nickname TEXT NOT NULL,
                specialty TEXT
            )
        ');
        
        $pdo->exec('
            CREATE TABLE IF NOT EXISTS categories (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL
            )
        ');
        
        $pdo->exec('
            CREATE TABLE IF NOT EXISTS articles (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT NOT NULL,
                content TEXT NOT NULL,
                user_id INTEGER,
                expert_id INTEGER,
                category_id INTEGER,
                price INTEGER,
                year INTEGER,
                mileage INTEGER,
                engine VARCHAR(50),
                power INTEGER,
                drivetrain VARCHAR(20),
                transmission VARCHAR(30),
                fuel_type VARCHAR(20),
                acceleration FLOAT,
                consumption FLOAT,
                image VARCHAR(255),
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (expert_id) REFERENCES experts(id),
                FOREIGN KEY (category_id) REFERENCES categories(id)
            )
        ');
        
        $check = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
        if ($check == 0) {
            $password = password_hash('12345', PASSWORD_DEFAULT);
            
            $pdo->exec("INSERT INTO users (id, username, password, nickname, specialty) VALUES 
                (1, 'admin', '$password', 'Александр Петров', 'Спортивные автомобили'),
                (2, 'elena', '$password', 'Елена Сидорова', 'Электромобили'),
                (3, 'mikhail', '$password', 'Михаил Иванов', 'Семейные автомобили')
            ");
            
            $pdo->exec("INSERT INTO experts (id, nickname, specialty) VALUES 
                (1, 'Александр Петров', 'Спортивные автомобили'),
                (2, 'Елена Сидорова', 'Электромобили'),
                (3, 'Михаил Иванов', 'Семейные автомобили')
            ");
            
            $pdo->exec("INSERT INTO categories (id, name) VALUES 
                (1, 'Седан'),
                (2, 'Внедорожник'),
                (3, 'Спорткар'),
                (4, 'Электро'),
                (5, 'Кроссовер')
            ");
            
            $pdo->exec("INSERT INTO articles (id, title, content, user_id, expert_id, category_id, price, year, mileage, engine, power, drivetrain, transmission, fuel_type, acceleration, consumption, image) VALUES 
                (1, 'Tesla Model S Plaid', 'Революционный электромобиль с невероятной динамикой. Три электродвигателя обеспечивают разгон до 100 км/ч за 2.1 секунды. Запас хода на одном заряде составляет 637 км.', 2, 2, 4, 12000000, 2024, 0, 'Электро', 1020, 'Полный', 'Автомат', 'Электричество', 2.1, 0.0, 'tesla_model_s.jpg'),
                (2, 'Toyota Camry XV70', 'Надежный седан бизнес-класса с просторным салоном и низким расходом топлива. Идеальный выбор для семьи и работы.', 3, 3, 1, 3500000, 2024, 0, '2.5 л', 200, 'Передний', 'Автомат', 'Бензин', 9.0, 8.5, 'toyota_camry.jpg'),
                (3, 'Porsche 911 Carrera', 'Легендарный спорткар с заднемоторной компоновкой. Идеальная управляемость и характерный звук оппозитного двигателя.', 1, 1, 3, 11500000, 2024, 0, '3.0 л', 385, 'Задний', 'Робот PDK', 'Бензин', 4.2, 9.0, 'porsche_911.jpg'),
                (4, 'BMW X5 xDrive', 'Премиальный внедорожник с полным приводом xDrive. Мощный двигатель, роскошный салон.', 1, 1, 2, 8500000, 2024, 0, '3.0 л', 340, 'Полный', 'Автомат', 'Бензин', 5.5, 11.0, 'bmw_x5.jpg'),
                (5, 'Mercedes-Benz E-Class', 'Эталон бизнес-класса. Инновационные системы безопасности, комфортный салон.', 3, 3, 1, 6500000, 2024, 0, '2.0 л', 250, 'Задний', 'Автомат', 'Бензин', 6.4, 7.5, 'mercedes_e.jpg'),
                (6, 'Audi RS6 Avant', 'Мощный универсал с двигателем V8 biturbo. Динамика спорткара и практичность универсала.', 1, 1, 3, 10500000, 2024, 0, '4.0 л V8', 600, 'Полный', 'Автомат', 'Бензин', 3.6, 11.7, 'audi_rs6.jpg'),
                (7, 'Lexus RX 450h', 'Надежный гибридный кроссовер премиум-класса. Комфорт, тишина и экономичность.', 3, 3, 5, 6800000, 2024, 0, '3.5 л гибрид', 313, 'Полный', 'Вариатор', 'Бензин', 7.7, 7.0, 'lexus_rx.jpg'),
                (8, 'Ford Mustang GT', 'Классический американский маслкар с атмосферным V8. Мощный звук, отличная динамика.', 1, 1, 3, 5500000, 2024, 0, '5.0 л V8', 450, 'Задний', 'Механика', 'Бензин', 4.3, 12.4, 'ford_mustang.jpg'),
                (9, 'Volkswagen Tiguan', 'Практичный семейный кроссовер. Просторный салон, большой багажник.', 3, 3, 5, 3200000, 2024, 0, '2.0 л', 180, 'Полный', 'Робот DSG', 'Бензин', 7.8, 8.2, 'vw_tiguan.jpg'),
                (10, 'Nissan Leaf', 'Популярный электромобиль для города. Запас хода до 385 км, быстрая зарядка.', 2, 2, 4, 3800000, 2024, 0, 'Электро', 217, 'Передний', 'Автомат', 'Электричество', 6.9, 0.0, 'nissan_leaf.jpg')
            ");
        }
    }
}