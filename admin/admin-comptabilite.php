<?php
session_start();
$GLOBALS["page"] = "admin-comptabilite.php";
require_once(__DIR__.'/../includes/nav.php');
require_once(__DIR__ . '/../includes/menu-admin.php');
require_once(__DIR__ . '/../libs/database.php');
?>

<!DOCTYPE html>
<html LANG="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>Table comptabilite</title>
</head>
<body>
  <main>
    <h1>Table comptabilite</h1>
  </main>
</body>
</html>