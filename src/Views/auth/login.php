<?php require_once __DIR__ . '/../../Templates/header.php'; ?>

<div class="form" style="max-width: 400px;">
    <h2>Вход</h2>
    <?php if ($error): ?><div style="color: #e74c3c; margin-bottom: 1rem;"><?= $error ?></div><?php endif; ?>
    <form method="POST">
        <div class="form-group"><label>Логин</label><input type="text" name="username" required></div>
        <div class="form-group"><label>Пароль</label><input type="password" name="password" required></div>
        <button type="submit" class="btn" style="width: 100%;">Войти</button>
    </form>
    <p style="text-align: center; margin-top: 1rem;"><a href="/register">Регистрация</a></p>
    <div style="margin-top: 1rem; padding: 1rem; background: var(--bg-input); border-radius: 4px; font-size: 0.9rem; color: var(--text-secondary);">
        <strong>Тест:</strong> admin / 12345
    </div>
</div>

<?php require_once __DIR__ . '/../../Templates/footer.php'; ?>