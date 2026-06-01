<?php require_once __DIR__ . '/../../Templates/header.php'; ?>

<div class="form" style="max-width: 400px;">
    <h2>Регистрация</h2>
    <?php if ($error): ?><div style="color: #e74c3c; margin-bottom: 1rem;"><?= $error ?></div><?php endif; ?>
    <form method="POST">
        <div class="form-group"><label>Логин</label><input type="text" name="username" required></div>
        <div class="form-group"><label>Имя</label><input type="text" name="nickname" required></div>
        <div class="form-group"><label>Пароль</label><input type="password" name="password" required minlength="4"></div>
        <button type="submit" class="btn" style="width: 100%;">Зарегистрироваться</button>
    </form>
    <p style="text-align: center; margin-top: 1rem;"><a href="/login">Войти</a></p>
</div>

<?php require_once __DIR__ . '/../../Templates/footer.php'; ?>