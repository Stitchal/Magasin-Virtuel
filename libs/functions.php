
<?php

function sendEmail($emailDestinataire, $emailEnvoyeur)
{
    // Remplacez les valeurs entre crochets par vos informations de connexion
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $from = $emailEnvoyeur;
    $to = $emailDestinataire;
    $subject = 'Facture';

    // Remplacez les valeurs entre crochets par les informations de votre facture
    $message = "
    <html>
    <head>
    <title>Facture</title>
    </head>
    <body>
    <p>Voici votre facture :</p>
    <table>
            <tr>
            <td>id</td>
            <td>";
    if ($_SESSION["clientPayer"] == 1) {
        getIDFacturation(getDateAjd(), $_SESSION["nom"]);
        $message .= $_SESSION["idFact"];
    }
    $message .= $_SESSION["idFact"];
    $message .= "</td>
            </tr>
            <tr>
            <td>articles</td>
            <td>";
    $articlesString = "";
    foreach ($_SESSION['panier'] as $clef => $valeur) {
        $articlesString .= $clef . ", ";
    }
    $message .= $articlesString;
    $message .= "</td>
            </tr>
            <tr>
            <td>dateFact</td>
            <td>" . date('d-m-Y') . "</td>
            </tr>
            <tr>
            <td>nomAcheteur</td>
            <td>" . $_SESSION['nom'] . "</td>
            </tr>
            <tr>
            <td>prenomAcheteur</td>
            <td>" . $_SESSION['prenom'] . "</td>
            </tr>
            <tr>
            <td>emailAcheteur</td>
            <td>" . $_SESSION['email'] . "</td>
            </tr>
            <tr>
            <td>prixTotal</td>
            <td>" . $_SESSION["totalPaiement"] . "€</td>
            </tr>
    </table>
    <p>Total : [prix total]</p>
    </body>
    </html>
    ";

    // Headers de l'email
    /*$headers = "From: $from\r\n";
    $headers .= "Content-type: text/html\r\n";*/
    $headers = "From: $from\r\n";

    // Envoi de l'email
    mail($to, $subject, $message, $headers);
    echo "L'email a été envoyé.";
}


function verificationMail($phrase)
{
    $nbPoint = 0;
    $nbHashtag = 0;
    $res = true;

    for ($i = 0; $i < strlen($phrase) and $res; $i++) {
        if ($phrase[$i] == ".") {
            $nbPoint++;
            if ($phrase[$i + 1] == "@" or $phrase[$i + 2] == "@") {
                $res = false;
            }
        } else if ($phrase[$i] == "@") {
            $nbHashtag++;
            if ($phrase[$i + 1] == "." or $phrase[$i + 2] == ".") {
                $res = false;
            }
        } else if ($i == 0) {
            if ($phrase[$i + 1] == "@" or $phrase[$i + 2] == "@") {
                $res = false;
            }
        }
    }
    if ($nbPoint >= 1 and $nbHashtag >= 1 and $res = true) {
        return true;
    }
    return false;
}

function getArticleFacture($string)
{
    $string = rtrim($string);
    if (substr($string, -1) == ',') {
        $string = substr($string, 0, -1);
    }
    $array = explode(', ', $string);
    $finalArray = array();
    foreach ($array as $element) {
        $finalArray[] = explode('_', $element);
    }
    return $finalArray;

}
?>