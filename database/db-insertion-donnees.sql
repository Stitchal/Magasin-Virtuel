

--insertion dragon ball dans la table produit

INSERT INTO marque VALUES(1, "Dragon Ball");
INSERT INTO produit VALUES(1, "Boule_de_crystal", 10, 1, 10, "orange", "bouleCrystal.png", "bouleCrystal.png", "Boule_de_crystal", 1);
INSERT INTO fournisseur (nomEntreprise, mail, mdp, infos) VALUES ('Sasuke', 'sasuke.sss@sss.com', 'sasuke', 'Sasuke est un fournisseur de qualité');
INSERT INTO gestion_stock (refProduit, refFournisseur, quantite) VALUES (1, 1, 10);
