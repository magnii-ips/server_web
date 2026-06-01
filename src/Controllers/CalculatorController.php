<?php
namespace App\Controllers;

class CalculatorController {
    
    public function index(): void {
        $result = '';
        $calcData = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $price = (int)$_POST['price'];
            $years = (int)$_POST['years'];
            $mileage = (int)$_POST['mileage'];
            
            $tax = $price * 0.05;
            $depreciation = $price * 0.15 * $years;
            $fuel = ($mileage / 100) * 8 * 50 * $years;
            $insurance = 15000 * $years;
            $total = $tax + $depreciation + $fuel + $insurance;
            
            $calcData = [
                'tax' => number_format($tax, 0, '.', ' '),
                'depreciation' => number_format($depreciation, 0, '.', ' '),
                'fuel' => number_format($fuel, 0, '.', ' '),
                'insurance' => number_format($insurance, 0, '.', ' '),
                'total' => number_format($total, 0, '.', ' ')
            ];
        }
        
        $title = 'Калькулятор владения автомобилем';
        require_once __DIR__ . '/../Views/calculator/index.php';
    }
}