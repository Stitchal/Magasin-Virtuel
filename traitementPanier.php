<?php
session_start();

if(!isset($_SESSION['panier'])){
  $_SESSION['panier'] = array();
}

$product_name = $_POST["nomProduit"];
$product_quantity = $_POST["quantite"];

if(($_POST["quantite"] == "") or ($_POST["quantite"] == 0)){
    unset($_SESSION['panier'][array_search($_POST["quantite"], $_SESSION['panier'])]);
    echo "supprime";
}
else if (isset($_SESSION['panier'][$product_name])){
    $_SESSION['panier'][$product_name] = $_SESSION['panier'][$product_name]+$product_quantity;
}
else {
    $_SESSION['panier'][$product_name] = $product_quantity;
}

header('Location: index.php');
exit();
?>