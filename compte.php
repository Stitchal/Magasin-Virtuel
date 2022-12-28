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
            <h1>Vue d'ensemble du compte</h1>
            <div class="divCompte">
            <table>
                <tbody>
                    <tr>
                        <td>Prénom nom</td>
                        <td><?php echo $_SESSION['prenom'] ?> <?php echo $_SESSION['nom'] ?></td>
                    </tr>
                    <tr>
                        <td>Adresse e-mail</td>
                        <td><?php echo $_SESSION['email'] ?></td>
                    </tr>
                </tbody>
            </table>
            </div>
    </main>
    <a href="#"title="Cliquez ici pour retourner en haut de la page">
        <div id="haut_page"><img src="img/flecheHaut.png" alt="image fleche haut"></a></div>
    </a>
</body>
</html>
