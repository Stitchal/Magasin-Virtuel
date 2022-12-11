<?php
session_start();
$GLOBALS["page"] = "deconnexion.php";
require_once('index.php');

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

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
        <p>Vous êtes déconnecté</p>
    </main>
</body>
</html>