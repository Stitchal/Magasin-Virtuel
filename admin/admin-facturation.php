<?php
session_start();
$GLOBALS["page"] = "admin-facturation.php";

require_once(__DIR__ . '/../libs/database.php');

if (isset($_POST["suppr"])) {
  $_SESSION['suppr'] = $_POST["idSuppression"];
  $_SESSION['idSuppr'] = $_POST["idSuppression"];
  $_SESSION['tabSuppr'] = "facturation";
  header('Location: ../admin/admin-suppression.php');
  exit();
}

if (isset($_POST['boutonRechercher'])) {
  $_SESSION['recherche'] = $_POST['inputRechercher'];
  header('Location: ../admin/admin-facturation.php');
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
  <title>Table facturation</title>
</head>

<body>
  <main>
    <h1>Table facturation</h1>
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
      $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM facturation WHERE id LIKE '%$critere%'");
    } else {
      $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM facturation");
    }
    if (isset($_SESSION["recherche"])) {
      unset($_SESSION["recherche"]);
    }

    echo '<table class="bdd" id="facturationTD"><tbody>
            <tr><td>idFacturation</td><td>articles</td><td>date</td><td>nom </td><td> prenom</td><td> email </td> <td> prixHT </td> <td> TVA </td> <td> prixTTC </td> <td> </td>';
    foreach ($result as $facturation) {
      $idFacturation = $facturation["id"];
      $articlesFacturation = $facturation["articles"];
      $dateFacturation = $facturation["dateFact"];
      $nomAcheteur = $facturation["nomAcheteur"];
      $prenomAcheteur = $facturation["prenomAcheteur"];
      $emailAcheteur = $facturation["emailAcheteur"];
      $prixHT = $facturation["prixHT"];
      $prixTTC = $facturation["prixTTC"];
      $TVA = $facturation["TVA"];

      echo "<tr><td>" . $idFacturation . "</td><td>" . $articlesFacturation . "</td><td>" . $dateFacturation . "</td><td>" . $nomAcheteur . "</td><td> " . $prenomAcheteur . "</td><td>" . $emailAcheteur . "</td><td>" . $prixHT . "</td><td>" . $TVA . "</td><td>" . $prixTTC . "</td><td>";
      echo '<form method = "post" class="formBDD">';
      echo '<fieldset>';
      echo "<input type='hidden' name='idSuppression' value=$idFacturation>";
      echo "<input name='suppr' class='supprimerProduit' type='submit' value = 'Supprimer' >";
      echo '<fieldset>';
      echo '</form>';
      echo '</td>';
      echo "</td></tr>";
    }
    echo '</tbody></table>';
    ?>
    <a href="admin-facturation-ajout.php" title="Cliquez ici pour ajouter un facturation à la base de donnée">
      <div id="ajouter"><img src="../img/icone-ajout.png" alt="image ajouter article">
      </div>
    </a>
  </main>
</body>

</html>