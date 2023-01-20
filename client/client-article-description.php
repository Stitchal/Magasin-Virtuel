<?php
$nomProduit = $_GET['nomProduit'];
$page = "client-article-description.php";


require_once(__DIR__.'/../includes/nav.php');
require_once('../libs/database-functions.php');
$result = getInfoProd($nomProduit)
?>

<!DOCTYPE html>
<html LANG="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/article-description.css">
  <title> <?php echo $result["titre"]; ?> </title>
</head>

<body>

<?php ; 
$link = "../produits-img/" . $result['image']; ?>
<main>
<div class="container">
    <img class="article-image" src="<?= $link ?>" alt="Article Image">
    <h2 class="article-title"> <?= $result["titre"] ?></h2>
    <p class="article-text"> <?= $result["description"] ?> </p>
    <p class="article-info"> Prix d'achat : <?= $result["prixPublic"] ?>  Couleur : <?= $result["couleur"] ?></p>
    <a href="client-article.php" class="back-button">Retour aux articles</a>
</div>
</main>
</body>
</html>
  <a href="#" title="Cliquez ici pour retourner en haut de la page">
    <div id="haut_page"><img src="../img/fleche-haut-page.png" alt="image fleche haut">
  </a></div>
  </a>
</body>

</html>