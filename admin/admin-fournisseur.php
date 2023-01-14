<?php
session_start();
$GLOBALS["page"] = "admin-fournisseur.php";
require_once(__DIR__.'/../includes/nav.php');
require_once(__DIR__ . '/../includes/menu-admin.php');
require_once(__DIR__ . '/../libs/database.php');

if (isset($_POST["suppr"])) {
    $_SESSION['suppr'] = $_POST["supprimer"];
    $_SESSION['idSuppr'] = $_POST["idSuppression"];
    $_SESSION['tabSuppr'] = "fournisseur";
    header('Location: admin-suppression.php');
    exit();
  }
  
  if (isset($_POST['boutonRechercher'])) {
    $_SESSION['recherche'] = $_POST['inputRechercher'];
    header('Location: admin-fournisseur.php');
    exit();
  }
?>

<!DOCTYPE html>
<html LANG="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>Table fournisseur</title>
</head>
<body>
  <main>
    <h1>Table fournisseur</h1>
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
          $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM fournisseur WHERE id LIKE '%$critere%'");
        } else {
          $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM fournisseur WHERE nomEntreprise LIKE '%$critere%'");
        }
      } else {
        $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM fournisseur");
      }

      echo '<table class="bdd"><tbody>
            <tr><td>id</td><td>nomEntreprise</td><td>mail</td><td>mdp</td><td>infos</td><td></td>';
      foreach ($result as $fournisseur) {
        $idFournisseur = $fournisseur["id"];
        $nomFournisseur = $fournisseur["nomEntreprise"];
        $mailFournisseur = $fournisseur["mail"];
        $mdpFournisseur = $fournisseur["mdp"];
        $infosFournisseur = $fournisseur["infos"];
        echo "<tr><td>".$idFournisseur."</td><td>" . $nomFournisseur . "</td><td>" . $mailFournisseur . "</td><td>" . $mdpFournisseur . "</td><td>" . $infosFournisseur . "</td><td>";
        echo '<form method = "post">';
        echo '<fieldset>';
        echo "<input type='hidden' name='supprimer' value=$nomFournisseur>";
        echo "<input type='hidden' name='idSuppression' value=$idFournisseur>";
        echo"<input name='suppr' class='supprimerProduit' type='submit' value = 'Supprimer' >";
        echo '<fieldset>';
        echo '</form>';
        echo '</td>';
        echo "</td></tr>";
      }
      echo '</tbody></table>';
      ?>
    <a href="admin-fournisseur-ajout.php" title="Cliquez ici pour ajouter un fournisseur à la base de donnée">
      <div id="ajouter"><img src="../img/icone-ajout.png" alt="image ajouter article">
    </div>
    </a>
  </main>
</body>
</html>