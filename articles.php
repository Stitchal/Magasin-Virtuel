<?php
session_start();
$GLOBALS["page"] = "articles.php";
require_once('index.php');
require_once('database/Database.php');

?>

<!DOCTYPE html>
<html LANG="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>Magasin Virtuel</title>
</head>

<body>
  <main>
    <h1>Articles</h1>
    <div class="article">
    <table>
        <tbody>
          <?php
          ConnexionDB::getInstance();
          $sql = "SELECT id FROM produit";
          $result = ConnexionDB::getInstance()->querySelect($sql);
          $nbProduct = count($result);

          for ($i = 1; $i <= $nbProduct; $i++) {
            $nom = "SELECT nom FROM produit WHERE id = $i";
            $result = ConnexionDB::getInstance()->querySelect($nom);

            if ($i % 3 == 1) {
              echo "<tr>";
            }

            $nomProduit = $result[0]["nom"];
            $_SESSION[$nomProduit] = 0;
            $img = "SELECT image FROM produit WHERE id = $i";
            $res2 = ConnexionDB::getInstance()->querySelect($img);
            //print_r($res2[0]['image']);
            $link = "img/" . $res2[0]['image'];
            //echo $link;
            echo '<td> ';
            echo "<img src=$link>";
            echo '<h2>';
            echo $result[0]["nom"];
            echo '</h2>';
            echo '<br>';
            echo '<button onclick="decrementer(\''.$nomProduit.'\');"> <img src="img/symboleMoins.png" id = "imageQuantiteMoins"></button>';
            echo '<p id="'.$nomProduit.'"> <span id="chiffre">0 </span></p>';
            echo '<button onclick="augmenter(\''.$nomProduit.'\');"> <img src="img/symbolePlus.png" id="imageQuantitePlus"></button>';
            echo '<form method = "post">';
            echo '<fieldset>';
            echo"<input name='suppr' class='ajouterPanier' type='image' src='img/ajouterAuPanier.png' >";
            echo '<fieldset>';
            echo '</form>';
            echo '</td>';
            echo '</td>';

            if ($i % 3 == 0) {
              echo "</tr>";
            }
          }
          ?>

          <script>
            function augmenter(nomProduit) {
              // Incrémentation de la valeur de la variable
              if (!window.valeurs) {
                window.valeurs = {};
              }
              if (!window.valeurs[nomProduit]) {
                window.valeurs[nomProduit] = 0;
              }
              window.valeurs[nomProduit] += 1;
              // Mise à jour de la valeur dans le document
              document.getElementById(nomProduit).innerHTML = window.valeurs[nomProduit];
            }

            function decrementer(nomProduit) {
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
            }
          </script>

          <?php
          function augmenterphp($nomProduit)
          {
            $_SESSION[$nomProduit] += 1;
          }

          function decrementerphp($nomProduit)
          {
            if ($_SESSION[$nomProduit] - 1 >= 0) {
              $_SESSION[$nomProduit] -= 1;
            }
          }

          ?>

          <style>
            #imageQuantiteMoins {
              width: 2em;
              height: 2em;
              cursor:pointer;
            }

            #imageQuantitePlus {
              width: 2em;
              height: 2em;
              cursor:pointer;
            }

            button{
              display: inline-block;
            }

            td{
            background-color: white;
            border-width: 0px;
            text-align: center;
            display: inline-block;
            width: calc(98%/3);
            margin-top: 1%;
            }

            td:first-child{
              margin-right: 1%;
            }

            form{
              margin: 0;
              width: 100%;
            }

            td:last-child{
              margin-left: 1%;
            }

            td > img{
              width: 70%;
              margin: 5% 0;
            }

            button {
              border: none;
              background-color: white;
              display: inline-block;
            }

            button:hover{
              cursor: pointer;
            }

            p {
              display: inline-block;
            }

            .ajouterPanier{
              margin-left: 80%;
              width: 10%;
              background-color: #212529;
              padding: 2%;
              transition-duration: 0.2s;
              border-radius: 0.75em;
            }
            .ajouterPanier:hover{
              transition-duration: 0.1s;
              background-color: rgb(41, 101, 212);
            }
          </style>
        </tbody>
  </main>
    <a href="#"title="Cliquez ici pour retourner en haut de la page">
          <div id="haut_page"><img src="img/flecheHaut.png" alt="image fleche haut"></a></div>
    </a>
</body>
</html>
