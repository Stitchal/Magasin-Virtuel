
INSERT INTO client VALUES(1, 1, "admin", "admin", "admin@gmail.com", "admin");
INSERT INTO client VALUES(2, 0, "client", "client", "client@gmail.com", "client");

INSERT INTO fournisseur (nomEntreprise, mail, mdp, infos) VALUES ('Sasuke', 'sasuke.sss@sss.com', 'sasuke', 'Sasuke est un fournisseur de qualité');

INSERT INTO marque VALUES(1, "Dragon Ball");

INSERT INTO produit VALUES(1, "Boule_de_cristal1", 9.99, 1, 10, "orange", "produit-boule-de-cristal.png", "produit-boule-de-cristal.png", "Boule_de_crystal", 1, "1ere Boule de cristal ");
INSERT INTO produit VALUES(2, "Boule_de_cristal2", 5, 1, 10, "orange", "produit-boule-de-cristal.png", "produit-boule-de-cristal.png", "Boule_de_crystal", 1, "2eme Boule de cristal ");
INSERT INTO produit VALUES(3, "Boule_de_cristal3", 7.99, 1, 10, "orange", "produit-boule-de-cristal.png", "produit-boule-de-cristal.png", "Boule_de_crystal", 1, "3eme Boule de cristal ");
INSERT INTO produit VALUES(4, "Boule_de_cristal4", 15, 1, 10, "orange", "produit-boule-de-cristal.png", "produit-boule-de-cristal.png", "Boule_de_crystal", 1, "4eme Boule de cristal ");
INSERT INTO produit VALUES(5, "Boule_de_cristal5", 40, 1, 10, "orange", "produit-boule-de-cristal.png", "produit-boule-de-cristal.png", "Boule_de_crystal", 1, "5eme Boule de cristal ");
INSERT INTO produit VALUES(6, "Boule_de_cristal6", 2.99, 1, 10, "orange", "produit-boule-de-cristal.png", "produit-boule-de-cristal.png", "Boule_de_crystal", 1, "6eme Boule de cristal ");
INSERT INTO produit VALUES(7, "Boule_de_cristal7", 5, 1, 10, "orange", "produit-boule-de-cristal.png", "produit-boule-de-cristal.png", "Boule_de_crystal", 1, "7eme Boule de cristal ");
INSERT INTO produit VALUES(8, "Boule_de_cristal8", 32.5, 1, 10, "orange", "produit-boule-de-cristal.png", "produit-boule-de-cristal.png", "Boule_de_crystal", 1, "8eme Boule de cristal ");
INSERT INTO produit VALUES(9, "Boule_de_cristal9", 10, 1, 10, "orange", "produit-boule-de-cristal.png", "produit-boule-de-cristal.png", "Boule_de_crystal", 1, "9eme Boule de cristal ");

INSERT INTO gestion_stock (refProduit, refFournisseur, quantite) VALUES (1, 1, 10);
INSERT INTO gestion_stock (refProduit, refFournisseur, quantite) VALUES (2, 1, 10);
INSERT INTO gestion_stock (refProduit, refFournisseur, quantite) VALUES (3, 1, 10);
INSERT INTO gestion_stock (refProduit, refFournisseur, quantite) VALUES (4, 1, 10);
INSERT INTO gestion_stock (refProduit, refFournisseur, quantite) VALUES (5, 1, 10);
INSERT INTO gestion_stock (refProduit, refFournisseur, quantite) VALUES (6, 1, 10);
INSERT INTO gestion_stock (refProduit, refFournisseur, quantite) VALUES (7, 1, 10);
INSERT INTO gestion_stock (refProduit, refFournisseur, quantite) VALUES (8, 1, 10);
INSERT INTO gestion_stock (refProduit, refFournisseur, quantite) VALUES (9, 1, 10);