<?php
session_start();
$GLOBALS["page"] = "adminArticle.php";
require_once('index.php');
require_once('database/Database.php');


if(isset($_POST["suppr"])){ 
  $_SESSION['suppr'] = $_POST["supprimer"];
  header('Location: adminSupprimerArticle.php');
  exit();}
  
  if (isset($_POST['boutonRechercher'])) {
    $_SESSION['recherche'] = $_POST['inputRechercher'];
    header('Location: adminArticle.php');
    exit();
  }

?>
<!DOCTYPE html>
<html LANG="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>ADMIN</title>
  <style>
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

        td:last-child{
          margin-left: 1%;
        }

        td > img{
              width: 70%;
              margin: 5% 0;
            }

        #boutonRechercher img{
          height: 1vh;
          padding: 0 0.5em;
        }

        #boutonRechercher{
          border: 1px solid grey;
          display: float;
          padding: 1%;
          border-radius: 1em;
          background-color: #212529;
        }

        #boutonRechercher:hover{
            cursor: pointer;
        }

        #boutonRechercher:hover{
          background-color: #2965D4;
        }

        input#inputRechercher{
          margin:0;
          display: inline-block;
        }

        input#inputRechercher{
          height: 1vh;
          width: 80%;
          border: 1px solid grey;
          border-radius: 1em;
        }

        form#formRecherche{
          width: auto;
          margin: 2%;
        }

    </style>
</head>

<body>
  <main>
    <h1>Articles en vente</h1>
  <form id="formRecherche" method = "post">
  <input type="text" id="inputRechercher" name="inputRechercher" placeholder="Rechercher...">
  <button id="boutonRechercher" name="boutonRechercher" type="submit"><img src="img/rechercher.png" alt="image ajouter article"></button>
</form>
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
          $critere = "";
            if(isset($_SESSION['recherche'])){
               $critere = $_SESSION['recherche'];
               echo $critere;
            }

          for ($i = 1; $i <= $nbProduct; $i++) {
            if(verifyCritere($i, $critere)){
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
            $_SESSION[$nomProduit] = 0;
            $link = "img/" . $res2[0]['image'];
            //echo $link;
            echo '<td> ';
            echo "<img src=$link>";
            echo '<h2>';
            echo $result[0]["nom"];
            echo '</h2>';
            /*
            echo '<button> <img src="img/symboleMoins.png" id = "imageQuantiteMoins"></button>';
            echo '<p id="valeur"> <span id="chiffre">0 </span></p>';
            echo '<button> <img src="img/symbolePlus.png" id="imageQuantitePlus"></button>';*/

            echo '<form method = "post">';
            echo '<fieldset>';
            echo "<input type='hidden' name='supprimer' value=$nomProduit>";
            echo"<input name='suppr' class='supprimerProduit' type='submit' value = 'Supprimer' >";
            echo '<fieldset>';
            echo '</form>';
            echo '</td>';

      
            if ($i % 3 == 0) {
              echo "</tr>";
            }
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

            input.supprimerProduit{
              display: block;
              background-color: rgb(214, 0, 0);
              width: 100%;
              padding: 3%;
              margin:5% 0;
              
            }

            input.supprimerProduit:hover{
              background-color: red;
            }

            #ajouterArticle img{
                position: fixed;
                bottom: 3%;
                right: 10%;
                width: 5em;
                transition-duration: 0.1s;
                background-color: rgb(0, 102, 0);
                padding: 0.2em;
                border-radius: 1em;
                /*background-image: url('../img/fleche_haut.png');*/
            }

            /*div#haut_page{
                background-color: red;
                border: 1px solid #212529;
                margin-left: 50%;
                width: 5%;
                height: 5%;
                display: float;
                transition-duration: 0.4s;
            }*/

            div#ajouterArticle img:hover{
                transition-duration: 0.1s;
                background-color: green;
                width: 5.1em;
            }

            #ajouterArticle:hover{
                cursor: pointer;
            }
          </style>
        </tbody>
        <a href="adminAjouterArticle.php"title="Cliquez ici pour retourner en haut de la page">
          <div id="ajouterArticle"><img src="img/ajouterArticle.png" alt="image ajouter article"></a></div>
    </a>
  </main>
</body>
</html>