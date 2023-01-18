<?php
session_start();
$GLOBALS["page"] = "admin-marque.php";
require_once(__DIR__.'/../includes/nav.php');
require_once(__DIR__ . '/../libs/database-functions.php');

?>

<!DOCTYPE html>
<html LANG="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>Base de données</title>
</head>
<body>
  <main>
    <?php if(getProductUnavailable() != ""){
      echo "<script>alert('Des articles ne sont plus en stock : , ".getProductUnavailable()."');</script>";
    } ?>
    <h1>Base de données</h1>
    <ul id="indexAdminTables">Tables
        <li><a href="admin-client.php"><img src="../img/admin-icone-client.png">client</a> - données des clients (Identifiant, nom, prenom, mdp, mail, isAdmin).</li>
        <li><a href="admin-comptabilite.php"><img src="../img/admin-icone-comptabilite.png">comptabilite</a> - (Ventes, chiffre d'affaires réalisé, achats et leurs montant, bénéfice et déficit).</li>
        <li><a href="admin-facturation.php">facturation</a> (Identifiant du panier, date de création, nom, prénom, email de l'acheteur, liste des produits, prix HT et TTC, TVA)
=> prixTotal, prixHT, prixTTC, TVA
)</li>
        <li><a href="admin-fournisseur.php">fournisseur</a></li>
        <li><a href="admin-gestion_stock.php">gestion_stock</a></li>
        <li><a href="admin-marque.php">marque</a></li>
        <li><a href="admin-produit.php">produit</a></li>
    </ul>
  </main>
</body>
</html>