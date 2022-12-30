<?php
session_start();
$GLOBALS["page"] = "adminArticle.php";
require_once('index.php');
require_once('database/Database.php');

?>

<!DOCTYPE html>
<html LANG="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>ADMIN</title>
</head>

<body>
  <main>
    <h1>Vue d'ensemble articles</h1>
    <div class="article">
        <h1>Ajouter nouvel article</h1>
    
    <form method="post">
        <fieldset>
            <label for="id">id</label>
            <input placeholder="id" type="text" name="id" id="id" required>
        </fieldset>

        <fieldset>
            <label for="nom">Nom</label>
            <input placeholder="nom" type="text" name="nom" id="nom" required>
        </fieldset>

        <fieldset>
            <label for="prixPublic">prixPublic</label>
            <input placeholder="prixPublic" type="text" name="prixPublic" id="prixPublic" required>
        </fieldset>
        
        <fieldset>
            <label for="prixAchat">prixAchat</label>
            <input placeholder="prixAchat" type="text" name="prixAchat" id="prixAchat" required>
        </fieldset>

        <fieldset>
            <label for="taille">taille</label>
            <input placeholder="taille" type="text" name="taille" id="taille" required>
        </fieldset>

        <fieldset>
            <label for="couleur">couleur</label>
            <input placeholder = "couleur" type="color" name="couleur" id="couleur" required>
        </fieldset>
        
        <fieldset>
            <label for="image">image</label>
            <input placeholder="image" type="text" name="image" id="image" required>
        </fieldset>

        <fieldset>
            <label for="icone">icone</label>
            <input placeholder="icone" type="text" name="icone" id="icone" required>
        </fieldset>

        <fieldset>
            <label for="titre">titre</label>
            <input placeholder="titre" type="text" name="titre" id="titre" required>
        </fieldset>

        <fieldset>
            <label for="refMarque">refMarque</label>
            <input placeholder="refMarque" type="text" name="refMarque" id="refMarque" required>
        </fieldset>

        <fieldset>
            <input type="submit" value="ajouter l'article">
        </fieldset>
    </form>
    <p><a href="adminArticle.php" title="Cliquez ici pour retourner à la page des articles">Retourner à la page des articles</a></p>
  </main>
  
    <a href="#"title="Cliquez ici pour retourner en haut de la page">
          <div id="haut_page"><img src="img/flecheHaut.png" alt="image fleche haut"></a></div>
    </a>
</body>
</html>