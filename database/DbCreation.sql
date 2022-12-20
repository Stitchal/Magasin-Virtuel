--TODO -> faire un script sql propre et qui fonctionne

--on recrée la base de données

DROP TABLE IF EXISTS produit CASCADE;
DROP TABLE IF EXISTS marque CASCADE;
DROP TABLE IF EXISTS fournisseur CASCADE;
DROP TABLE IF EXISTS client CASCADE;
DROP TABLE IF EXISTS personne CASCADE;

DROP TYPE IF EXISTS tabProd CASCADE;


--créer une table personne 
CREATE TABLE personne (
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    mail VARCHAR(50) NOT NULL,
    mdp VARCHAR(50) NOT NULL
);

--créer une table utilisateur qui hérite de la table personne
CREATE TABLE client (
    id INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id)
) INHERITS (personne);

--créer une table administrateur qui hérite de la table personne
CREATE TABLE fournisseur (
    id INT NOT NULL AUTO_INCREMENT,
    infos VARCHAR(100),
    PRIMARY KEY (id)
) INHERITS (personne);

--créer une table marque
CREATE TABLE marque (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);


CREATE OR REPLACE TYPE produit_t AS OBJECT (
    id INT,
    nom VARCHAR(50),
    prixPublic DECIMAL(10,2),
    prixAchat DECIMAL(10,2),
    taille VARCHAR(50),
    couleur VARCHAR(50),
    image VARCHAR(50),
    icone VARCHAR(50),
    titre VARCHAR(50),
    refMarque INT
)

CREATE TABLE produit OF produit_t;

CREATE TYPE produit_varray AS varray(30) OF produit_t;

CREATE TABLE Facturation(
    id integer,
    produit produit_varray,
    dateFact date,
    nomAcheteur varchar(50),
    prenomAcheteur varchar(50),
    emailAcheteur varchar(50),
    prixTotal decimal(10,2)
);


--créer une table produit
--CREATE TABLE produit (
--    id INT NOT NULL AUTO_INCREMENT,
--    nom VARCHAR(50) NOT NULL,
--    prixPublic DECIMAL(10,2) NOT NULL,
--    prixAchat DECIMAL(10,2) NOT NULL,
--    taille VARCHAR(50),
--    couleur VARCHAR(50) NOT NULL,
--    image VARCHAR(50),
--    icone VARCHAR(50),
--    titre VARCHAR(50) NOT NULL,
--    refMarque INT NOT NULL,
--    PRIMARY KEY (id),
--    FOREIGN KEY (refMarque) REFERENCES marque(id)
--);

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

--créer une table vente
CREATE TABLE vente (
    id INT NOT NULL AUTO_INCREMENT,
    chiffreAffaire INT NOT NULL,
    PRIMARY KEY (id),
);

--créer une table Achat
CREATE TABLE achat (
    id INT NOT NULL AUTO_INCREMENT,
    montantAchat INT NOT NULL,
    PRIMARY KEY (id),
);





