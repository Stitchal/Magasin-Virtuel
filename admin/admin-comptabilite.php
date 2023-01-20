<?php
session_start();

if (isset($_POST["suppr"])) {
  $_SESSION['suppr'] = $_POST["supprimer"];
  $_SESSION['idSuppr'] = $_POST["idSuppression"];
  $_SESSION['tabSuppr'] = "comptabilite";
  header('Location: ../admin/admin-suppression.php');
  exit();
}

require_once(__DIR__ . '/../libs/functions.php');
require_once(__DIR__ . '/../libs/verifySession.php');
require_once('../libs/database-functions.php');

$verifyAdmin = new VerifSession();

if (!$verifyAdmin->verifConnection() || (!checkAdmin($_SESSION["nom"], $_SESSION["prenom"], $_SESSION["email"]))) {
  header('Location: ../others/connexion.php');
  exit();
}

$GLOBALS["page"] = "admin-comptabilite.php";
require_once(__DIR__ . '/../includes/nav.php');
require_once(__DIR__ . '/../includes/menu-admin.php');
require_once(__DIR__ . '/../libs/database.php');
?>

<!DOCTYPE html>
<html LANG="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>Table comptabilite</title>
</head>

<body>
  <main>
    <h1>Table comptabilite</h1>
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
      if (is_numeric($critere)) {
        $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM comptabilite WHERE id LIKE '%$critere%'");
      } else {
        $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM comptabilite");
      }
      unset($_SESSION["recherche"]);
    } else {
      $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM comptabilite");
    }

    echo '<table class="bdd" id="comptabiliteID"><tbody>
            <tr><td>id</td><td>ventes</td><td>montantVentes</td><td>chiffreAffaire</td><td>achats</td><td>montantAchats</td><td>annee</td>';
    foreach ($result as $compta) {
      $idCompta = $compta["id"];
      $ventesCompta = $compta["ventes"];
      $montantVentesCompta = $compta["montantVentes"];
      $chiffreAffaireCompta = $compta["chiffreAffaire"];
      $achatsCompta = $compta["achats"];
      $montantAchatsCompta = $compta["montantAchats"];
      $anneeCompta = $compta["annee"];

      echo "<tr>  <td>" . $idCompta . "</td>
                  <td>" . $ventesCompta . "</td>
                  <td>" . $montantVentesCompta . "</td>
                  <td>" . $chiffreAffaireCompta . "</td>
                  <td>" . $achatsCompta . "</td>
                  <td>" . $montantAchatsCompta . "</td>
                  <td>" . $anneeCompta . "</td><td>";
      echo '<form method = "post" class="formBDD">';
      echo '<fieldset>';
      echo "<input type='hidden' name='supprimer' value=$anneeCompta>";
      echo "<input type='hidden' name='idSuppression' value=$idCompta>";
      echo "<input name='suppr' class='supprimerProduit' type='submit' value = 'Supprimer' >";
      echo '<fieldset>';
      echo '</form>';
      echo '</td>';
      echo "</tr>";
    }
    echo '</tbody></table>';
    ?>
  </main>
</body>

</html>