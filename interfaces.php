<?php
// Интерфейс CalculateSquare требует реализации метода calculate
interface CalculateSquare {
    public function calculate(): float;
}

// Класс Circle реализует интерфейс для расчёта площади круга
class Circle implements CalculateSquare {
    private float $radius;
    
    public function __construct(float $radius) { 
        $this->radius = $radius; 
    }
    
    // Формула площади круга: π * r²
    public function calculate(): float { 
        return pi() * $this->radius ** 2; 
    }
}

// Класс Square реализует интерфейс для расчёта площади квадрата
class Square implements CalculateSquare {
    private float $side;
    
    public function __construct(float $side) { 
        $this->side = $side; 
    }
    
    // Формула площади квадрата: сторона в квадрате
    public function calculate(): float { 
        return $this->side ** 2; 
    }
}

// Класс Book не реализует интерфейс CalculateSquare
class Book {
    private string $title;
    
    public function __construct(string $title) { 
        $this->title = $title; 
    }
}

// Функция printInfo анализирует объект и выводит информацию о нём
function printInfo(object $obj): string {
    // Получаем имя класса объекта
    $className = get_class($obj);
    $output = "Класс объекта: <strong>$className</strong><br>";
    
    // Проверяем, реализует ли объект интерфейс CalculateSquare
    if ($obj instanceof CalculateSquare) {
        $output .= "Площадь: " . $obj->calculate();
    } else {
        $output .= "Объект класса $className не реализует интерфейс CalculateSquare.";
    }
    return $output;
}

// Создаём массив результатов для разных объектов
$interfaceResults = [
    printInfo(new Circle(5)),
    printInfo(new Square(4)),
    printInfo(new Book("PHP для чайников"))
];
?>