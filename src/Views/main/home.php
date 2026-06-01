<?php require_once __DIR__ . '/../../Templates/header.php'; ?>

<div class="hero">
    <h1>Добро пожаловать в AutoReview</h1>
    <p class="hero-subtitle">Профессиональные обзоры автомобилей от наших экспертов.</p>
    <div class="hero-buttons">
        <a href="/articles" class="btn btn-large">Смотреть все обзоры</a>
        <a href="/calculator" class="btn btn-large btn-sec">Калькулятор стоимости</a>
    </div>
</div>

<div class="features">
    <div class="feature-card">
        <h3>База обзоров</h3>
        <p>Подробные обзоры автомобилей разных марок и моделей с полными характеристиками</p>
        <ul class="feature-list">
            <li>Технические характеристики</li>
            <li>Реальные тесты</li>
            <li>Расчет стоимости владения</li>
        </ul>
    </div>
    <div class="feature-card">
        <h3>Калькулятор</h3>
        <p>Рассчитайте полную стоимость владения автомобилем с учетом всех расходов</p>
        <ul class="feature-list">
            <li>Транспортный налог</li>
            <li>Амортизация</li>
            <li>Страховка</li>
        </ul>
        <a href="/calculator" class="btn">Рассчитать</a>
    </div>
</div>

<?php require_once __DIR__ . '/../../Templates/footer.php'; ?>