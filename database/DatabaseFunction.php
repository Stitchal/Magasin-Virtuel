<?php
    
    require_once('Database.php');

    /**
     * script pour faire apparaitre les produits par rapport à ceux de la base de données
     * @return void
     */

    function generateProduct(){
        ConnexionDB::getInstance();
        $sql = "SELECT id FROM produit";
        $result = ConnexionDB::getInstance()->querySelect($sql);
        $nbProduct = count($result);

        for ($i = 1; $i <= $nbProduct; $i++) {
            $nom = "SELECT nom FROM produit WHERE id = $i";
            $result = ConnexionDB::getInstance()->querySelect($nom);

            if ($i % 2 == 1) {
                echo "<tr>";
            }  

            $img = "SELECT image FROM produit WHERE id = $i";
            $res2 = ConnexionDB::getInstance()->querySelect($img);
            print_r($res2[0]['image']);
            $link = "img/".$res2[0]['image'];
            echo $link;
            echo "<td> "; echo "<img src=$link>" ; echo $result[0]['nom'];  echo "</td>";

            if($i % 2 == 0){
                echo "</tr>";
            }

            
        }
    }

    /**
     * script pour ajouter un client dans la base de données
     *
     * @param [String] $nom
     * @param [String] $prenom
     * @param [String] $email
     * @param [String] $password
     * @return void
     */
    function addClient($nom, $prenom, $email, $password){
        ConnexionDB::getInstance();
        $sql = "INSERT INTO client (nom, prenom, email, password) VALUES ($nom, $prenom, $email, $password)";
        ConnexionDB::getInstance()->execute($sql);
    }

    function addFournisseur($nom, $prenom, $email, $password){
        ConnexionDB::getInstance();
        $sql = "INSERT INTO fournisseur (nom, prenom, email, password) VALUES ($nom, $prenom, $email, $password)";
        ConnexionDB::getInstance()->execute($sql);
    }

    function addProduct($nom, $description, $prix, $image){
        ConnexionDB::getInstance();
        $sql = "INSERT INTO produit (nom, description, prix, image) VALUES ($nom, $description, $prix, $image)";
        ConnexionDB::getInstance()->execute($sql);
    }


    /**
     * Vérifie si le client existe dans la base de données
     *
     * @param [type] $email
     * @param [type] $nom
     * @param [type] $prenom
     * @return boolean
     */
    function checkClientExistant($email, $nom, $prenom){
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
        }
        else{
            return true;
        }
    }

    function createClient($nom, $prenom, $email, $password){
        ConnexionDB::getInstance();
        $sql = "INSERT INTO client (nom, prenom, mail, mdp) VALUES (:nom, :prenom, :mail, :mdp)";
        $params = array(
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':mail' => $email,
            ':mdp' => $password
        );
        ConnexionDB::getInstance()->execute($sql, $params);
    }

    function addProductPanier($nom){
        $_SESSION[$nom] += 1;
    }

    //TODO -> corriger la fonction en concordance avec la base de données
    function checkStockProduct($productName, $number){
        ConnexionDB::getInstance();
        $sql = "SELECT stock FROM produit WHERE nom = :nom";
        $params = array(
            ':nom' => $productName
        );

        $result = ConnexionDB::getInstance()->querySelect($sql, $params);
        if ($result[0]['stock'] >= $number) {
            return true;
        }
        else{
            return false;
        }
    }

    function checkAdmin($nom){
        ConnexionDB::getInstance();
        $sql = "SELECT isAdmin FROM client WHERE nom = :nom";
        $params = array(
            ':nom' => $nom
        );
        $result = ConnexionDB::getInstance()->querySelect($sql, $params);
        echo "resultat fonction check admin : ";
        echo $result[0];
        if($result == '1'){
            return true;
        }
        return false;
    }

    

    






?>