<?php include __DIR__ . '/../layouts/header.php'; ?>

<h1>Connexion</h1>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form action="<?= url('doLogin') ?>" method="post">
    <div>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit">Se connecter</button>
</form>
<p>Pas encore inscrit ? <a href="<?= url('register') ?>">Créer un compte</a></p>

<?php include __DIR__ . '/../layouts/footer.php'; ?>