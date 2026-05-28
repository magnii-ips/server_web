<?php
// Класс Cat демонстрирует инкапсуляцию
class Cat {
    // Приватные свойства недоступны извне класса
    private string $name;
    private string $color;

    // Конструктор инициализирует кошку с именем и цветом
    public function __construct(string $name, string $color) {
        $this->name = $name;
        $this->color = $color;
    }

    // Метод sayHello возвращает приветствие с именем и цветом
    public function sayHello(): string {
        return "Привет, я {$this->name}. Мой цвет: {$this->color}.";
    }

    // Геттер позволяет получить значение приватного свойства color
    public function getColor(): string {
        return $this->color;
    }
}

// Создаём объект кошки с именем Барсик и рыжим цветом
$catTaskResult = new Cat("Барсик", "рыжий");
?>