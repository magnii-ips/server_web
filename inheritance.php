<?php
// Базовый класс Lesson представляет обычный урок
class Lesson {
    protected string $title;
    protected string $text;
    protected string $homework;

    // Конструктор инициализирует основные свойства урока
    public function __construct(string $title, string $text, string $homework) {
        $this->title = $title;
        $this->text = $text;
        $this->homework = $homework;
    }
}

// Класс PaidLesson наследуется от Lesson и добавляет свойство цены
class PaidLesson extends Lesson {
    private float $price;

    // Конструктор вызывает родительский конструктор и добавляет цену
    public function __construct(string $title, string $text, string $homework, float $price) {
        parent::__construct($title, $text, $homework);
        $this->price = $price;
    }

    // Геттер возвращает цену урока
    public function getPrice(): float { 
        return $this->price; 
    }
    
    // Сеттер позволяет изменить цену урока
    public function setPrice(float $price): void { 
        $this->price = $price; 
    }
}

// Создаём объект платного урока с заданными свойствами
$paidLessonTask = new PaidLesson(
    "Урок о наследовании в PHP",
    "Лол, кек, чебурек",
    "Ложитесь спать, утро вечера мудренее",
    99.90
);
?>