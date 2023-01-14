<?php

require_once('Database.php');



function addFournisseur($nom, $prenom, $email, $password)
{
    ConnexionDB::getInstance();
    $sql = "INSERT INTO fournisseur (nom, prenom, email, password) VALUES ($nom, $prenom, $email, $password)";
    ConnexionDB::getInstance()->execute($sql);
}

function addProduct($id, $nom, $prixPublic, $prixAchat, $taille, $couleur, $refMarque, $titre, $icone = "default.png", $image = "default.png")
{
    ConnexionDB::getInstance();

    $sql = "INSERT INTO produit (id, nom, prixPublic, prixAchat, taille, couleur, refMarque, titre, icone, image) VALUES
        (:id, :nom, :prixPublic, :prixAchat, :taille, :couleur, :marqueId, :titre, :icone, :image)";
    $params = array(
        ':id' => strval($id),
        ':nom' => strval($nom),
        ':prixPublic' => strval($prixPublic),
        ':prixAchat' => strval($prixAchat),
        ':taille' => strval($taille),
        ':couleur' => strval($couleur),
        ':marqueId' => strval($refMarque),
        ':titre' => strval($titre),
        ':icone' => strval($icone),
        ':image' => strval($image)
    );
    ConnexionDB::getInstance()->execute($sql, $params);
}




/**
 * Vérifie si le client existe dans la base de données
 *
 * @param [type] $email
 * @param [type] $nom
 * @param [type] $prenom
 * @return boolean
 */
function checkClientExistant($email, $nom, $prenom)
{
    ConnexionDB::getInstance();
    $sql = "SELECT id FROM client WHERE mail = :mail AND nom = :nom AND prenom = :prenom";
    $params = array(
        ':mail' => $email,
        ':nom' => $nom,
        ':prenom' => $prenom
    );

    $result = ConnexionDB::getInstance()->querySelect($sql, $params);
    if (count($result) == 0) {
        return false;
    } else {
        return true;
    }
}

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



function addProductPanier($nom)
{
    $_SESSION[$nom] += 1;
}

//TODO -> corriger la fonction en concordance avec la base de données
function checkStockProduct($id, $number)
{
    ConnexionDB::getInstance();
    $sql = "SELECT quantite FROM gestion_stock WHERE id = :id";
    $params = array(
        ':id' => $id
    );

    $result = ConnexionDB::getInstance()->querySelect($sql, $params);
    if ($result[0]['quantite'] >= $number) {
        return true;
    } else {
        return false;
    }
}

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




function checkAdmin($nom)
{
    ConnexionDB::getInstance();
    $sql = "SELECT isAdmin FROM client WHERE nom = :nom";
    $params = array(
        ':nom' => $nom
    );
    $result = ConnexionDB::getInstance()->querySelect($sql, $params);
    if ($result[0]['isAdmin'] == '1') {
        return true;
    }
    return false;
}

function deleteElement($id, $nomTable)
{
    $db = ConnexionDB::getInstance();
    $sql = "DELETE FROM $nomTable WHERE id = :id";
    $params = array(
        ':id' => $id
    );
    $db->execute($sql, $params);
}

function verifyCritere($i, $critere)
{
    if ($critere == "") {
        return true;
    }

    $db = ConnexionDB::getInstance();
    $sql = "SELECT nom FROM produit WHERE id = :id";
    $params = array(
        ':id' => $i
    );
    $result = $db->querySelect($sql, $params);

    if (strpos($result[0]['nom'], $critere) === false)
        return false;
    else
        return true;
}


/**
 * Retourne l'id d'un produit
 *
 * @param [type] $nom
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


function getNameProduct($id)
{
    ConnexionDB::getInstance();
    $sql = "SELECT nom FROM produit WHERE id = :id";
    $params = array(
        ':id' => $id
    );
    $result = ConnexionDB::getInstance()->querySelect($sql, $params);
    return $result[0]['nom'];
}


/**
 * Retourne le prix public d'un produit
 *
 * @param [type] $nom
 * @return integer
 */
function getPrixArticle($nom): int
{
    $requetePrix = "SELECT prixPublic FROM produit WHERE nom = '$nom'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requetePrix);
    $prix = $resRequete[0]['prixPublic'];
    return $prix;
}

function getIDFacturation($datetime, $nom): String
{
    $requeteIDFacturation = "SELECT id FROM facturation WHERE dateFact = '$datetime' AND nomAcheteur = '$nom'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requeteIDFacturation);
    $IDFacturation = $resRequete[0]['id'];
    return $IDFacturation;
}


/**
 * Cree une facturation dans la BDD
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

function getDateAjd()
{
    $requeteDate = "SELECT CURRENT_TIMESTAMP;";
    $resRequete = ConnexionDB::getInstance()->querySelect($requeteDate);
    $date = $resRequete[0]['CURRENT_TIMESTAMP'];
    return $date;
}

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

function getIdFacturesFrom($nom)
{
    $requeteFacture = "SELECT id FROM facturation WHERE nomAcheteur = '$nom'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requeteFacture);
    $ids = [];
    foreach ($resRequete as $row) {
        $ids[] = $row['id'];
    }
    return $ids;
}

function getFacture($id)
{
    $requeteFacture = "SELECT * FROM facturation WHERE id = '$id'";
    $resRequete = ConnexionDB::getInstance()->querySelect($requeteFacture);
    return $resRequete[0];
}

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

function updateComptabiliteVente($montantTransaction, $listeProd){
    $date = date('Y');
    $articlesString = "";
    foreach ($listeProd as $clef => $valeur) {
        $idProd = getIDProduct($clef);
        $prix = getPrixArticle($clef);
        $articlesString .= $idProd . "_ ";
        $articlesString .= $valeur . "_";
        $articlesString .= $prix . ", ";
    }
    $db = ConnexionDB::getInstance();
    $sql = "UPDATE comptabilite SET montantVentes = montantVentes + ':montantTransaction', chiffreAffaire = montantVentes + montantAchats, ventes = CONCAT(ventes, ':listeProd') WHERE annee=':annee'";
    $params = array(
        ':montantTransaction' => $montantTransaction,
        ':annee' => $date,
        ':listeProd' => $articlesString
    );
    $db->execute($sql, $params);

}

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
    $sql = "INSERT INTO comptabilite (ventes, montantVentes, chiffreAffaire, annee) VALUES
        (:ventes, :montantVentes, :chiffreAffaire, :annee)";
    $params = array(
        ':ventes' => $articlesString,
        ':montantVentes' => $montantTransaction,
        ':chiffreAffaire' => $montantTransaction,
        ':annee' => $date
    );

    $db->execute($sql, $params);
}

