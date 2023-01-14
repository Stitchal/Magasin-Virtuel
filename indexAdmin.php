<?php
session_start();
$GLOBALS["page"] = "adminMarque.php";
require_once('nav.php');
require_once('database/Database.php');

?>

<!DOCTYPE html>
<html LANG="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>Accueil admin</title>
</head>
<body>
  <main>
    <h1>Accueil admin</h1>
    <ul>
        <li><a href="adminClient.php">client</a></li>
        <li><a href="adminComptabilite.php">comptabilite</a></li>
        <li><a href="adminFacturation.php">facturation</a></li>
        <li><a href="adminFournisseur.php">fournisseur</a></li>
        <li><a href="adminGestion_stock.php">gestion_stock</a></li>
        <li><a href="adminMarque.php">marque</a></li>
        <li><a href="adminArticle.php">produit</a></li>
    </ul>
  </main>
</body>
</html>