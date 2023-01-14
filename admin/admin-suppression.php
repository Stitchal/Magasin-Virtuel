<?php
session_start();
//$GLOBALS["page"] = "admin-suppression.php";
//echo $_SESSION["suppr"];
$GLOBALS["page"] = "admin-suppression.php";
require_once(__DIR__ . '/../libs/database-functions.php');
require_once(__DIR__.'/../includes/nav.php');

if (isset($_POST['oui'])){
     $_SESSION['oui'] = $_POST['oui'];
     deleteElement($_SESSION['idSuppr'], $_SESSION['tabSuppr']);
    header('Location: index-admin.php');
    exit;
}
elseif (isset($_POST['non'])){
    $_SESSION['non'] = $_POST['non'];
    header('Location: index-admin.php');
    exit;
}


?>

<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Suppression de "<?php echo $_SESSION["suppr"]; ?>"</title>
    <style>
    
    </style>
</head>

<body>
  <main>
    <h1>Voulez-vous supprimer les données associées à "<?php echo $_SESSION["suppr"]; ?>" ?</h1>
    <form method="post">
        <fieldset id="suppression">
            <input type="radio" name="oui"><p>Oui</p>
            <input type="radio" name="non"><p>Non</p>
        </fieldset>
        <fieldset>
            <input type="submit" value="Valider">
        </fieldset>
    </form>
    <div class="article">
    <p><a id="retourPageArticle" href="javascript:history.back()" title="Cliquez ici pour retourner à la page précédente">←Retourner à la page précédente</a></p>
    </main>
</body>
</html>