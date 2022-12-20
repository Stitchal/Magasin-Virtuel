--TODO -> faire un script sql propre et qui fonctionne

--on recrée la base de données

DROP TABLE IF EXISTS produit CASCADE;
DROP TABLE IF EXISTS marque CASCADE;
DROP TABLE IF EXISTS fournisseur CASCADE;
DROP TABLE IF EXISTS client CASCADE;
DROP TABLE IF EXISTS personne CASCADE;

--creer un type personne
CREATE OR REPLACE TYPE personne_type AS OBJECT (
    nom VARCHAR(50),
    prenom VARCHAR(50),
    mail VARCHAR(50) ,
    mdp VARCHAR(50) 
);

--créer un type client qui hérite de la table personne
CREATE TABLE PERSONNE OF personne_type;




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
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    mail VARCHAR(50) NOT NULL,
    mdp VARCHAR(50) NOT NULL,
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

CREATE TYPE produit_varray AS varray(30) OF produit_t;

CREATE TABLE FACTURATION(
    id integer,
    produit produit_varray
);


--créer une table produit
CREATE TABLE produit (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prixPublic DECIMAL(10,2) NOT NULL,
    prixAchat DECIMAL(10,2) NOT NULL,
    taille VARCHAR(50),
    couleur VARCHAR(50) NOT NULL,
    image VARCHAR(50),
    icone VARCHAR(50),
    titre VARCHAR(50) NOT NULL,
    refMarque INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (refMarque) REFERENCES marque(id)
);



--créer un tableau de type produit
CREATE OR REPLACE TYPE tabProd IS VARRAY(50) of produit_type;





