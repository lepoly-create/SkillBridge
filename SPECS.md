# SkillBridge - Cahier des charges

## 1. Objectif du projet
Plateforme locale d'échange de compétences entre particuliers.

## 2. Public cible
Habitants d'une même ville souhaitant apprendre ou partager des compétences gratuitement.

## 3. Fonctionnalités principales
- Inscription / Connexion
- Gestion de profil (infos personnelles, compétences offertes/recherchées)
- Publication d'annonces (titre, description, compétence associée)
- Recherche d'annonces par mots-clés / catégories / ville
- Consultation des profils
- Messagerie interne entre utilisateurs

## 4. Contraintes techniques
- HTML, CSS, JavaScript, PHP, PostgreSQL
- Architecture MVC
- Code hébergé sur GitHub
- Déploiement sur un serveur public

## 5. User Stories (priorisées)

### Utilisateur non connecté
- [ ] En tant que visiteur, je peux voir les annonces récentes sur la page d'accueil.
- [ ] En tant que visiteur, je peux rechercher des annonces par mot-clé.
- [ ] En tant que visiteur, je peux m'inscrire avec mon email et un mot de passe.
- [ ] En tant que visiteur, je peux me connecter à mon compte.

### Utilisateur connecté
- [ ] En tant qu'utilisateur connecté, je peux modifier mon profil (nom, ville, bio, photo).
- [ ] En tant qu'utilisateur connecté, je peux ajouter/supprimer des compétences que j'offre ou que je recherche.
- [ ] En tant qu'utilisateur connecté, je peux créer une annonce (titre, description, compétence).
- [ ] En tant qu'utilisateur connecté, je peux modifier/supprimer mes propres annonces.
- [ ] En tant qu'utilisateur connecté, je peux voir le profil public d'un autre membre.
- [ ] En tant qu'utilisateur connecté, je peux envoyer un message à un autre membre depuis son profil.
- [ ] En tant qu'utilisateur connecté, je peux consulter ma boîte de réception et lire les messages reçus.
- [ ] En tant qu'utilisateur connecté, je peux répondre à un message.

### Administrateur (si tu veux aller plus loin)
- [ ] En tant qu'admin, je peux supprimer des annonces inappropriées.
- [ ] En tant qu'admin, je peux bannir un utilisateur.

## 6. Pages à maquetter
- Accueil (avec recherche et annonces)
- Inscription / Connexion
- Profil (public et édition)
- Formulaire d'annonce (création/édition)
- Liste des annonces (avec filtres)
- Détail d'une annonce
- Messagerie (boîte de réception, conversation)

## 7. Dictionnaire des données
- Utilisateur : id, nom, email, mot_de_passe, ville, bio, photo, date_inscription
- Compétence : id, nom, catégorie
- Posséder : id_utilisateur, id_competence, type (offre/demande)
- Annonce : id, titre, description, id_utilisateur, id_competence, date_publication, statut (active/fermée)
- Message : id, contenu, date_envoi, id_expediteur, id_destinataire, lu