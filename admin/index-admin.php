<?php
session_start();
$GLOBALS["page"] = "admin-marque.php";
require_once(__DIR__ . '/../includes/nav.php');
require_once(__DIR__ . '/../libs/database-functions.php');
require_once(__DIR__ . '/../libs/verifySession.php');
require_once(__DIR__ . '/../libs/functions.php');

$verifyAdmin = new VerifSession();
if (!$verifyAdmin->verifConnection() || (!checkAdmin($_SESSION["nom"], $_SESSION["prenom"], $_SESSION["email"]))) {
    header('Location: ../others/connexion.php');
    exit();
}


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
    <?php if (getProductUnavailable() != "") {
      echo "<script>alert('Des articles ne sont plus en stock : , " . getProductUnavailable() . "');</script>";
    } ?>
    <h1>Base de données</h1>
    <ul id="indexAdminTables">
      <h2>Tables</h2>
      <li><a href="admin-client.php"><img src="../img/admin-icone-client.png">client</a> (Identifiant, nom, prenom, mot de passe, adresse e-mail, isAdmin).</li>
      <li><a href="admin-comptabilite.php"><img src="../img/admin-icone-comptabilite.png">comptabilite</a> (Identifiant, ventes et leurs montant, chiffre d'affaires réalisé, achats et leurs montant, année).</li>
      <li><a href="admin-facturation.php"><img src="../img/admin-icone-facturation.png">facturation</a> (Identifiant du panier, liste des articles(Identifiant de l'article, quantité, prix), nom, prénom et email de l'acheteur, prix HT, prix TTC et TVA)</li>
      <li><a href="admin-fournisseur.php"><img src="../img/admin-icone-fournisseur.png">fournisseur</a> (Identifiant, nom de l'entreprise, adresse e-mail, mot de passe, autres informations)</li>
      <li><a href="admin-gestion_stock.php"><img src="../img/admin-icone-gestion_stock.png">gestion_stock</a> (Identifiant, référence du produit, référence du fournisseur, quantité)</li>
      <li><a href="admin-marque.php"><img src="../img/admin-icone-marque.png">marque</a> (Identifiant, nom de la marque)</li>
      <li><a href="admin-produit.php"><img src="../img/admin-icone-produit.png">produit</a> (Identifiant, nom, prix public, prix d'achat, taille, couleur, nom de l'image, nom de l'icone, titre, référence de la marque, description)</li>
    </ul>
  </main>
</body>

</html>