<?php

require_once('database.php');


/**
 * Ajoute un fournisseur à la BDD
 *
 * @param [type] $nom
 * @param [type] $prenom
 * @param [type] $email
 * @param [type] $password
 * @return boolean
 */
function addFournisseur($nom, $prenom, $email, $password)
{
    ConnexionDB::getInstance();
    $sql = "INSERT INTO fournisseur (nom, prenom, email, password) VALUES ($nom, $prenom, $email, $password)";
    ConnexionDB::getInstance()->execute($sql);
}

/**
 * Ajoute un produit à la BDD
 *
 * @param [type] $id
 * @param [type] $nom
 * @param [type] $prixPublic
 * @param [type] $prixAchat
 * @param [type] $taille
 * @param [type] $couleur
 * @param [type] $refMarque
 * @param [type] $titre
 * @return boolean
 */
function addProduct($nom, $prixPublic, $prixAchat, $taille, $couleur, $refMarque, $titre, $icone = "default.png", $image = "default.png", $description = "pas de description")
{
    ConnexionDB::getInstance();

    $sql = "INSERT INTO produit (nom, prixPublic, prixAchat, taille, couleur, refMarque, titre, icone, image, description) VALUES
        (:nom, :prixPublic, :prixAchat, :taille, :couleur, :marqueId, :titre, :icone, :image, :description)";
    $params = array(
        ':nom' => strval($nom),
        ':prixPublic' => strval($prixPublic),
        ':prixAchat' => strval($prixAchat),
        ':taille' => strval($taille),
        ':couleur' => strval($couleur),
        ':marqueId' => strval($refMarque),
        ':titre' => strval($titre),
        ':icone' => strval($icone),
        ':image' => strval($image),
        ':description' => strval($description)
    );
    ConnexionDB::getInstance()->execute($sql, $params);
}

/**
 * Vérifie si le client existe dans la base de données
 *
 * @param [type] $email
 * @param [type] $mdp
 * @return boolean
 */
function checkClientExistant($email, $mdp)
{
    ConnexionDB::getInstance();
    $sql = "SELECT id FROM client WHERE mail = :mail AND mdp = :mdp";
    $params = array(
        ':mail' => $email,
        ':mdp' => $mdp
    );

    $result = ConnexionDB::getInstance()->querySelect($sql, $params);
    if (count($result) == 0) {
        return false;
    } else {
        return true;
    }
}

/**
 * Insere client dans BDD
 *
 * @param [string] $nom
 * @param [string] $prenom
 * @param [string] $email
 * @param [string] $password
 * @param [int] $isAdmin
 * @return void
 */
function createClient($nom, $prenom, $email, $password, $isAdmin = 0)
{
    ConnexionDB::getInstance();
    $sql = "INSERT INTO client (nom, prenom, mail, mdp, isAdmin) VALUES (:nom, :prenom, :mail, :mdp, :isAdmin)";
    $params = array(
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':mail' => $email,
        ':mdp' => $password,
        ':isAdmin' => $isAdmin
    );
    ConnexionDB::getInstance()->execute($sql, $params);
}

/**
 * Insere fournisseur dans BDD
 *
 * @param [string] $nomEntreprise
 * @param [string] $email
 * @param [string] $mdp
 * @param [string] $infos
 * @return void
 */
function createFournisseur($nomEntreprise, $mail, $mdp, $infos){
    ConnexionDB::getInstance();
    $sql = "INSERT INTO fournisseur (nomEntreprise, mail, mdp, infos) VALUES (:nomEntreprise, :mail, :mdp, :infos)";
    $params = array(
        ':nomEntreprise' => $nomEntreprise,
        ':mail' => $mail,
        ':mdp' => $mdp,
        ':infos' => $infos,
    );
    ConnexionDB::getInstance()->execute($sql, $params);
}

/**
 * Insere marque dans BDD
 *
 * @param [string] $nomMarque
 * @return void
 */
function createMarque($nomMarque){
    ConnexionDB::getInstance();
    $sql = "INSERT INTO marque (nom) VALUES (:nomMarque)";
    $params = array(
        ':nomMarque' => $nomMarque,
    );
    ConnexionDB::getInstance()->execute($sql, $params);
}

/**
 * Insere gestion_stock dans BDD
 *
 * @param [string] $refProduit
 * @param [string] $refFournisseur
 * @param [string] $quantite
 * @return void
 */
