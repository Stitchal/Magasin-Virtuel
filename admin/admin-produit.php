<?php
session_start();
$GLOBALS["page"] = "admin-produit.php";
$GLOBALS["pageSuppression"] = "admin-produit.php";
require_once(__DIR__ . '/../libs/database.php');


if (isset($_POST["suppr"])) {
  $_SESSION['suppr'] = $_POST["supprimer"];
  $_SESSION['idSuppr'] = $_POST["idSuppression"];
  $_SESSION['tabSuppr'] = "produit";
  header('Location: ../admin/admin-suppression.php');
  exit();
}

if (isset($_POST['boutonRechercher'])) {
  $_SESSION['recherche'] = $_POST['inputRechercher'];
  header('Location: ../admin/admin-produit.php');
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
  <title>Table produit</title>
</head>

<body>
  <main>
    <h1>Table produit</h1>
    <form id="formRecherche" method="post">
      <input type="search" id="inputRechercher" name="inputRechercher" placeholder="Rechercher...">
      <button id="boutonRechercher" name="boutonRechercher" type="submit"><img src="../img/rechercher.png" alt="image ajouter article"></button>
    </form>
    <div class="article">
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
            echo $critere;
            $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM produit WHERE nom LIKE '%$critere%'");
          } else {
            $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM produit");
          }
          if (isset($_SESSION["recherche"])) {
            unset($_SESSION["recherche"]);
          }

          foreach ($result as $article) {
            $nomProduit = $article["nom"];

            if ($i % 3 == 1) {
              echo "<tr>";
            }

            $img = "SELECT image FROM produit WHERE nom = '$nomProduit'";
            $res2 = ConnexionDB::getInstance()->querySelect($img);
            //print_r($res2[0]['image']);
            $_SESSION[$nomProduit] = 0;
            $idProduit = $article['id'];
            $link = "../img/" . $res2[0]['image'];
            //echo $link;
            echo '<td> ';
            echo "<img src=$link>";
            echo '<h2>';
            echo $nomProduit;
            echo '</h2>';

            echo '<form method = "post">';
            echo '<fieldset>';
            echo "<input type='hidden' name='supprimer' value=$nomProduit>";
            echo "<input type='hidden' name='idSuppression' value=$idProduit>";
            echo "<input name='suppr' class='supprimerProduit' type='submit' value = 'Supprimer' >";
            echo '<fieldset>';
            echo '</form>';
            echo '</td>';

            if ($i % 3 == 0) {
              echo "</tr>";
            }
            $i++;
          }


          ?>
        </tbody>
        <a href="admin-produit-ajout.php" title="Cliquez ici pour ajouter un article à la base de donnée">
          <div id="ajouter"><img src="../img/icone-ajout.png" alt="image ajouter article">
        </a>
    </div>
    </a>
  </main>
</body>

</html>