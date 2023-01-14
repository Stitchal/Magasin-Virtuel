--TODO -> faire un script sql propre et qui fonctionne

--on recrée la base de données

DROP TABLE IF EXISTS produit CASCADE;
DROP TABLE IF EXISTS marque CASCADE;
DROP TABLE IF EXISTS fournisseur CASCADE;
DROP TABLE IF EXISTS client CASCADE;
DROP TABLE IF EXISTS personne CASCADE;



--créer une table utilisateur qui hérite de la table personne
CREATE TABLE client (
    id INT NOT NULL AUTO_INCREMENT,
    isAdmin BOOLEAN NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    mail VARCHAR(50) NOT NULL,
    mdp VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);

--créer une table administrateur qui hérite de la table personne
CREATE TABLE fournisseur (
    id INT NOT NULL AUTO_INCREMENT,
    nomEntreprise VARCHAR(50) NOT NULL,
    mail VARCHAR(50) NOT NULL,
    mdp VARCHAR(50) NOT NULL,
    infos VARCHAR(100),
    PRIMARY KEY (id)
);


--créer une table marque
CREATE TABLE marque (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);

--créer une table produit
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

--insérer des données dans la table produit
INSERT INTO marque VALUES(1, "Dragon Ball");
INSERT INTO produit VALUES(1, "Boule_de_crystal", 10, 1, 10, "orange", "bouleCrystal.png", "bouleCrystal.png", "Boule_de_crystal", 1);

CREATE TABLE Facturation(
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


--créer une table gestion_stock
CREATE TABLE gestion_stock (
    id INT NOT NULL AUTO_INCREMENT,
    refProduit INT NOT NULL,
    refFournisseur INT NOT NULL,
    quantite INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (refProduit) REFERENCES produit(id),
    FOREIGN KEY (refFournisseur) REFERENCES fournisseur(id)
);

--créer une table comptabilite
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