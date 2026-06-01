<?php require_once __DIR__ . '/../../Templates/header.php'; ?>

<h1>Все обзоры автомобилей</h1>

<div class="grid">
    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <div class="card">
                <div class="image-placeholder <?= !empty($article['image']) ? 'has-image' : '' ?>">
                    <?php if (!empty($article['image'])): ?>
                        <img src="/public/images/<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>">
                    <?php else: ?>
                        <span>Нет фото</span>
                    <?php endif; ?>
                </div>
                
                <span class="badge"><?= htmlspecialchars($article['cat_name']) ?></span>
                <h3><?= htmlspecialchars($article['title']) ?></h3>
                
                <div class="specs">
                    <div class="specs-grid">
                        <div class="spec-item"><div class="spec-label">Год</div><div class="spec-value"><?= htmlspecialchars($article['year']) ?></div></div>
                        <div class="spec-item"><div class="spec-label">Пробег</div><div class="spec-value"><?= number_format($article['mileage'], 0, '.', ' ') ?> км</div></div>
                        <div class="spec-item"><div class="spec-label">Цена</div><div class="spec-value"><?= number_format($article['price'], 0, '.', ' ') ?> ₽</div></div>
                    </div>
                </div>
                
                <p class="meta">Эксперт: <?= htmlspecialchars($article['nickname']) ?></p>
                <p><?= htmlspecialchars(substr($article['content'], 0, 150)) ?>...</p>
                <a href="/articles/<?= $article['id'] ?>" class="btn">Читать далее</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; grid-column: 1/-1; color: #a0a0a0;">Обзоры пока не добавлены</p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../../Templates/footer.php'; ?>