function createGestionStock($refProduit, $refFournisseur, $quantite){
    ConnexionDB::getInstance();
    $sql = "INSERT INTO gestion_stock (refProduit, refFournisseur, quantite) VALUES (:refProduit, :refFournisseur, :quantite)";
    $params = array(
        ':refProduit' => $refProduit,
        ':refFournisseur' => $refFournisseur,
        ':quantite' => $quantite,
    );
    ConnexionDB::getInstance()->execute($sql, $params);
}

/**
 * Insere facturation dans BDD
 *
 * @param [string] $articles
 * @param [string] $nom
 * @param [string] $prenom
 * @param [string] $email
 * @param [int] $prixHT
 * @param [int] $TVA
 * @return void
 */
function createFacturation($articles, $nom, $prenom, $email, $prixHT, $TVA){
    ConnexionDB::getInstance();
    $dateFact = getDateAjd();
    $sql = "INSERT INTO facturation (articles, nomAcheteur, prenomAcheteur, dateFact, emailAcheteur, prixHT, prixTTC, TVA) VALUES (:articles, :nomAcheteur, :prenomAcheteur, :dateFact, :emailAcheteur, :prixHT, :prixTTC, :TVA)";
    $params = array(
        ':articles' => $articles,
        ':nomAcheteur' => $nom,
        ':prenomAcheteur' => $prenom,
        ':dateFact' => getDateAjd(),
        ':emailAcheteur' => $email,
        ':prixHT' => $prixHT,
        ':prixTTC' => $prixHT + ($prixHT * ($TVA/100)),
        ':TVA' => $TVA,
    );
    ConnexionDB::getInstance()->execute($sql, $params);
}

/**
 * Verifie si la quantite est disponible
 *
 * @param [string] $idGestionStock
 * @param [int] $quantite
 * @return boolean
 */
function checkStockProduct($id, $number)
{
    ConnexionDB::getInstance();
    $sql = "SELECT quantite FROM gestion_stock WHERE refProduit = :id";
    $params = array(
        ':id' => $id
    );

    $result = ConnexionDB::getInstance()->querySelect($sql, $params);
    $nb = $result[0]['quantite'];
    if ($nb >= $number) {
        return true;
    } else {
        return false;
    }
}

/**
 * Obtiens quantite produit
 *
 * @param [int] $idGestionStock
 * @return int
 */
function getStockProduct($id)
{
    ConnexionDB::getInstance();
    $sql = "SELECT quantite FROM gestion_stock WHERE refProduit = :id";
    $params = array(
        ':id' => $id
    );
    $result = ConnexionDB::getInstance()->querySelect($sql, $params);
    return $result[0]['quantite'];
}

/**
 * Verifie si client est admin
 *
 * @param [string] $nom
 * @param [string] $prenom
 * @param [string] $mail
 * @return boolean
 */
function checkAdmin($nom, $prenom, $mail)
{
    ConnexionDB::getInstance();
    $sql = "SELECT isAdmin FROM client WHERE nom = :nom AND prenom = :prenom AND mail = :mail";
    $params = array(
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':mail' => $mail

    );
    $result = ConnexionDB::getInstance()->querySelect($sql, $params);
    if ($result[0]['isAdmin'] == '1') {
        return true;
    }
    return false;
}

/**
 * Supprime element dans table demandee
 *
 * @param [int]] $idElement
 * @param [string] $nomTable
 * @return void
 */
function deleteElement($id, $nomTable)
{
    $db = ConnexionDB::getInstance();

    if($nomTable == "produit"){
        $sql = "DELETE FROM gestion_stock WHERE refProduit = :id";
        $params = array(
            ':id' => $id
        );
        $db->execute($sql, $params);
    }

    if($nomTable == "fournisseur"){
        $sql = "DELETE FROM gestion_stock WHERE refFournisseur = :id";
        $params = array(
            ':id' => $id
        );
        $db->execute($sql, $params);
    }

    if($nomTable == "marque"){
        $sql = "DELETE FROM produit WHERE refMarque = :id";
        $params = array(
            ':id' => $id
        );
        $db->execute($sql, $params);
    }

    $sql = "DELETE FROM $nomTable WHERE id = :id";
    $params = array(
        ':id' => $id
    );
    $db->execute($sql, $params);
}

