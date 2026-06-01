<?php require_once __DIR__ . '/../../Templates/header.php'; ?>

<h2>Редактирование: <?= htmlspecialchars($article['title']) ?></h2>

<?= $message ?>

<form method="POST" class="form">
    <div class="form-group"><label>Название</label><input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" required></div>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
        <div class="form-group"><label>Год</label><input type="number" name="year" value="<?= $article['year'] ?>" required></div>
        <div class="form-group"><label>Пробег</label><input type="number" name="mileage" value="<?= $article['mileage'] ?>" required></div>
        <div class="form-group"><label>Цена</label><input type="number" name="price" value="<?= $article['price'] ?>" required></div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
        <div class="form-group"><label>Двигатель</label><input type="text" name="engine" value="<?= htmlspecialchars($article['engine']) ?>"></div>
        <div class="form-group"><label>Мощность</label><input type="number" name="power" value="<?= $article['power'] ?>"></div>
        <div class="form-group"><label>Разгон</label><input type="text" name="acceleration" value="<?= $article['acceleration'] ?>"></div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
        <div class="form-group"><label>Привод</label><input type="text" name="drivetrain" value="<?= htmlspecialchars($article['drivetrain']) ?>"></div>
        <div class="form-group"><label>КПП</label><input type="text" name="transmission" value="<?= htmlspecialchars($article['transmission']) ?>"></div>
        <div class="form-group"><label>Топливо</label><input type="text" name="fuel_type" value="<?= htmlspecialchars($article['fuel_type']) ?>"></div>
    </div>
    <div class="form-group"><label>Расход</label><input type="text" name="consumption" value="<?= $article['consumption'] ?>"></div>

    <div class="form-group"><label>Описание</label><textarea name="content" rows="6" required><?= htmlspecialchars($article['content']) ?></textarea></div>
    
    <div style="display: flex; gap: 10px;">
        <button type="submit" class="btn">Сохранить</button>
        <a href="/articles/<?= $article['id'] ?>" class="btn btn-sec">Отмена</a>
    </div>
</form>

<?php require_once __DIR__ . '/../../Templates/footer.php'; ?>