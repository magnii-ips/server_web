<?php
// Абстрактный класс HumanAbstract задаёт шаблон для всех людей
abstract class HumanAbstract {
    private string $name;

    // Конструктор сохраняет имя человека
    public function __construct(string $name) {
        $this->name = $name;
    }

    // Геттер возвращает имя человека
    public function getName(): string {
        return $this->name;
    }

    // Абстрактный метод должен быть реализован в наследниках
    abstract public function getGreetings(): string;
    
    // Абстрактный метод должен быть реализован в наследниках
    abstract public function getMyNameIs(): string;

    // Метод формирует полное представление человека
    public function introduceYourself(): string {
        return $this->getGreetings() . '! ' . $this->getMyNameIs() . ' ' . $this->getName() . '.';
    }
}

// Класс RussianHuman реализует приветствие на русском языке
class RussianHuman extends HumanAbstract {
    public function getGreetings(): string { 
        return "Привет"; 
    }
    
    public function getMyNameIs(): string { 
        return "Меня зовут"; 
    }
}

// Класс EnglishHuman реализует приветствие на английском языке
class EnglishHuman extends HumanAbstract {
    public function getGreetings(): string { 
        return "Hello"; 
    }
    
    public function getMyNameIs(): string { 
        return "My name is"; 
    }
}

// Создаём объекты русского и английского человека
$ruHuman = new RussianHuman("Иван");
$enHuman = new EnglishHuman("John");
?>