<!DOCTYPE html>
<!-- Лабораторная работа №3: Решение уравнений -->
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №3: Решение уравнений</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- HEADER -->
    <header>
        <img src="logo.jpg" alt="Логотип МосПолитех" class="logo">
        <h1>Лабораторная работа №3: Решение уравнений</h1>
    </header>

    <!-- MAIN -->
    <main>
        <div class="content">
            <h2>Вариант 4: X/8=6</h2>
            
            <!-- Форма для ввода уравнения -->
            <div class="equation-form">
                <h3>Решение уравнения</h3>
                
                <?php
                // ================= PHP ЛОГИКА =================
                
                // Вариант 4: X/8=6
                $equation = "X/8=6";
                
                // Инициализируем переменные
                $operator = "";
                $xPosition = "";
                $result = 0;
                $steps = [];
                
                // Функция для решения уравнения
                function solveEquation($eq) {
                    $steps = [];
                    
                    // Определяем оператор
                    if (strpos($eq, '+') !== false) {
                        $operator = '+';
                        $parts = explode('+', $eq);
                    } elseif (strpos($eq, '-') !== false) {
                        $operator = '-';
                        $parts = explode('-', $eq);
                    } elseif (strpos($eq, '*') !== false) {
                        $operator = '*';
                        $parts = explode('*', $eq);
                    } elseif (strpos($eq, '/') !== false) {
                        $operator = '/';
                        $parts = explode('/', $eq);
                    } else {
                        return ['error' => 'Оператор не найден'];
                    }
                    
                    // Разделяем правую часть (после =)
                    $rightPart = explode('=', $parts[1])[1] ?? '';
                    $leftPartAfter = explode('=', $parts[1])[0] ?? '';
                    
                    // Определяем положение X
                    if (stripos($parts[0], 'x') !== false) {
                        $xPosition = 'left'; // X слева
                        $num1 = trim(str_ireplace('x', '', $parts[0]));
                        $num2 = trim($leftPartAfter);
                        $result = trim($rightPart);
                    } else {
                        $xPosition = 'right'; // X справа
                        $num1 = trim($parts[0]);
                        $num2 = trim(str_ireplace('x', '', $leftPartAfter));
                        $result = trim($rightPart);
                    }
                    
                    // Решаем в зависимости от оператора и положения X
                    $answer = 0;
                    $solutionSteps = [];
                    
                    if ($operator == '/') {
                        if ($xPosition == 'left') {
                            // X/a=b → X=b*a
                            $answer = floatval($result) * floatval($num2);
                            $solutionSteps[] = "X/{$num2} = {$result}";
                            $solutionSteps[] = "X = {$result} * {$num2}";
                            $solutionSteps[] = "X = {$answer}";
                        } else {
                            // a/X=b → X=a/b
                            $answer = floatval($num1) / floatval($result);
                            $solutionSteps[] = "{$num1}/X = {$result}";
                            $solutionSteps[] = "X = {$num1} / {$result}";
                            $solutionSteps[] = "X = {$answer}";
                        }
                    } elseif ($operator == '*') {
                        if ($xPosition == 'left') {
                            // X*a=b → X=b/a
                            $answer = floatval($result) / floatval($num2);
                            $solutionSteps[] = "X * {$num2} = {$result}";
                            $solutionSteps[] = "X = {$result} / {$num2}";
                            $solutionSteps[] = "X = {$answer}";
                        } else {
                            // a*X=b → X=b/a
                            $answer = floatval($result) / floatval($num1);
                            $solutionSteps[] = "{$num1} * X = {$result}";
                            $solutionSteps[] = "X = {$result} / {$num1}";
                            $solutionSteps[] = "X = {$answer}";
                        }
                    } elseif ($operator == '+') {
                        if ($xPosition == 'left') {
                            // X+a=b → X=b-a
                            $answer = floatval($result) - floatval($num2);
                            $solutionSteps[] = "X + {$num2} = {$result}";
                            $solutionSteps[] = "X = {$result} - {$num2}";
                            $solutionSteps[] = "X = {$answer}";
                        } else {
                            // a+X=b → X=b-a
                            $answer = floatval($result) - floatval($num1);
                            $solutionSteps[] = "{$num1} + X = {$result}";
                            $solutionSteps[] = "X = {$result} - {$num1}";
                            $solutionSteps[] = "X = {$answer}";
                        }
                    } elseif ($operator == '-') {
                        if ($xPosition == 'left') {
                            // X-a=b → X=b+a
                            $answer = floatval($result) + floatval($num2);
                            $solutionSteps[] = "X - {$num2} = {$result}";
                            $solutionSteps[] = "X = {$result} + {$num2}";
                            $solutionSteps[] = "X = {$answer}";
                        } else {
                            // a-X=b → X=a-b
                            $answer = floatval($num1) - floatval($result);
                            $solutionSteps[] = "{$num1} - X = {$result}";
                            $solutionSteps[] = "X = {$num1} - {$result}";
                            $solutionSteps[] = "X = {$answer}";
                        }
                    }
                    
                    return [
                        'operator' => $operator,
                        'xPosition' => $xPosition,
                        'answer' => $answer,
                        'steps' => $solutionSteps
                    ];
                }
                
                // Решаем уравнение
                $solution = solveEquation($equation);
                ?>
                
                <!-- Вывод уравнения -->
                <div class="equation-display">
                    <p class="equation-text">Дано уравнение: <strong><?php echo $equation; ?></strong></p>
                </div>
                
                <!-- Результаты анализа -->
                <div class="analysis-result">
                    <h4>Анализ уравнения:</h4>
                    <ul>
                        <li><strong>Оператор:</strong> 
                            <?php 
                                $opNames = ['+' => 'сложение', '-' => 'вычитание', '*' => 'умножение', '/' => 'деление'];
                                echo $opNames[$solution['operator']] . ' (' . $solution['operator'] . ')'; 
                            ?>
                        </li>
                        <li><strong>Положение X:</strong> 
                            <?php echo $solution['xPosition'] == 'left' ? 'в левой части' : 'в правой части'; ?>
                        </li>
                    </ul>
                </div>
                
                <!-- Шаги решения -->
                <div class="solution-steps">
                    <h4>Шаги решения:</h4>
                    <ol>
                        <?php foreach ($solution['steps'] as $step): ?>
                            <li><?php echo $step; ?></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
                
                <!-- Ответ -->
                <div class="final-answer">
                    <h3>Ответ: X = <?php echo $solution['answer']; ?></h3>
                </div>
            </div>
            
            <!-- Блок-схема -->
            <div class="flowchart">
                <h3>Блок-схема алгоритма</h3>
                <div class="flowchart-container">
                    <img src="flowchart.png" alt="Блок-схема алгоритма решения уравнения" class="flowchart-img">
                    
                    <!-- Текстовое описание блок-схемы -->
                    <div class="flowchart-description">
                        <h4>Описание алгоритма:</h4>
                        <ol>
                            <li><strong>Начало</strong> — старт программы</li>
                            <li><strong>Ввод уравнения</strong> — получаем строку вида "X/8=6"</li>
                            <li><strong>Определение оператора</strong> — ищем +, -, *, / в уравнении</li>
                            <li><strong>Определение положения X</strong> — проверяем, где находится X (слева или справа от оператора)</li>
                            <li><strong>Выбор формулы решения</strong> — в зависимости от оператора и положения X выбираем соответствующую формулу</li>
                            <li><strong>Вычисление</strong> — выполняем арифметические операции</li>
                            <li><strong>Вывод результата</strong> — показываем значение X</li>
                            <li><strong>Конец</strong> — завершение программы</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <p>задание для самостоятельной работы</p>
    </footer>
</body>
</html>