<?php include __DIR__ . '/layouts/header.php'; ?>

<h1>Bienvenue sur SkillBridge</h1>
<p>Échangez vos compétences avec des professionnels.</p>
<?php if (isset($_SESSION['user_id'])): ?>
    <p>Bonjour <?= htmlspecialchars($_SESSION['user_nom'], ENT_QUOTES, 'UTF-8') ?> !</p>
<?php else: ?>
    <p><a href="<?= url('login') ?>">Connectez-vous</a> ou <a href="<?= url('register') ?>">inscrivez-vous</a> pour commencer.</p>
<?php endif; ?>

<?php include __DIR__ . '/layouts/footer.php'; ?>