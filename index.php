<?php
$result = "";
$expression = "";

// === BACKEND: Обработка POST запроса ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expression'])) {
    $expression = $_POST['expression'];
    
    // Функции операций
    function my_add($a, $b) { return $a + $b; }
    function my_sub($a, $b) { return $a - $b; }
    function my_mul($a, $b) { return $a * $b; }
    function my_div($a, $b) { 
        if ($b == 0) return "Error: Division by zero"; 
        return $a / $b; 
    }

    // === РЕКУРСИВНЫЙ ПАРСЕР ===
    function calculateRecursive($expr) {
        // 1. Убираем пробелы
        $expr = str_replace(' ', '', $expr);
        
        // 2. Если пусто
        if ($expr === '') return 0;

        // 3. Обработка скобок (ищем самую вложенную или первую закрывающую)
        if (strpos($expr, '(') !== false) {
            // Находим первую закрывающую скобку
            $closePos = strpos($expr, ')');
            // Находим соответствующую открывающую
            $openPos = strrpos(substr($expr, 0, $closePos), '(');
            
            $inside = substr($expr, $openPos + 1, $closePos - $openPos - 1);
            $before = substr($expr, 0, $openPos);
            $after = substr($expr, $closePos + 1);
            
            // Рекурсивно вычисляем то, что в скобках
            $resInside = calculateRecursive($inside);
            
            // Собираем выражение заново без скобок
            $newExpr = $before . $resInside . $after;
            return calculateRecursive($newExpr);
        }

        // 4. Обработка сложения и вычитания (низкий приоритет)
        // Ищем + или -, но не в начале числа (отрицательное)
        // Для простоты ищем последний + или -
        $lastPlus = strrpos($expr, '+');
        $lastMinus = strrpos($expr, '-');
        
        // Если есть операция
        if ($lastPlus !== false || ($lastMinus !== false && $lastMinus > 0)) {
            $opPos = ($lastPlus > $lastMinus) ? $lastPlus : $lastMinus;
            $op = $expr[$opPos];
            
            $left = substr($expr, 0, $opPos);
            $right = substr($expr, $opPos + 1);
            
            $valLeft = calculateRecursive($left);
            $valRight = calculateRecursive($right);
            
            if ($op === '+') return my_add($valLeft, $valRight);
            if ($op === '-') return my_sub($valLeft, $valRight);
        }

        // 5. Обработка умножения и деления (высокий приоритет)
        $lastMul = strrpos($expr, '*');
        $lastDiv = strrpos($expr, '/');
        
        if ($lastMul !== false || $lastDiv !== false) {
            $opPos = ($lastMul > $lastDiv) ? $lastMul : $lastDiv;
            $op = $expr[$opPos];
            
            $left = substr($expr, 0, $opPos);
            $right = substr($expr, $opPos + 1);
            
            $valLeft = calculateRecursive($left);
            $valRight = calculateRecursive($right);
            
            if ($op === '*') return my_mul($valLeft, $valRight);
            if ($op === '/') return my_div($valLeft, $valRight);
        }

        // 6. Если операций нет, возвращаем число
        return floatval($expr);
    }

    try {
        // Проверка на допустимые символы (только цифры и операторы)
        if (preg_match('#[^0-9+\-*/().]#', $expression)) {
            $result = "Error: Invalid characters";
        } else {
            $result = calculateRecursive($expression);
        }
    } catch (Exception $e) {
        $result = "Error";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №4: Калькулятор</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- HEADER -->
    <header>
        <img src="logo.jpg" alt="Логотип МосПолитех" class="logo">
        <h1>Лабораторная работа №4: Калькулятор</h1>
    </header>

    <!-- MAIN -->
    <main>
        <div class="calculator-container">
            <h2>PHP Calculator</h2>
            
            <form method="POST" action="index.php" class="calc-form">
                <!-- Поле ввода (заполняется JS, отправляется на сервер) -->
                <input type="text" id="display" name="expression" value="<?php echo htmlspecialchars($expression); ?>" readonly>
                
                <!-- Результат -->
                <div class="result-display">
                    Результат: <?php echo $result !== "" ? $result : "—"; ?>
                </div>

                <!-- Кнопки калькулятора -->
                <div class="buttons-grid">
                    <button type="button" class="btn btn-clear" onclick="clearDisplay()">C</button>
                    <button type="button" class="btn btn-op" onclick="addToDisplay('(')">(</button>
                    <button type="button" class="btn btn-op" onclick="addToDisplay(')')">)</button>
                    <button type="button" class="btn btn-op" onclick="addToDisplay('/')">/</button>

                    <button type="button" class="btn" onclick="addToDisplay('7')">7</button>
                    <button type="button" class="btn" onclick="addToDisplay('8')">8</button>
                    <button type="button" class="btn" onclick="addToDisplay('9')">9</button>
                    <button type="button" class="btn btn-op" onclick="addToDisplay('*')">*</button>

                    <button type="button" class="btn" onclick="addToDisplay('4')">4</button>
                    <button type="button" class="btn" onclick="addToDisplay('5')">5</button>
                    <button type="button" class="btn" onclick="addToDisplay('6')">6</button>
                    <button type="button" class="btn btn-op" onclick="addToDisplay('-')">-</button>

                    <button type="button" class="btn" onclick="addToDisplay('1')">1</button>
                    <button type="button" class="btn" onclick="addToDisplay('2')">2</button>
                    <button type="button" class="btn" onclick="addToDisplay('3')">3</button>
                    <button type="button" class="btn btn-op" onclick="addToDisplay('+')">+</button>

                    <button type="button" class="btn" onclick="addToDisplay('0')">0</button>
                    <button type="button" class="btn" onclick="addToDisplay('.')">.</button>
                    <!-- Кнопка расчета отправляет форму -->
                    <button type="submit" class="btn btn-equal">=</button>
                </div>
            </form>
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <p>задание для самостоятельной работы</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>