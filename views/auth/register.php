<?php
$pageTitle = 'Inscription - SkillBridge';
$pageStyles = [url('assets/css/auth.css')];
include __DIR__ . '/../layouts/header.php';
?>

<section class="auth-page">
  <div class="auth-card">
    <h1 class="auth-title">Créer un compte</h1>

    <?php if (isset($error)): ?>
      <p class="auth-alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form action="<?= url('doRegister') ?>" method="post" class="auth-form">
      <div class="auth-field">
        <label for="nom">Nom</label>
        <input
          type="text"
          name="nom"
          id="nom"
          class="auth-input"
          value="<?= htmlspecialchars($_POST['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
          required
        >
      </div>

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

      <div class="auth-field">
        <label for="ville">Ville (optionnel)</label>
        <input
          type="text"
          name="ville"
          id="ville"
          class="auth-input"
          value="<?= htmlspecialchars($_POST['ville'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >
      </div>

      <button type="submit" class="auth-submit">S'inscrire</button>
    </form>

    <p class="auth-switch">
      Déjà inscrit ?
      <a href="<?= url('login') ?>">Se connecter</a>
    </p>
  </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>