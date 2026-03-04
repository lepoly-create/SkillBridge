<?php
$pageTitle = 'Connexion - SkillBridge';
$pageStyles = [url('assets/css/auth.css')];
include __DIR__ . '/../layouts/header.php';
?>

<section class="auth-page">
    <div class="auth-card">
        <h1 class="auth-title">Connexion</h1>

        <?php if (isset($error)): ?>
            <p class="auth-alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <form action="<?= url('doLogin') ?>" method="post" class="auth-form">
            <div class="auth-field">
                <label for="email">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="auth-input"
                    value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    required
                >
            </div>

            <div class="auth-field">
                <label for="password">Mot de passe</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="auth-input"
                    required
                >
            </div>

            <button type="submit" class="auth-submit">Se connecter</button>
        </form>

        <p class="auth-switch">
            Pas encore inscrit ?
            <a href="<?= url('register') ?>">Créer un compte</a>
        </p>
    </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>