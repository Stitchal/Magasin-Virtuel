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
      <script>
        let valeur = 0;
      </script>

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

            if ($i % 2 == 1) {
              echo "<tr>";
            }

            $nomProduit = $result[0]["nom"];
            $_SESSION[$nomProduit] = 0;
            $img = "SELECT image FROM produit WHERE id = $i";
            $res2 = ConnexionDB::getInstance()->querySelect($img);
            //print_r($res2[0]['image']);
            $_SESSION[$nomProduit] = 0;
            $link = "img/" . $res2[0]['image'];
            //echo $link;
            echo '<td> ';
            echo "<img src=$link>";
            echo '<h1>';
            echo $result[0]["nom"];
            echo '</h1>';
            echo '<br>';
            echo '<button onclick="decrementer(); decrementerphp($nomProduit);"> <img src="img/symboleMoins.png" id = "imageQuantiteMoins"></button>';
            echo '<p id="valeur"> <span id="chiffre">0 </span></p>';
            echo '<button onclick="augmenter(); augmenterphp($nomProduit);"> <img src="img/symbolePlus.png" id="imageQuantitePlus"></button>';
            echo '</td>';

            if ($i % 2 == 0) {
              echo "</tr>";
            }
          }
          ?>



          <script>
            function augmenter() {
              // Incrémentation de la valeur de la variable
              //$_SESSION[$nomProduit] += 1;
              valeur += 1;
              // Mise à jour de la valeur dans le document
              document.getElementById('chiffre').innerHTML = valeur;
            }

            function decrementer() {
              // Incrémentation de la valeur de la variable
              //$_SESSION['b'] += 1;
              if (valeur - 1 >= 0) {
                valeur -= 1;
              }
              // Mise à jour de la valeur dans le document
              document.getElementById('chiffre').innerHTML = valeur;
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
              width: 20px;
              height: 20px;
            }

            #imageQuantitePlus {
              width: 20px;
              height: 20px;
            }

            td {
              text-align: center;
              display: inline-block;
            }

            button {
              border: none;
              background-color: white;
              display: inline-block;
            }

            p {
              display: inline-block;
            }
          </style>
        </tbody>
  </main>
    <a href="#"title="Cliquez ici pour retourner en haut de la page">
          <div id="haut_page"><img src="img/flecheHaut.png" alt="image fleche haut"></a></div>
    </a>
</body>
</html>