<?php
    session_start();
    $GLOBALS["page"] = "compte.php";
    require_once('index.php');
    if(empty($_SESSION['nom']) || empty($_SESSION['prenom']) || empty($_SESSION['email'])){
        header('Location: articles.php');
        exit;
    }
?>

<!DOCTYPE html>
<html LANG="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Informations du compte</title>
</head>
<body>
    <main>
            <p> Nom : <?php echo $_SESSION['nom'] ?> </p>
            <p> Prenom : <?php echo $_SESSION['prenom'] ?> </p>
            <p> Mail : <?php echo $_SESSION['email'] ?> </p>
    </main>
</body>
</html>
