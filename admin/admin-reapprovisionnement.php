<?php
session_start();
$GLOBALS["page"] = "admin-reapprovisionnement.php";
require_once(__DIR__ . '/../libs/database-functions.php');
require_once(__DIR__ . '/../libs/functions.php');
require_once(__DIR__ . '/../libs/verifySession.php');

$verifyAdmin = new VerifSession();
if (!$verifyAdmin->verifConnection() || (!checkAdmin($_SESSION["nom"], $_SESSION["prenom"], $_SESSION["email"]))) {
    header('Location: ../others/connexion.php');
    exit();
}


$prix = getPrixArticleGestion($_SESSION['idReappro']);

if (isset($_POST["payer"]) && $_POST["qtReappro"] != '0') {
    $_SESSION["montantPayer"] = $_POST["qtReappro"] * $prix;
    $_SESSION["quantitePayer"] = $_POST["qtReappro"];
    header('Location: admin-payer.php');
    exit;
}


require_once(__DIR__ . '/../includes/nav.php');
?>

<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Réapprovisionnement</title>
    <style>
        input[type=submit]#ajouterItem {
            background-color: rgb(1, 71, 1);
        }

        input[type=submit]#ajouterItem:hover {
            background-color: green;
        }
    </style>
    <script>
        var prix = <?= $prix ?>;

        function updateTotal(prix) {
            const quantity = document.getElementById("quantity").value;
            const total = document.getElementById("total");
            if (quantity > 0) {
                // Use the value of the prix variable passed as parameter
                var montantTotal = (quantity * prix).toFixed(2);
                total.innerHTML = "Montant total : " + montantTotal;
            }
        }
    </script>
</head>

<body>
    <main>
        <div class="reapprovisionnement">
            <h1>Reapprovisionner les stocks</h1>
            <form id="formAjouter" method="post">
                <fieldset>
                    <label for="quantity">Quantite de produit a commander</label>
                    <input type="number" name="qtReappro" id="quantity" value="1" min="1" max="99" oninput="updateTotal(prix)" required>
                </fieldset>
                <p> Fournisseur : <?php echo getFournisseur($_SESSION['idReappro']) ?></p>
                <p id="total"> Montant total : <?php echo $prix ?></p>
                <div>
                    <input name='payer' class='payerCommande' type='submit' value='payer'>
                </div>
            </form>
            <p><a class="retourPage" href="admin-gestion_stock.php" title="Cliquez ici pour retourner à la page des factures">←Retourner à la page des factures</a></p>
    </main>
    </a>
</body>

</html>