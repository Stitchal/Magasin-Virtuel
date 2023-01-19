<?php
session_start();
$GLOBALS["page"] = "admin-reapprovisionnement.php";
require_once(__DIR__ . '/../libs/database-functions.php');
require_once(__DIR__ . '/../libs/functions.php');



require_once(__DIR__ . '/../includes/nav.php');
?>

<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>REAPPROVISIONNEMENT</title>
    <style>
        input[type=submit]#ajouterItem {
            background-color: rgb(1, 71, 1);
        }

        input[type=submit]#ajouterItem:hover {
            background-color: green;
        }
    </style>
    <script>
        var prix = <?= json_encode($_SESSION["prix"]) ?>;
        function updateTotal(prix) {
            const quantity = document.getElementById("quantity").value;
            const total = document.getElementById("total");
            if (quantity > 0) {
                // Use the value of the prix variable passed as parameter
                total.innerHTML = "Montant total : " + (quantity * prix);
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
                    <input type="number" name="qtReappro" id="quantity" value="1" min="<?php echo getStockProduct($_SESSION['idReappro']) ?>" max="99" oninput="updateTotal(prix)" required>
                </fieldset>
                <p> Fournisseur : <?php echo getFournisseur($_SESSION['idReappro']) ?></p>
                <p id="total"> Montant total : 0</p>
                <div>
                    <a href="admin-payer.php" id="passerCommande" title="Cliquez ici passer la commande">Commander et payer</a>
                </div>

            </form>
            <p><a class="retourPage" href="admin-facturation.php" title="Cliquez ici pour retourner à la page des factures">←Retourner à la page des factures</a></p>
    </main>
    </a>
</body>

</html>