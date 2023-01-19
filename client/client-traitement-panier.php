<?php
session_start();
$_SESSION['ajoutPanier'] = "";

if (!isset($_SESSION['panier'])) { //Si il n'existe aucun panier, on en crée un
    $_SESSION['panier'] = array();
}


$product_name = $_POST["nomProduit"];
$product_quantity = $_POST["quantite"];



require_once(__DIR__ . '/../libs/database-functions.php');

if (($_POST["quantite"] == "") or ($_POST["quantite"] == 0)) { //Si on veut ajouter un produit avec une quantité vide ou une quantité égale à 0
    unset($_SESSION['panier'][array_search($_POST["quantite"], $_SESSION['panier'])]);
} else if (isset($_SESSION['panier'][$product_name])) { //Si on veut ajouter un produit
    if (checkStockProduct(getIDProduct($product_name), $_SESSION['panier'][$product_name] + $product_quantity)) {
        $_SESSION['panier'][$product_name] = $_SESSION['panier'][$product_name] + $product_quantity;
        $_SESSION['ajoutPanier'] = $product_name;
        $_SESSION['nbArticle'] = $_SESSION['nbArticle'] + $_POST["quantite"];
    } else {
        $error = "Quantite depassant la limite des stocks";
        header('Location: client-article.php?error=' . urlencode($error));
    }
   
} else { //Sinon alors veut modifier la quantité
        $_SESSION['panier'][$product_name] = $product_quantity;
        $_SESSION['nbArticle'] = $_SESSION['nbArticle'] + $_POST["quantite"];
}

header('Location: client-article.php');
exit();

