<?php
session_start();
$GLOBALS["page"] = "admin-gestion_stock.php";
require_once(__DIR__ . '/../libs/database.php');
require_once(__DIR__ . '/../libs/verifySession.php');
require_once(__DIR__ . '/../libs/functions.php');
require_once('../libs/database-functions.php');

$verifyAdmin = new VerifSession();
if (!$verifyAdmin->verifConnection() || (!checkAdmin($_SESSION["nom"], $_SESSION["prenom"], $_SESSION["email"]))) {
  header('Location: ../others/connexion.php');
  exit();
}


if (isset($_POST["suppr"])) {
  $_SESSION['suppr'] = $_POST["supprimer"];
  $_SESSION['idSuppr'] = $_POST["idSuppression"];
  $_SESSION['tabSuppr'] = "gestion_stock";
  header('Location: ../admin/admin-suppression.php');
  exit();
}

if (isset($_POST["reappro"])) {
  $_SESSION['idReappro'] = $_POST["idSuppression"];
  $_SESSION['idProdReappro'] = $_POST["supprimer"];
  header('Location: ../admin/admin-reapprovisionnement.php');
  exit();
}

if (isset($_POST['boutonRechercher'])) {
  $_SESSION['recherche'] = $_POST['inputRechercher'];
  header('Location: ../admin/admin-gestion_stock.php');
  exit();
}

require_once(__DIR__ . '/../includes/nav.php');
require_once(__DIR__ . '/../includes/menu-admin.php');

?>

<!DOCTYPE html>
<html LANG="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>Table gestion_stock</title>
</head>

<body>
  <main>
    <h1>Table gestion_stock</h1>
    <form id="formRecherche" method="post">
      <input type="search" id="inputRechercher" name="inputRechercher" placeholder="Rechercher...">
      <button id="boutonRechercher" name="boutonRechercher" type="submit"><img src="../img/rechercher.png" alt="image ajouter article"></button>
    </form>
    <?php
    ConnexionDB::getInstance();
    $i = 1;
    $critere = "";
    if (isset($_SESSION['recherche'])) {
      $critere = $_SESSION['recherche'];
      $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM gestion_stock WHERE id LIKE '%$critere%'");
    } else {
      $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM gestion_stock");
    }

    if (isset($_SESSION["recherche"])) {
      unset($_SESSION["recherche"]);
    }
    echo '<table class="bdd"><tbody>
            <tr><td>id</td><td>refProduit</td><td>refFournisseur</td><td>quantite</td><td></td>';
    foreach ($result as $gestion_stock) {
      $idGestionStock = $gestion_stock["id"];
      $refProduit = $gestion_stock["refProduit"];
      $refFournisseur = $gestion_stock["refFournisseur"];
      $quantite = $gestion_stock["quantite"];
      if ($quantite  == 0) {
        echo "<tr><td>" . $idGestionStock . "</td><td>" . $refProduit . "</td><td>" . $refFournisseur . "</td><td id='urgenceReappro'>" . $quantite . "</td><td>";
      } else {
        echo "<tr><td>" . $idGestionStock . "</td><td>" . $refProduit . "</td><td>" . $refFournisseur . "</td><td>" . $quantite . "</td><td>";
      }
      echo '<form method = "post" class="formBDD">';
      echo '<fieldset>';
      echo "<input type='hidden' name='supprimer' value=$refProduit>";
      echo "<input type='hidden' name='idSuppression' value=$idGestionStock>";
      echo "<input name='suppr' class='supprimerProduit' type='submit' value = 'Supprimer' >";
      echo "<input name='reappro' class='reapprovisionnerProduit' type='submit' value = 'Reappro' >";
      echo '<fieldset>';
      echo '</form>';
      echo '</td>';
      echo "</td></tr>";
    }
    echo '</tbody></table>';
    ?>
    <a href="admin-gestion_stock-ajout.php" title="Cliquez ici pour ajouter un gestionnaire de stock à la base de donnée">
      <div id="ajouter"><img src="../img/icone-ajout.png" alt="image ajouter article">
      </div>
    </a>
  </main>
</body>

</html>