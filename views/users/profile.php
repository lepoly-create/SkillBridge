<?php include __DIR__ . '/../layouts/header.php'; ?>

<h1>Mon profil</h1>
<?php if (isset($_SESSION['user_id'])): ?>
    <p>Utilisateur connecté : <?= htmlspecialchars($_SESSION['user_nom']) ?></p>
<?php else: ?>
    <p>Vous n'êtes pas connecté.</p>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>