/**
 * Vérifie si le critère de recherche est présent dans le nom du produit
 * 
 * @param [integer] $idProduit
 * @param [string] $critere
 * 
 * @return boolean
 */
function verifyCritere($idProduit, $critere)
{
    if ($critere == "") {
        return true;
    }

    $db = ConnexionDB::getInstance();
    $sql = "SELECT nom FROM produit WHERE id = :id";
    $params = array(
        ':id' => $idProduit
    );
    $result = $db->querySelect($sql, $params);

    if (strpos($result[0]['nom'], $critere) === false)
        return false;
    else
        return true;
}


/**
 * Retourne l'id d'un produit à partir de son nom
 *
 * @param [string] $nom
 * @return integer
 */
function getIDProduct($nom)
{
    ConnexionDB::getInstance();
    $sql = "SELECT id FROM produit WHERE nom = :nom";
    $params = array(
        ':nom' => $nom
    );
    $result = ConnexionDB::getInstance()->querySelect($sql, $params);
    return $result[0]['id'];
}

/**
 * Retourne le nom d'un produit à partir de son id
 * 
 * @param [int] $id
 * @return string
 */
function getNameProduct($id): string
{
    ConnexionDB::getInstance();
    $sql = "SELECT nom FROM produit WHERE id = :id";
    $params = array(
        ':id' => $id
    );
    $result = ConnexionDB::getInstance()->querySelect($sql, $params);
    if(is_null($result[0]['nom'])){
        return "Article n'existant plus";
    } 
    return $result[0]['nom'];
}


/**
 * Retourne le prix libs d'un produit
 *
 * @param [string] $nom
 * @return integer
 */
function getPrixArticle($nom): float
{
    $requetePrix = "SELECT prixPublic FROM produit WHERE nom = '$nom'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requetePrix);
    $prix = $resRequete[0]['prixPublic'];
    return $prix;
}

/**
 * Retourne l'id d'une facturation à partir de sa date et du nom de l'acheteur
 *
 * @param [type] $datetime
 * @param [string] $nom
 * @return string
 */
function getIDFacturation($datetime, $nom): String
{
    $requeteIDFacturation = "SELECT id FROM facturation WHERE dateFact = '$datetime' AND nomAcheteur = '$nom'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requeteIDFacturation);
    $IDFacturation = $resRequete[0]['id'];
    return $IDFacturation;
}


/**
 * Cree une facturation dans la BDD suivant les paramètres donnés
 *
 * @param [String] $nomAcheteur
 * @param [String] $prenomAcheteur
 * @param [String] $emailAcheteur
 * @param [int] $prixTotal
 * @return void
 */
function generateFacturation($articles, $nomAcheteur, $prenomAcheteur, $emailAcheteur, $prixTotal): void
{
    ConnexionDB::getInstance();
    $sql = "INSERT INTO facturation (articles, dateFact, nomAcheteur, prenomAcheteur, emailAcheteur, prixHT, prixTTC, TVA) VALUES
        (:articles, :dateFact, :nomAcheteur, :prenomAcheteur, :emailAcheteur, :prixHT, :prixTTC, :TVA)";
    $articlesString = "";

    foreach ($articles as $clef => $valeur) {
        $idProd = getIDProduct($clef);
        $prix = getPrixArticle($clef);
        $articlesString .= $idProd . "_ ";
        $articlesString .= $valeur . "_";
        $articlesString .= $prix . ", ";
    }
    $TVA = 0.20;
    $prixTTC = $prixTotal + $prixTotal * $TVA;


    $params = array(
        ':articles' => strval($articlesString),
        ':dateFact' => getDateAjd(),
        ':nomAcheteur' => strval($nomAcheteur),
        ':prenomAcheteur' => strval($prenomAcheteur),
        ':emailAcheteur' => strval($emailAcheteur),
        ':prixHT' => strval($prixTotal),
        ':prixTTC' => $prixTTC,
        ':TVA' => $TVA*100

    );

    ConnexionDB::getInstance()->execute($sql, $params);
}

/**
 * Retourne la date actuelle
 *
 * @return string
 */
function getDateAjd()
{
    $requeteDate = "SELECT CURRENT_TIMESTAMP;";
    $resRequete = ConnexionDB::getInstance()->querySelect($requeteDate);
    $date = $resRequete[0]['CURRENT_TIMESTAMP'];
    return $date;
}

