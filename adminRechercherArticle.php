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
    <h1>Voulez vous supprimer l'article</h1>
    <div class="article">
    </main>
</body>
</html>