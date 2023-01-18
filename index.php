<?php
session_start();
$GLOBALS["page"] = "index.php";

if ((isset($_POST['nombreArticles']))) {
  $_SESSION['nombreArticles'] = $_POST['nombreArticles'];
  header('Location: client-traitement-panier.php');
  exit;
}

if (isset($_POST['boutonRechercher'])) {
  $_SESSION['recherche'] = $_POST['inputRechercher'];
  header('Location: index.php');
  exit();
}

require_once('includes/nav.php');
require_once('libs/database-functions.php');

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
  <style>
      body {
        background-image: url("img/indexBackground.jpg");
        background-position: center;
        width: 100%;
        height: 100vh;
        background-size : cover;
        background-repeat: no-repeat;
        overflow: hidden;
      }
    </style>
    <div class="accueilButton">
    <a href="../client/client-article.php" id="boutonMineta">Deviens un héros comme Mineta</a>
    </div>
</body>

</html>
