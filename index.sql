-- Table utilisateur
CREATE TABLE utilisateur (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    bio TEXT,
    avatar_url VARCHAR(255),
    ville VARCHAR(100),
    site_web VARCHAR(255),
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role VARCHAR(20) DEFAULT 'user'
);

-- Table catégorie
CREATE TABLE categorie (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    icone VARCHAR(50)
);

-- Table competence
CREATE TABLE competence (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    id_categorie INTEGER REFERENCES categorie(id) ON DELETE SET NULL
);

-- Table utilisateur_competence (liaison)
CREATE TABLE utilisateur_competence (
    id_utilisateur INTEGER REFERENCES utilisateur(id) ON DELETE CASCADE,
    id_competence INTEGER REFERENCES competence(id) ON DELETE CASCADE,
    niveau VARCHAR(50),
    PRIMARY KEY (id_utilisateur, id_competence)
);

-- Table annonce
CREATE TABLE annonce (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    prix_min DECIMAL(10,2),
    prix_max DECIMAL(10,2),
    type_prix VARCHAR(20),
    duree_livraison INTEGER,
    id_utilisateur INTEGER REFERENCES utilisateur(id) ON DELETE CASCADE,
    id_categorie INTEGER REFERENCES categorie(id) ON DELETE SET NULL,
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statut VARCHAR(20) DEFAULT 'active'
);

-- Table message
CREATE TABLE message (
    id SERIAL PRIMARY KEY,
    contenu TEXT NOT NULL,
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    lu BOOLEAN DEFAULT FALSE,
    id_expediteur INTEGER REFERENCES utilisateur(id) ON DELETE CASCADE,
    id_destinataire INTEGER REFERENCES utilisateur(id) ON DELETE CASCADE
);

-- Table avis
CREATE TABLE avis (
    id SERIAL PRIMARY KEY,
    note INTEGER CHECK (note >= 1 AND note <= 5),
    commentaire TEXT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_auteur INTEGER REFERENCES utilisateur(id) ON DELETE CASCADE,
    id_destinataire INTEGER REFERENCES utilisateur(id) ON DELETE CASCADE,
    id_annonce INTEGER REFERENCES annonce(id) ON DELETE SET NULL
);

-- Table projet (portfolio)
CREATE TABLE projet (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    lien VARCHAR(255),
    date_creation DATE,
    id_utilisateur INTEGER REFERENCES utilisateur(id) ON DELETE CASCADE
);

SELECT * FROM utilisateur