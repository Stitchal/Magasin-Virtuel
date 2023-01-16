--TODO -> faire un script sql propre et qui fonctionne

--Ordre de suppression des tables
DROP TABLE gestion_stock;
DROP TABLE produit;
DROP TABLE marque;
DROP TABLE fournisseur;
DROP TABLE client;
DROP TABLE comptabilite;
DROP TABLE facturation;

--crée la table client
CREATE TABLE client (
    id INT NOT NULL AUTO_INCREMENT,
    isAdmin BOOLEAN NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    mail VARCHAR(50) NOT NULL,
    mdp VARCHAR(50) NOT NULL,

    PRIMARY KEY (id)
);

--crée la table fournisseur
CREATE TABLE fournisseur (
    id INT NOT NULL AUTO_INCREMENT,
    nomEntreprise VARCHAR(50) NOT NULL,
    mail VARCHAR(50) NOT NULL,
    mdp VARCHAR(50) NOT NULL,
    infos VARCHAR(100),

    PRIMARY KEY (id)
);


--crée la table marque
CREATE TABLE marque (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,

    PRIMARY KEY (id)
);

--crée la table produit
CREATE TABLE produit (
   id INT NOT NULL AUTO_INCREMENT,
   nom VARCHAR(50) NOT NULL,
   prixPublic DECIMAL(10,2) NOT NULL,
   prixAchat DECIMAL(10,2) NOT NULL,
   taille DECIMAL(10,2) NOT NULL,
   couleur VARCHAR(50) NOT NULL,
   image VARCHAR(50),
   icone VARCHAR(50),
   titre VARCHAR(50) NOT NULL,
   refMarque INT NOT NULL,

   PRIMARY KEY (id),
   FOREIGN KEY (refMarque) REFERENCES marque(id)
);

--crée la table facturation
CREATE TABLE facturation(
    id INT NOT NULL AUTO_INCREMENT,
    articles VARCHAR(100) NOT NULL,
    dateFact DATETIME NOT NULL,
    nomAcheteur VARCHAR(50) NOT NULL,
    prenomAcheteur VARCHAR(50) ,
    emailAcheteur VARCHAR(50),
    prixHT DECIMAL(10,2) NOT NULL,
    prixTTC DECIMAL(10,2) NOT NULL,
    TVA INT(2) NOT NULL,

    PRIMARY KEY (id)
);


--crée la table gestion_stock
CREATE TABLE gestion_stock (
    id INT NOT NULL AUTO_INCREMENT,
    refProduit INT NOT NULL,
    refFournisseur INT NOT NULL,
    quantite INT NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (refProduit) REFERENCES produit(id),
    FOREIGN KEY (refFournisseur) REFERENCES fournisseur(id)
);

--crée la table comptabilite
CREATE TABLE comptabilite (
    id INT NOT NULL AUTO_INCREMENT,
    ventes VARCHAR(1000),
    montantVentes DECIMAL(50,5),
    chiffreAffaire DECIMAL(50,5) NOT NULL,
    achats VARCHAR(1000),
    montantAchats DECIMAL(50,5),
    annee INT (4) NOT NULL,

    PRIMARY KEY (id)
);