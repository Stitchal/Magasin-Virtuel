<?php
function sendEmail($emailDestinataire, $emailEnvoyeur)
{
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $from = $emailEnvoyeur;
    $to = $emailDestinataire;
    $subject = 'Facture';

    $verify = new Verification();
    $facture = getFacture($_SESSION["idFact"]);
    $articles = $verify->getArticleFacture($facture['articles']);
    $message = "";
    
    $message .= "<html>
                    <head>
                        <meta charset='UTF-8'>
                        <link rel='stylesheet' href='../css/style.css'>
                        <link rel='stylesheet' href='../css/responsive.css'>
                        <title>Facture</title>
                        <style>
                            * {
                                margin : 0px;
                                padding: 0px;
                                font-family:'Trebuchet MS';
                                font-size: medium;
                            }
                            
                            body {
                                width: 100%;
                            }
                            
                            
                            main{
                                background-color: white;
                                width: 60%;
                            }
                            table.facture{
                                background-color: #FAFAFA;
                                border-radius: 2em;
                            }
                            
                            .divFacture{
                                background-color: rgb(241, 241, 241);
                                border: 1px solid #212529;
                                padding: 2%;
                                margin-bottom: 10%;
                            }
                            
                            table.facture tr td{
                                background-color: rgb(241, 241, 241);
                                background-color: none;
                                padding: 1% 1% 0% 1%;
                                text-align: left;
                                padding-bottom: 1%;
                                border-bottom: 1px solid rgb(207, 207, 207);
                                margin: 1% 0 0 0;
                                width: 48%;
                            }
                            
                            table.facture tbody{
                                background-color: rgb(241, 241, 241);
                                border-radius: 5em;
                            }
                            table.facture tr td{
                                width: 10%;
                            }
                            
                            table.clientFacture{
                                margin-top: 5%;
                                border-collapse: collapse;
                                width: 50%;
                                margin-right: 50%;
                            
                            }
                            
                            table.clientFacture tr{
                                border-collapse: collapse;
                                border-bottom: 1px solid #CFCFCF;
                                width: 50%;
                            
                            }
                            
                            table.clientFacture tr td{
                                background-color: transparent;
                                text-align: left;
                                width: 20%;
                                margin: 0;
                            }
                            
                            table.clientFacture tr td:first-child{
                                font-weight: bold;
                            }
                            
                            table.totalFacture{
                                margin-top: 10%;
                                width: 30%;
                                margin-left: 75%;
                            }
                            
                            table.totalFacture tr{
                                border-collapse: collapse;
                            }
                            
                            table.totalFacture tr td{
                                margin: 0;
                                text-align: left;
                            }
                            
                            .divFacture > h3{
                                font-size: x-large;
                            }
                            
                            table.facture{
                                margin-top: 10%;
                            }
                            
                            table.facture tr:first-child td{
                                background-color: #dfdfdf;
                                font-weight: bold;
                            }
                            
                            table.facture tr:first-child{
                                border-top: 1px solid black;
                            }
                        </style>
                    </head>
                    <body>
                        <main>
                            <div class='divFacture'>
                                <h3>Facture N°".$facture["id"]."</h3>
                                    <table class ='clientFacture'>
                                        <tbody>
                                            <tr>
                                                <td>Nom</td>
                                                <td>" . $facture['nomAcheteur'] . "</td>
                                            </tr>
                                            <tr>
                                                <td>Prénom</td>
                                                <td>" . $facture['prenomAcheteur'] . "</td>
                                            </tr>
                                            <tr>
                                                <td>Adresse mail</td>
                                                <td>" . $facture['emailAcheteur'] . "</td>
                                            </tr>
                                            <tr>
                                                <td>Référence de la facture</td>
                                                <td>".$facture["id"]."</td>
                                            </tr>
                                            <tr>
                                                <td>Date-heure de la création</td>
                                                <td>".$facture["dateFact"]."</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class='facture'>
                                        <tbody>
                                            <tr>
                                                <td>Produit</td>
                                                <td>Quantité</td>
                                                <td>Prix unitaire HT</td>
                                                <td>TVA %</td>
                                                <td>Total TVA</td>
                                                <td>Total TTC</td>
                                            </tr>";

            $totalHT = 0;
            $totalTVA = 0;
            $totalTTC = 0;
            foreach ($articles as $article) {
                $nomProduit = getNameProduct($article[0]);
                $quantite = ltrim($article[1]);
                $prixHT = $article[2];
                $totalProduitTVA = $prixHT * 0.2;
                $totalProduitTTC = ($prixHT * $quantite) * 1.20;
                $totalTVA += $totalProduitTVA*$quantite;
                $message .=
                                            "<tr>
                                                <td>".$nomProduit."</td>
                                                <td>".$quantite."</td>
                                                <td>".$prixHT." €</td>
                                                <td>".$facture["TVA"]." %</td>
                                                <td>".$totalProduitTVA." €</td>
                                                <td>".$totalProduitTTC." €</td>
                                            </tr>";
            }
            $message .= 
                                    "</tbody>
                                </table>";
                    $message .= "<table class='totalFacture'>
                            <tbody>
                                <tr>
                                    <td><b>Total HT</b></td>
                                    <td><b>".$facture["prixHT"]." €</b></td>
                                </tr>
                                <tr>
                                    <td><b>Total TVA</b></td>
                                    <td><b>".$totalTVA." €</b></td>
                                </tr>
                                <tr>
                                    <td><b>Total TTC</b></td>
                                    <td><b>".$facture["prixTTC"]." €</b></td>
                                </tr>
                            </tbody>
                        </table>";
            $message .= "
                    </div>
                </main>
            </body>
        </html>";

    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: <".$from.">";

    mail($to, $subject, $message, implode("\r\n", $headers));
    echo "L'email a été envoyé.";
}

?>