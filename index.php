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

require_once('libs/database-functions.php');

?>
<!DOCTYPE html>
<html LANG="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="icon" href="../img/favicon.ico">
  <title>Minetazon</title>
</head>
<body id="minetaBackground">
  <div class="accueilButton">
  <a href="../client/client-article.php" id="boutonMineta">Deviens un héros comme Mineta</a>
  </div>
</body>

</html>
