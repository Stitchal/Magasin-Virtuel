<?php
session_start();
$GLOBALS["page"] = "admin-produit.php";
$GLOBALS["pageSuppression"] = "admin-produit.php";
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

          echo '<table class="bdd" id="produitTD">
          <tbody>
          <tr>
            <td>id</td>
            <td>nom</td>
            <td>prixPublic</td>
            <td>prixAchat</td>
            <td>taille</td>
            <td>couleur</td>
            <td>image</td>
            <td>icone</td>
            <td>titre</td>
            <td>refMarque</td>
            <td></td>
          </tr>';
          foreach ($result as $article) {
            echo   "<tr>
                      <td>" . $article["id"] . "</td>
                      <td>" . $article["nom"] . "</td>
                      <td>" . $article["prixPublic"] . "</td>
                      <td>" . $article["prixAchat"] . "</td>
                      <td>" . $article["taille"] . "</td>
                      <td>" . $article["couleur"] . "</td>
                      <td>" . $article["image"] . "</td>
                      <td>" . $article["icone"] . "</td>
                      <td>" . $article["titre"] . "</td>
                      <td>" . $article["refMarque"] . "</td>
                    </tr>";
          }

          echo "</tbody></table><table>";

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
            $link = "../produits-img/" . $res2[0]['image'];
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