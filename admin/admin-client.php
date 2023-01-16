<?php
session_start();
$GLOBALS["page"] = "admin-client.php";
$GLOBALS["pageSuppression"] = "admin-client.php";

if (isset($_POST["suppr"])) {
  $_SESSION['suppr'] = $_POST["supprimer"];
  $_SESSION['idSuppr'] = $_POST["idSuppression"];
  $_SESSION['tabSuppr'] = "client";
  header('Location: ../admin/admin-suppression.php');
  exit();
}

if (isset($_POST['boutonRechercher'])) {
  $_SESSION['recherche'] = $_POST['inputRechercher'];
  header('Location: ../admin/admin-client.php');
  exit();
}

require_once(__DIR__ . '/../includes/nav.php');
require_once(__DIR__ . '/../includes/menu-admin.php');
require_once(__DIR__ . '/../libs/database.php');



?>

<!DOCTYPE html>
<html LANG="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/responsive.css">
  <title>Table client</title>
</head>

<body>
  <main>
    <h1>Table client</h1>
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
          $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM client WHERE id LIKE '%$critere%'");
        } else {
          $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM client WHERE nom LIKE '%$critere%'");
        }
      } else {
        $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM client");
      }

      echo '<table class="bdd" id="clientTD"><tbody><tr><td>id</td><td>nom</td><td>prenom</td><td>mdp</td><td>mail</td><td>isAdmin</td><td></td>';
      foreach ($result as $client) {
        $nomClient = $client["nom"];
        $prenomClient = $client["prenom"];
        $mailClient = $client["mail"];
        $isAdmin = "";
        if (checkAdmin($nomClient,$prenomClient, $mailClient)) {
          $isAdmin = "admin";
        } else {
          $isAdmin = "pas admin";
        }
        $mdpClient = $client["mdp"];
        $idClient = $client["id"];
        echo "<tr><td>".$idClient."</td><td>" . $nomClient . "</td><td>" . $prenomClient . "</td><td>" . $mailClient . "</td><td>" . $mdpClient . "</td><td>" . $isAdmin . "<td>" ;
        echo '<form method = "post" class="formBDD">';
        echo '<fieldset>';
        echo "<input type='hidden' name='supprimer' value=$nomClient>";
        echo "<input type='hidden' name='idSuppression' value=$idClient>";
        echo"<input name='suppr' class='supprimerProduit' type='submit' value = 'Supprimer'>";
        echo '<fieldset>';
        echo '</form>';
        echo '</td>';
        echo "</td></tr>";
      }
      echo '</tbody></table>';
      ?>
    <a href="admin-client-ajout.php" title="Cliquez ici pour ajouter un client à la base de donnée">
      <div id="ajouter"><img src="../img/icone-ajout.png" alt="image ajouter client">
    </div>
    </a>
  </main>
</body>

</html>