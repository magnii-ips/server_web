<?php require_once __DIR__ . '/../../Templates/header.php'; ?>

<h2>Калькулятор стоимости владения</h2>

<form method="POST" class="form">
    <div class="form-group">
        <label>Стоимость авто (₽)</label>
        <div class="counter-wrapper">
            <button type="button" class="counter-btn" onclick="adjustValue('price', -100000)">− 100 000</button>
            <input type="number" id="price" name="price" value="1000000" step="100000" required>
            <button type="button" class="counter-btn" onclick="adjustValue('price', 100000)">+ 100 000</button>
        </div>
    </div>

    <div class="form-group">
        <label>Срок владения (лет)</label>
        <input type="number" name="years" value="3" min="1" max="10" step="1">
    </div>

    <div class="form-group">
        <label>Пробег за все время (км)</label>
        <div class="counter-wrapper">
            <button type="button" class="counter-btn" onclick="adjustValue('mileage', -1000)">− 1 000</button>
            <input type="number" id="mileage" name="mileage" value="15000" step="1000" required>
            <button type="button" class="counter-btn" onclick="adjustValue('mileage', 1000)">+ 1 000</button>
        </div>
    </div>

    <button type="submit" class="btn" style="width: 100%;">Рассчитать</button>
</form>

<?php if (!empty($calcData)): ?>
<div class="calc-result">
    <h3>Результаты</h3>
    <div class="calc-item"><span>Налог:</span><span><?= $calcData['tax'] ?> ₽</span></div>
    <div class="calc-item"><span>Амортизация:</span><span><?= $calcData['depreciation'] ?> ₽</span></div>
    <div class="calc-item"><span>Топливо:</span><span><?= $calcData['fuel'] ?> ₽</span></div>
    <div class="calc-item"><span>Страховка:</span><span><?= $calcData['insurance'] ?> ₽</span></div>
    <div class="calc-item calc-total"><span>Итого:</span><span><?= $calcData['total'] ?> ₽</span></div>
</div>
<?php endif; ?>

<script>
function adjustValue(id, amount) {
    const input = document.getElementById(id);
    let val = parseInt(input.value) || 0;
    val += amount;
    if (val < 0) val = 0;
    input.value = val;
}
</script>

<?php require_once __DIR__ . '/../../Templates/footer.php'; ?>