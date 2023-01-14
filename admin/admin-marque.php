<?php
session_start();
$GLOBALS["page"] = "admin-marque.php";
require_once(__DIR__ . '/../includes/nav.php');
require_once(__DIR__ . '/../includes/menu-admin.php');
require_once(__DIR__ . '/../libs/database.php');

if (isset($_POST["suppr"])) {
  $_SESSION['suppr'] = $_POST["supprimer"];
  $_SESSION['idSuppr'] = $_POST["idSuppression"];
  $_SESSION['tabSuppr'] = "marque";
  header('Location: admin-suppression.php');
  exit();
}

if (isset($_POST['boutonRechercher'])) {
  $_SESSION['recherche'] = $_POST['inputRechercher'];
  header('Location: admin-marque.php');
  exit();
}

?>

<!DOCTYPE html>
<html LANG="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>Table marque</title>
</head>

<body>
  <main>
    <h1>Table marque</h1>
    <form id="formRecherche" method="post">
      <input type="search" id="inputRechercher" name="inputRechercher" placeholder="Rechercher...">
      <button id="boutonRechercher" name="boutonRechercher" type="submit"><img src="../img/rechercher.png" alt="image ajouter article"></button>
    </form>
    <div class="marque">
      <script>
        let valeur = 0;
      </script>

      <table>
        <tbody>

          <?php
          ConnexionDB::getInstance();
          $i = 1;
          $critere = "";
          if (isset($_SESSION['recherche'])) {
            $critere = $_SESSION['recherche'];
            if (is_numeric($critere)) {
              $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM marque WHERE id LIKE '%$critere%'");
            } else {
              $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM marque WHERE nom LIKE '%$critere%'");
            }
          } else {
            $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM marque");
          }

          echo '<table class="bdd"><tbody>
            <tr><td>id</td><td> nom </td><td></td>';
          foreach ($result as $marque) {
            $idMarque = $marque["id"];
            $nomMarque = $marque["nom"];
            echo "<tr><td>" . $idMarque . "</td><td>" . $nomMarque . "</td><td>";
            echo '<form method = "post">';
            echo '<fieldset>';
            echo "<input type='hidden' name='supprimer' value=$nomMarque>";
            echo "<input type='hidden' name='idSuppression' value=$idMarque>";
            echo "<input name='suppr' class='supprimerProduit' type='submit' value = 'Supprimer' >";
            echo '<fieldset>';
            echo '</form>';
            echo '</td>';
            echo "</tr>";
          }
          echo '</tbody></table>';
          ?>
          <a href="admin-marque-ajout.php" title="Cliquez ici pour ajouter une marque à la base de donnée">
            <div id="ajouter"><img src="../img/icone-ajout.png" alt="image ajouter article">
            </div>
          </a>
  </main>
</body>

</html>