/**
 * Vérifie si un client possède des factures à son nom
 * 
 * @param [string] $nomClient
 * @return boolean
 */
function checkClientCommande($nomClient)
{
    $requetePrix = "SELECT COUNT(id) FROM facturation WHERE nomAcheteur = '$nomClient'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requetePrix);
    $res = $resRequete[0]['COUNT(id)'];
    if ($res > 0) {
        return true;
    }
    return false;
}

/**
 * Retourne un tableau contenant les id des factures d'un client
 *
 * @param [string] $nomClient
 * @return array
 */
function getIdFacturesFrom($nomClient)
{
    $requeteFacture = "SELECT id FROM facturation WHERE nomAcheteur = '$nomClient'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requeteFacture);
    $ids = [];
    foreach ($resRequete as $row) {
        $ids[] = $row['id'];
    }
    return $ids;
}

/**
 * Retourne un tableau contenant les informations d'une facture à partir de son id
 *
 * @param [int] $id
 * @return array
 */
function getFacture($id)
{
    $requeteFacture = "SELECT * FROM facturation WHERE id = '$id'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requeteFacture);
    return $resRequete[0];
}

/**
 * Vérifie si une comptabilité pour l'année actuelle existe
 * 
 * @return boolean
 */
function checkComptabilite(){
    $date = date('Y');
    $requeteComptabilite = "SELECT COUNT(id) FROM comptabilite WHERE annee = '$date'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requeteComptabilite);
    $res = $resRequete[0]['COUNT(id)'];
    if ($res > 0) {
        return true;
    }
    return false;

}

/**
 * Modifie la comptabilité de l'année actuelle
 * 
 * @param [int] $montantTransaction
 * @param [array] $listeProd
 * @return void
 */
function updateComptabiliteVente($montantTransaction, $listeProd){
    $date = date('Y');
    $db = ConnexionDB::getInstance();
    $articlesString = "";
    foreach ($listeProd as $clef => $valeur) {
        $idProd = getIDProduct($clef);
        $prix = getPrixArticle($clef);
        $articlesString .= $idProd . "_ ";
        $articlesString .= $valeur . "_";
        $articlesString .= $prix . ", ";
    }
    $ancienneVente = getVentesComptabilite($date);
    $nvVente = $ancienneVente . ";" . $articlesString;
    $sql = "UPDATE comptabilite SET montantVentes = montantVentes + :montantTransaction, chiffreAffaire = chiffreAffaire + :montantTransaction, ventes = :listeProd  WHERE annee=:annee";
    $params = array(
        ':montantTransaction' => $montantTransaction,
        ':annee' => strval($date),
        ':listeProd' => $nvVente
    );
    $db->execute($sql, $params);

}

function updateComptabiliteAchat($montantTransaction){
    $date = date('Y');
    $db = ConnexionDB::getInstance();
    $sql = "UPDATE comptabilite SET montantAchats = montantAchats + :montantTransaction, chiffreAffaire = chiffreAffaire - :montantTransaction WHERE annee=:annee";
    $params = array(
        ':montantTransaction' => $montantTransaction,
        ':annee' => strval($date)
    );
    $db->execute($sql, $params);

}

function updateGestionStock($articles){
    $db = ConnexionDB::getInstance();
    foreach ($articles as $clef => $valeur) {
        $idProd = getIDProduct($clef);
        $prix = getPrixArticle($clef);
        $sql = "UPDATE gestion_stock SET quantite = quantite - :valeur WHERE refProduit=:id";
        $params = array(
            ':valeur' => $valeur,
            ':id' => $idProd
        );
        $db->execute($sql, $params);
    }
}

function augmenteStock($idArticle, $quantite){
    $db = ConnexionDB::getInstance();
        $sql = "UPDATE gestion_stock SET quantite = quantite + :valeur WHERE refProduit=:id";
        $params = array(
            ':valeur' => $quantite,
            ':id' => $idArticle
        );
        $db->execute($sql, $params);
    }

/**
 * Récupère les ventes de la comptabilité de l'année actuelle
 * 
 * @param [int] $annee
 * @return string
 */
function getVentesComptabilite($annee){
    $requeteComptabilite = "SELECT ventes FROM comptabilite WHERE annee = '$annee'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requeteComptabilite);
    return $resRequete[0]['ventes'];
}

