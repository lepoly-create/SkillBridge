<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillBridge</title>
    <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
</head>
<body>
    <header>
        <nav>
            <a href="<?= url() ?>">SkillBridge</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?= url('profil') ?>">Mon profil</a>
                <a href="<?= url('annonces') ?>">Annonces</a>
                <a href="<?= url('messages') ?>">Messages</a>
                <a href="<?= url('logout') ?>">Déconnexion</a>
            <?php else: ?>
                <a href="<?= url('login') ?>">Connexion</a>
                <a href="<?= url('register') ?>">Inscription</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>