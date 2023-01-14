<?php
    session_start();
    $GLOBALS["page"] = "compte.php";
    require_once(__DIR__.'/../includes/nav.php');

    if (checkAdmin($_SESSION['nom']) ){
        require_once(__DIR__.'/../includes/menu-admin.php');
        require_once(__DIR__ . '/../libs/database.php');
    }

    if(empty($_SESSION['nom']) || empty($_SESSION['prenom']) || empty($_SESSION['email'])){
        header('Location: index.php');
        exit;
    }

    require_once(__DIR__ . '/../libs/database-functions.php');
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
                    <tr>
                        <td> Statut </td>
                        <td><?php if(checkAdmin($_SESSION['nom'])) : echo "admin" ?> <?php else : echo "pas admin"?> <?php endif; ?> </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <?php
            if(checkClientCommande($_SESSION["nom"])){
            echo '<div>';
            echo '<a href="../client/client-factures.php" id="bouton" title="Cliquez ici passer la commande">Voir les factures</a>';
            echo '</div>';
            }
            ?>
    </main>
</body>
</html>