/**
 * Crée une comptabilité pour l'année actuelleCrée une comptabilité pour l'année actuelle
 */
function createComptabiliteVente($montantTransaction, $listeProd){
    $date = date('Y');
    $db = ConnexionDB::getInstance();
    $articlesString = "";
    foreach ($listeProd as $clef => $valeur) {
        $idProd = getIDProduct($clef);
        $prix = getPrixArticle($clef);
        $articlesString .= $idProd . "_ ";
        $articlesString .= $valeur . "_";
        $articlesString .= $prix . ", ";
    }
    $montantAchat = 0;
    $sql = "INSERT INTO comptabilite (ventes, montantVentes, chiffreAffaire, montantAchats, annee) VALUES
        (:ventes, :montantVentes, :chiffreAffaire, :montantAchats, :annee)";
    $params = array(
        ':ventes' => $articlesString,
        ':montantVentes' => $montantTransaction,
        ':chiffreAffaire' => $montantTransaction,
        ':montantAchats' => $montantAchat,
        ':annee' => $date
    );

    $db->execute($sql, $params);
}

/**
 * Creer une comptabilite pour un achat
 *
 * @param [string] $montantTransaction
 * @return void
 */
function createComptabiliteAchat($montantTransaction){
    $date = date('Y');
    $montantVentes = 0;
    $ventes = "";
    $db = ConnexionDB::getInstance();
    $sql = "INSERT INTO comptabilite (montantAchats, chiffreAffaire, annee, montantVentes, ventes) VALUES
        (:montantAchats, :chiffreAffaire, :annee, :montantVentes, :ventes)";
    $params = array(
        ':ventes' => $ventes,
        ':montantAchats' => $montantTransaction,
        ':chiffreAffaire' => -$montantTransaction,
        ':annee' => $date,
        ':montantVentes' => $montantVentes,
        ':ventes' => $ventes
    );

    $db->execute($sql, $params);
}

/**
 * Retourne la liste des produits qui ne sont plus en stock
 *
 * @return string
 */
function getProductUnavailable(){
    $result = ConnexionDB::getInstance()->querySelect("SELECT refProduit FROM gestion_stock WHERE quantite = 0");
    
    $StringRésultat = "";
    foreach($result as $subArray) {
    $refProduit = $subArray["refProduit"];
    $StringRésultat .= getNameProduct($refProduit);
    $StringRésultat .= ", ";
    }
    return $StringRésultat;
}

/**
 * Retourne l'id du fournisseur depuis un id de gestion_stock
 *
 * @param [string] $idGestionStocl
 * @return int
 */
function getFournisseur($idGestionStock){
    $requeteGestionStock = "SELECT refFournisseur FROM gestion_stock WHERE id = '$idGestionStock'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requeteGestionStock);
    $fournisseurID = $resRequete[0]['refFournisseur'];

    $requeteFournisseur = "SELECT nomEntreprise FROM fournisseur WHERE id = '$fournisseurID'";
    $res = ConnexionDB::getInstance()->querySelect($requeteFournisseur);
    return$res[0]['nomEntreprise'];
}


/**
 * Retourne le prix d'un article depuis l'idée de gestion_stock
 *
 * @param [string] $idGestionStock
 * @return integer
 */
function getPrixArticleGestion($idGestionStock){
    $requeteGestionStock = "SELECT refProduit FROM gestion_stock WHERE id = '$idGestionStock'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requeteGestionStock);
    $produitID = $resRequete[0]['refProduit'];
    $requeteFournisseur = "SELECT prixAchat FROM produit WHERE id = '$produitID'";
    $res = ConnexionDB::getInstance()->querySelect($requeteFournisseur);
    return $res[0]['prixAchat'];

}

/**
 * Retourne toutes les infos d'un produit
 *
 * @param [string] $nomProduit
 * @return array
 */
function getInfoProd($nomProduit){
    $requete = "SELECT * FROM produit WHERE nom = '$nomProduit'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requete);
    return $resRequete[0];
}

/**
 * Retourne toutes les infos d'un client
 *
 * @param [string] $mailClient
 * @param [string] $mdpClient
 * @return array
 */
function getInfoClient($mail, $mdp){
    $requete = "SELECT * FROM client WHERE mail = '$mail' AND mdp = '$mdp'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requete);
    return $resRequete[0];
}



