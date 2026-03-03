<?php include __DIR__ . '/../layouts/header.php'; ?>

<h1>Inscription</h1>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form action="<?= url('doRegister') ?>" method="post">
    <div>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>
    </div>
    <div>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div>
        <label for="ville">Ville (optionnel) :</label>
        <input type="text" name="ville" id="ville">
    </div>
    <button type="submit">S'inscrire</button>
</form>
<p>Déjà inscrit ? <a href="<?= url('login') ?>">Se connecter</a></p>

<?php include __DIR__ . '/../layouts/footer.php'; ?>