<?php
session_start();
$GLOBALS["page"] = "client-article.php";

if ((isset($_POST['nombreArticles']))) {
  $_SESSION['nombreArticles'] = $_POST['nombreArticles'];
  header('Location: client-traitement-panier.php');
  exit;
}

if (isset($_POST['boutonRechercher'])) {
  $_SESSION['recherche'] = $_POST['inputRechercher'];
  header('Location: client-article.php');
  exit();
}

require_once(__DIR__.'/../includes/nav.php');
require_once(__DIR__ . '/../libs/database-functions.php');
require_once(__DIR__.'/../libs/functions.php');

?>

<!DOCTYPE html>
<html LANG="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/responsive.css">
  <title>Magasin Virtuel</title>
</head>

<body>
  <main>
    <form id="formRecherche" method = "post">
      <div class ="divBarreRecherche">
        <input type="search" id="inputRechercher" name="inputRechercher" placeholder="Rechercher...">
        <button id="boutonRechercher" name="boutonRechercher" type="submit"><img src="../img/rechercher.png" alt="image ajouter article"></button>
      </div>
    </form>
    <div class="article">
      <table id="tabArticles">
        <tbody>
          <?php
          ConnexionDB::getInstance();
          $sql = "SELECT * FROM produit";
          $result = ConnexionDB::getInstance()->querySelect($sql);
          $i = 1;
          $critere = "";
            if(isset($_SESSION['recherche'])){
               $critere = $_SESSION['recherche'];
               $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM produit WHERE nom LIKE '%$critere%'");
            }
            else{
              $result = ConnexionDB::getInstance()->querySelect("SELECT * FROM produit");
            }
          foreach ($result as $article) {
            $nomProduit = $article["nom"];
            $maxProduit = getStockProduct(getIDProduct($nomProduit));

            if ($i % 3 == 1) {
              echo "<tr>";
            }

            $img = "SELECT image FROM produit WHERE nom = '$nomProduit'";
            $res2 = ConnexionDB::getInstance()->querySelect($img);
            //print_r($res2[0]['image']);
            $link = "img/" . $res2[0]['image'];
            //echo $link;
            echo '<td> ';
            echo "<img src=$link>";
            echo '<h2>';
            echo $nomProduit;
            echo '</h2>';
            $requetePrix = "SELECT prixPublic FROM produit WHERE nom = '$nomProduit'";
            $resRequete = ConnexionDB::getInstance()->querySelect($requetePrix);
            $prix = $resRequete[0]['prixPublic'];
            if(!empty($_SESSION['nom'])){
              echo '<br>';
              echo '<button onclick="decrementer(\'' . $nomProduit . '\', \'' . $maxProduit . '\' );"> <img src="../img/icone-reduire-nb-article.png" id = "imageQuantiteMoins"></button>';
              echo '<p id="' . $nomProduit . '"> <span id="chiffre">0 </span></p>';
              echo '<button onclick="augmenter(\'' . $nomProduit . '\', \'' . $maxProduit . '\');"> <img src="../img/icone-augmenter-nb-article.png" id="imageQuantitePlus"></button>';
            }
              echo '<br><div class="prix"><p>'.$prix.'€</p></div>';
              if(!empty($_SESSION['nom'])){
              echo '<form method="post" action="client-traitement-panier.php">';
              echo '<input type="hidden" id="nom" name="nomProduit" value="' . $nomProduit . '">';
              echo '<input type="hidden" id="quantite-'.$nomProduit.'" name="quantite" value="">';
              echo '<fieldset>';
              
              echo '<button class="ajouterPanier" name="ajouterPanier" type="submit"><img src="../img/icone-ajout-panier.png" alt="image ajouter panier" src="client/traitementPanier.png"></button>';
              echo '</fieldset>';
              echo '</form>';
              echo '</td>';
            }
            

            if ($i % 3 == 0) {
              echo "</tr>";
            }
            $i++;
          }
          ?>

          <script>
            function augmenter(nomProduit, maxProduit) {
              // Incrémentation de la valeur de la variable
              if (!window.valeurs) {
                window.valeurs = {};
                document.getElementById(nomProduit).innerHTML = window.valeurs[nomProduit];
                document.getElementById('quantite-'+nomProduit).value = window.valeurs[nomProduit]
              }
              if (!window.valeurs[nomProduit]) {
                window.valeurs[nomProduit] = 0;
                document.getElementById(nomProduit).innerHTML = window.valeurs[nomProduit];
                document.getElementById('quantite-'+nomProduit).value = window.valeurs[nomProduit]
              }
              if(window.valeurs[nomProduit]+1 <= maxProduit){
                window.valeurs[nomProduit] += 1;
                document.getElementById(nomProduit).innerHTML = window.valeurs[nomProduit];
                document.getElementById('quantite-'+nomProduit).value = window.valeurs[nomProduit]
              }
              // Mise à jour de la valeur dans le document
              document.getElementById(nomProduit).innerHTML = window.valeurs[nomProduit];
              document.getElementById('quantite-'+nomProduit).value = window.valeurs[nomProduit]
            }

            function decrementer(nomProduit, maxProduit) {
              // Incrémentation de la valeur de la variable
              if (!window.valeurs) {
                window.valeurs = {};
              }
              if (!window.valeurs[nomProduit]) {
                window.valeurs[nomProduit] = 0;
              }
              if (window.valeurs[nomProduit] - 1 >= 0) {
                window.valeurs[nomProduit] -= 1;
              }
              // Mise à jour de la valeur dans le document
              document.getElementById(nomProduit).innerHTML = window.valeurs[nomProduit];
              document.getElementById('quantite-'+nomProduit).value = window.valeurs[nomProduit]
            }

          </script>

          <style>
            #imageQuantiteMoins {
              width: 2em;
              height: 2em;
              cursor: pointer;
            }

            #imageQuantitePlus {
              width: 2em;
              height: 2em;
              cursor: pointer;
            }

            button {
              display: inline-block;
            }

            td {
              background-color: white;
              border-width: 0px;
              text-align: center;
              display: inline-block;
              width: calc(98%/3);
              margin-top: 1%;
            }

            td:first-child {
              margin-right: 1%;
            }

            form {
              margin: 0;
              width: 100%;
            }

            td:last-child {
              margin-left: 1%;
            }

            td>img {
              width: 70%;
              margin: 5% 0;
            }

            button {
              border: none;
              background-color: white;
              display: inline-block;
            }

            button:hover {
              cursor: pointer;
            }

            p {
              display: inline-block;
            }
          </style>
        </tbody>
      </table>
    </div>
  </main>
  <a href="#" title="Cliquez ici pour retourner en haut de la page">
    <div id="haut_page"><img src="../img/fleche-haut-page.png" alt="image fleche haut">
  </a></div>
  </a>
</body>

</html>