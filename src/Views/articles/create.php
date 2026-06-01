<?php require_once __DIR__ . '/../../Templates/header.php'; ?>

<h2>Добавить новый автомобиль</h2>

<form method="POST" class="form">
    <div class="form-group">
        <label>Название автомобиля</label>
        <input type="text" name="title" required>
    </div>
    
    <div class="form-group">
        <label>Категория</label>
        <select name="category_id" required>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
        <div class="form-group"><label>Год</label><input type="number" name="year" required></div>
        <div class="form-group"><label>Пробег</label><input type="number" name="mileage" required></div>
        <div class="form-group"><label>Цена</label><input type="number" name="price" required></div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
        <div class="form-group"><label>Двигатель</label><input type="text" name="engine" placeholder="2.0 л"></div>
        <div class="form-group"><label>Мощность (л.с.)</label><input type="number" name="power" required></div>
        <div class="form-group"><label>Разгон 0-100</label><input type="text" name="acceleration" placeholder="6.5"></div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
        <div class="form-group"><label>Привод</label><input type="text" name="drivetrain" placeholder="Полный"></div>
        <div class="form-group"><label>КПП</label><input type="text" name="transmission" placeholder="Автомат"></div>
        <div class="form-group"><label>Топливо</label><input type="text" name="fuel_type" placeholder="Бензин"></div>
    </div>
    
    <div class="form-group"><label>Расход (л/100км)</label><input type="text" name="consumption" placeholder="8.5"></div>
    <div class="form-group"><label>Название файла фото (опционально)</label><input type="text" name="image" placeholder="car.jpg"></div>
    
    <div class="form-group"><label>Описание</label><textarea name="content" rows="6" required></textarea></div>
    
    <button type="submit" class="btn">Добавить автомобиль</button>
</form>

<?php require_once __DIR__ . '/../../Templates/footer.php'; ?>