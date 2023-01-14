<?php
session_start();
$GLOBALS["page"] = "adminFacturation.php";
require_once('nav.php');
require_once('menuAdmin.php');
require_once('database/Database.php');

?>

<!DOCTYPE html>
<html LANG="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>Table facturation</title>
</head>
<body>
  <main>
    <h1>Table facturation</h1>
  </main>
</body>
</html>