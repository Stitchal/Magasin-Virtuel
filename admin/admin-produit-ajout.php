<?php
session_start();
require_once(__DIR__ . '/../libs/database-functions.php');
require_once(__DIR__.'/../includes/nav.php');

if(isset($_POST["submit"]) && isset($_POST["icon"]) && isset($_POST["image"])){
    addProduct($_POST["id"], $_POST["nom"], $_POST["prixPublic"], $_POST["prixAchat"], $_POST["taille"], $_POST["couleur"],$_POST["refMarque"],  $_POST["titre"], $_POST["icone"],  $_POST["image"]);
    header("Location: admin-produit.php");
    exit();
}
else if(isset($_POST["submit"])){
    addProduct($_POST["id"], $_POST["nom"], $_POST["prixPublic"], $_POST["prixAchat"], $_POST["taille"], $_POST["couleur"],  $_POST["refMarque"], $_POST["titre"]);
    header("Location: admin-produit.php");
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
    input[type=submit]{
        background-color: rgb(1, 71, 1);
    }

    input[type=submit]:hover{
        background-color: green;
    }
    
    #divGauche{
        display: inline-block;
        width: 49%;
    }

    #divGauche input{
        height: 1vh;
        width: 50%;
    }

    #divDroite input{
        height: 1vh;
        width: 50%;
    }

    #divDroite{
        display: inline-block;
        width: 49%;
    }
    #divDroite input[type="color"]{
        height: 3vw;
        cursor: pointer;
    }

    #divInformations{
        border-radius: 1em;
        padding: 5%;
        background-color: #F7F7F7;
    }

    

  </style>
</head>

<body>
  <main>
    <div class="article">
        <h1>Informations de l'article</h1>
    <form method="post">
        <div id="divInformations">
            <div id="divGauche">
                <fieldset>
                    <label for="id">id</label>
                    <input placeholder="id" type="text" name="id" id="id" required>
                </fieldset>

                <fieldset>
                    <label for="nom">Nom</label>
                    <input placeholder="Nom" type="text" name="nom" id="nom" required>
                </fieldset>

                <fieldset>
                    <label for="prixPublic">prixPublic</label>
                    <input placeholder="Prix public" type="text" name="prixPublic" id="prixPublic" required>
                </fieldset>
                
                <fieldset>
                    <label for="prixAchat">prixAchat</label>
                    <input placeholder="Prix d'achat" type="text" name="prixAchat" id="prixAchat" required>
                </fieldset>

                <fieldset>
                    <label for="taille">taille</label>
                    <input placeholder="Taille" type="text" name="taille" id="taille" required>
                </fieldset>
            </div>

            <div id="divDroite">
                <fieldset>
                    <label for="couleur">couleur</label>
                    <input placeholder = "Couleur" type="color" name="couleur" id="couleur" required>
                </fieldset>
                
                <fieldset>
                    <label for="image">image</label>
                    <input placeholder="Image" type="text" name="image" id="image" value="default.png" onFocus="this.value='';">
                </fieldset>

                <fieldset>
                    <label for="icone">icone</label>
                    <input placeholder="Icône" type="text" name="icone" id="icone" value="default.png" onFocus="this.value='';">
                </fieldset>

                <fieldset>
                    <label for="titre">titre</label>
                    <input placeholder="Titre" type="text" name="titre" id="titre" required>
                </fieldset>

                <fieldset>
                    <label for="refMarque">refMarque</label>
                    <input placeholder="Référence de la marque" type="text" name="refMarque" id="refMarque" required>
                </fieldset>
            </div>
        </div>
        <fieldset>
            <input type="submit" name="submit" value="Ajouter l'article">
        </fieldset>
    </form>
    <p><a class="retourPage" href="admin-produit.php" title="Cliquez ici pour retourner à la page des articles">←Retourner à la page des articles</a></p>
  </main>
    </a>
</body>
</html>