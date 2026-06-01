<?php require_once __DIR__ . '/../../Templates/header.php'; ?>

<h1>До свидания, <?= htmlspecialchars($name) ?>!</h1>
<p style="text-align: center;">Спасибо, что воспользовались нашим сервисом.</p>
<div style="text-align: center; margin-top: 20px;">
    <a href="/" class="btn">На главную</a>
</div>

<?php require_once __DIR__ . '/../../Templates/footer.php'; ?>