<?php require_once __DIR__ . '/../../Templates/header.php'; ?>

<div class="article-view">
    <div class="article-header">
        <span class="badge"><?= htmlspecialchars($article['cat_name']) ?></span>
        <h1><?= htmlspecialchars($article['title']) ?></h1>
    </div>
    
    <div class="article-content-wrapper">
        <!-- Левая колонка: Фото и инфо -->
        <div class="article-image-section">
            <?php if (!empty($article['image'])): ?>
                <img src="/public/images/<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="article-main-image">
            <?php else: ?>
                <div class="article-image-placeholder"><span>Нет фотографии</span></div>
            <?php endif; ?>
            
            <div class="article-meta">
                <p><strong>Эксперт:</strong> <?= htmlspecialchars($article['nickname']) ?></p>
                <p><strong>Добавлено:</strong> <?= date('d.m.Y', strtotime($article['created_at'])) ?></p>
            </div>
        </div>
        
        <!-- Правая колонка: Описание и Характеристики -->
        <div class="article-details-section">
            <div class="article-description">
                <h3>Описание</h3>
                <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
            </div>
            
            <div class="article-specs">
                <h3>Характеристики</h3>
                <div class="specs-grid-detailed">
                    <div class="spec-row"><span class="spec-label">Год выпуска:</span><span class="spec-value"><?= htmlspecialchars($article['year']) ?></span></div>
                    <div class="spec-row"><span class="spec-label">Пробег:</span><span class="spec-value"><?= number_format($article['mileage'], 0, '.', ' ') ?> км</span></div>
                    <div class="spec-row"><span class="spec-label">Цена:</span><span class="spec-value"><?= number_format($article['price'], 0, '.', ' ') ?> ₽</span></div>
                    <div class="spec-row"><span class="spec-label">Двигатель:</span><span class="spec-value"><?= htmlspecialchars($article['engine']) ?></span></div>
                    <div class="spec-row"><span class="spec-label">Мощность:</span><span class="spec-value"><?= htmlspecialchars($article['power']) ?> л.с.</span></div>
                    <div class="spec-row"><span class="spec-label">Привод:</span><span class="spec-value"><?= htmlspecialchars($article['drivetrain']) ?></span></div>
                    <div class="spec-row"><span class="spec-label">Коробка:</span><span class="spec-value"><?= htmlspecialchars($article['transmission']) ?></span></div>
                    <div class="spec-row"><span class="spec-label">Топливо:</span><span class="spec-value"><?= htmlspecialchars($article['fuel_type']) ?></span></div>
                    <div class="spec-row"><span class="spec-label">Разгон 0-100:</span><span class="spec-value"><?= htmlspecialchars($article['acceleration']) ?> с</span></div>
                    <div class="spec-row"><span class="spec-label">Расход:</span><span class="spec-value"><?= htmlspecialchars($article['consumption']) ?> л/100км</span></div>
                </div>
            </div>
            
            <?php if ($canEdit): ?>
                <div class="article-actions">
                    <a href="/articles/<?= $article['id'] ?>/edit" class="btn">Редактировать</a>
                    <a href="/articles/<?= $article['id'] ?>/delete" class="btn btn-danger" onclick="return confirm('Удалить этот автомобиль?')">Удалить</a>
                </div>
            <?php else: ?>
                <div class="article-notice">
                    <p>️ Вы не можете редактировать эту карточку, так как она создана другим пользователем</p>
                </div>
            <?php endif; ?>
            
            <div style="margin-top: 20px;">
                <a href="/articles" class="btn btn-sec">← Назад к списку</a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../Templates/footer.php'; ?>