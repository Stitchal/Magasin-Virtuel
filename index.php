<?php
session_start();
$GLOBALS["page"] = "index.php";

if ((isset($_POST['nombreArticles']))) {
  $_SESSION['nombreArticles'] = $_POST['nombreArticles'];
  header('Location: client-traitement-panier.php');
  exit;
}

if (isset($_POST['boutonRechercher'])) {
  $_SESSION['recherche'] = $_POST['inputRechercher'];
  header('Location: index.php');
  exit();
}

require_once('includes/nav.php');
#require_once('libs/database.php');
require_once('libs/database-functions.php');

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
  <style>
      body {
        background-image: url("img/indexBackground.jpg");
        background-size : cover;
      }
    </style>
  <main>
    <p id="textIndex" style="display:none;">Des milliers d'articles exclusifs à découvrir dès maintenant </p>
    <div class="accueilButton">
    <a href="../client/client-article.php" onmouseover="showImg()" onmouseout="hideImg()" class="boutonMinetta">Deviens un héros comme Minetta</a>
    </div>
  </main>
  <a href="#" title="Cliquez ici pour retourner en haut de la page">
    <div id="haut_page"><img src="img/fleche-haut-page.png" alt="image fleche haut">
  </a></div>
  </a>
</body>

<script> 
function showImg() {
  const img = document.createElement("img");
  img.src = "img/Mineta.webp";
  img.id = "img";
  img.style.position = "absolute";
  img.style.top = "30%";
  img.style.left = "50%";
  document.body.appendChild(img);
  const text = document.createElement("div");
  text.id = "text";
  text.innerHTML = "Clique pour découvrir les nouveautés";
  text.style.position = "absolute";
  text.style.top = "55%";
  text.style.left = "40%";
  text.style.transform = "translate(-50%, -50%)";
  text.style.padding = "20px";
  text.style.backgroundColor = "white";
  text.style.zIndex = "1";
  document.body.appendChild(text);

}
function hideImg() {
  document.getElementById("img").remove();
  document.getElementById("text").remove();
}

</script>
</html>
