<?php
    session_start();
    $_SESSION["clientPayer"] = 0;
?>

<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">q
    <link rel="stylesheet" href="../css/responsive.css">
    <title>Magasin Virtuel</title>
</head>

<body>
    <main>
        <div id="smart-button-container">
            <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>
            <?php echo 'Prix total : '.$_SESSION["totalPaiement"].'€';
            echo '<input type="hidden" name="amountInput" id="amount" value="' . $_SESSION["totalPaiement"] . '">';?>
            <p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter a price</p>
            <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value=""></div>
            <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>
            <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
        </div>
        <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
        <script>
            function initPayPalButton() {
                var description = document.querySelector('#smart-button-container #description');
                var amount = document.querySelector('#smart-button-container #amount');
                var descriptionError = document.querySelector('#smart-button-container #descriptionError');
                var priceError = document.querySelector('#smart-button-container #priceLabelError');
                var invoiceid = document.querySelector('#smart-button-container #invoiceid');
                var invoiceidError = document.querySelector('#smart-button-container #invoiceidError');
                var invoiceidDiv = document.querySelector('#smart-button-container #invoiceidDiv');

                var elArr = [description, amount];

                if (invoiceidDiv.firstChild.innerHTML.length > 1) {
                    invoiceidDiv.style.display = "block";
                }
                var purchase_units = [];
                purchase_units[0] = {};
                purchase_units[0].amount = {};

                function validate(event) {
                    return event.value.length > 0;
                }

                paypal.Buttons({
                    style: {
                        color: 'gold',
                        shape: 'rect',
                        label: 'paypal',
                        layout: 'vertical',

                    },

                    onInit: function(data, actions) {
                        actions.disable();

                        if (invoiceidDiv.style.display === "block") {
                            elArr.push(invoiceid);
                        }

                        elArr.forEach(function(item) {
                            item.addEventListener('keyup', function(event) {
                                var result = elArr.every(validate);
                                if (result) {
                                    actions.enable();
                                } else {
                                    actions.disable();
                                }
                            });
                        });
                    },

                    onClick: function() {
                        if (description.value.length < 1) {
                            descriptionError.style.visibility = "visible";
                        } else {
                            descriptionError.style.visibility = "hidden";
                        }

                        if (amount.value.length < 1) {
                            priceError.style.visibility = "visible";
                        } else {
                            priceError.style.visibility = "hidden";
                        }

                        if (invoiceid.value.length < 1 && invoiceidDiv.style.display === "block") {
                            invoiceidError.style.visibility = "visible";
                        } else {
                            invoiceidError.style.visibility = "hidden";
                        }

                        purchase_units[0].description = description.value;
                        purchase_units[0].amount.value = amount.value;

                        if (invoiceid.value !== '') {
                            purchase_units[0].invoice_id = invoiceid.value;
                        }
                    },

                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: purchase_units,
                        });
                    },

                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(orderData) {

                            // Full available details
                            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                            // Show a success message within this page, e.g.
                            const element = document.getElementById('paypal-button-container');
                            element.innerHTML = '';
                            element.innerHTML = '<h3>Thank you for your payment!</h3>';

                            // Or go to another URL:  actions.redirect('thank_you.html');

                        });
                    },

                    onError: function(err) {
                        console.log(err);
                    }
                }).render('#paypal-button-container');
            }
            initPayPalButton();
        </script>
        <div>
            <a href="clientPayer.php" id="passerCommande" title="Cliquez ici passer la commande">Passer la commande et payez</a>
        </div>
        <p><a id="retourPageArticle" href="client-panier.php" title="Cliquez ici pour retourner à la page des articles">←Retourner au panier</a></p>
    </main>
</body>

</html>