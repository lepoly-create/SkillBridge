<?php
$pageTitle = $pageTitle ?? 'SkillBridge';
$pageStyles = $pageStyles ?? [];

if (!is_array($pageStyles)) {
    $pageStyles = [$pageStyles];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
    <?php foreach ($pageStyles as $stylePath): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($stylePath, ENT_QUOTES, 'UTF-8') ?>">
    <?php endforeach; ?>
</head>
<body>
    <header class="site-header">
        <nav class="site-nav">
            <a class="brand" href="<?= url() ?>">SkillBridge</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="nav-link" href="<?= url('profil') ?>">Mon profil</a>
                <a class="nav-link" href="<?= url('annonces') ?>">Annonces</a>
                <a class="nav-link" href="<?= url('messages') ?>">Messages</a>
                <a class="nav-link" href="<?= url('logout') ?>">Déconnexion</a>
            <?php else: ?>
                <a class="nav-link" href="<?= url('login') ?>">Connexion</a>
                <a class="nav-link" href="<?= url('register') ?>">Inscription</a>
            <?php endif; ?>
        </nav>
        
    </header>
    <main class="page-content">