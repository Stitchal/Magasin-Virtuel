<?php
session_start();
$_SESSION = array();
session_destroy();

if (empty($_SESSION['nom']) and empty($_SESSION['prenom'])){
    header('Location: ../index.php');
    exit;
}
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
    <?php
    if (empty($_POST['nom']) and empty($_POST['prenom'])){
        header('Location: ../index.php');
        exit;
    }
    ?>
</body>
</html>