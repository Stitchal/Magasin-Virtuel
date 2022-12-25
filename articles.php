<?php
    session_start();
    $GLOBALS["page"] = "articles.php";
    require_once('index.php');
    require_once('database/DatabaseFunction.php');
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
        <h1>Articles</h1>
        <table>
            <tbody>
                <tr>
                    <td>article1</td>
                    <td>article2</td>
                </tr>
                <?php generateProduct() ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>Développé par <a href="mailto:alexis.rosset@etu.univ-cotedazur.fr">Alexis Rosset</a> et <a href="mailto:leo.quelis@etu.univ-cotedazur.fr">Léo Quelis</a> - 2022-2023</p>
    </footer>
</body>
</html>