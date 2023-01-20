<?php
session_start();
$GLOBALS["page"] = "client-article.php";

if(!isset($_SESSION['nbArticle'])){
  $_SESSION['nbArticle'] = 0;
}

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
  <link rel="stylesheet" href="../css/client-articles.css">
  <title>Magasin Virtuel</title>
</head>

<body>
  <main>
  <?php if (!empty($_GET) || !empty($_GET['error'])) : ?>
            <p style="color:#FF0000" ;> Erreur : <?= $_GET['error'] ?> </p>
        <?php endif ?>
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
            $link = "../img/" . $res2[0]['image'];
            //echo $link;
            echo '<td> ';
            echo '<a href="client-article-description.php?nomProduit=' . $nomProduit . '">';
            echo "<img src=$link>";
            echo '</a>';
            echo '<h2>';
            echo $nomProduit;
            echo '</h2>';
            $requetePrix = "SELECT prixPublic FROM produit WHERE nom = '$nomProduit'";
            $resRequete = ConnexionDB::getInstance()->querySelect($requetePrix);
            $prix = $resRequete[0]['prixPublic'];
            if(!empty($_SESSION['nom'])){
              echo '<br>';
              echo '<button onclick="decrementer(\'' . $nomProduit . '\', \'' . $maxProduit . '\' );"> <img src="../img/icone-reduire-nb-article.png" id = "imageQuantiteMoins"></button>';
              echo '<p style="display: inline-block;" id="' . $nomProduit . '"> <span id="chiffre">0 </span></p>';
              echo '<button class="augmenter" onclick="augmenter(\'' . $nomProduit . '\', \'' . $maxProduit . '\');"> <img src="../img/icone-augmenter-nb-article.png" id="imageQuantitePlus"></button>';
            }
              echo '<br><div class="prix"><p style="display: inline-block;" >'.$prix.'€</p></div>';
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

          if((isset($_SESSION['ajoutPanier'])) && ($_SESSION['ajoutPanier'] != "")) {
            $nomArticle = $_SESSION['ajoutPanier'];
            //setTimeout(function() { alert("L'article vient d'être ajouté au panier"); }, 100);
            //echo '<script language="javascript"> setTimeout(function() { alert("L\'article '.$nomArticle.' vient d\'être ajouté au panier");}, 100)</script>';
            echo '<script language="javascript"> window.addEventListener("load", function() { setTimeout(function(){ alert("L\'article '.$nomArticle.' vient d\'être ajouté au panier");}, 150);});</script>';
            /*window.addEventListener("load", function() {
              setTimeout(function(){
                  alert("Hello, welcome to my website!");
              }, 50);
          });*/


            $_SESSION['ajoutPanier'] = "";
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