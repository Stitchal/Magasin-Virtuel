<?php


    /**
     * script pour faire apparaitre les produits par rapport à ceux de la base de données
     * @return void
     */

    function generateProduct(){
        ConnexionDB::getInstance();
        $sql = "SELECT id FROM product";
        $result = ConnexionDB::getInstance()->querySelect($sql);
        $nbProduct = count($result);

        for ($i = 1; $i <= $nbProduct; $i++) {
            $nom = "SELECT nom FROM product WHERE id = $i";
            $result = ConnexionDB::getInstance()->querySelect($nom);

            if ($i % 2 == 1) {
                echo "<tr>";
            }
            else{
                echo "</tr>";
            }
            
            echo "<td> $nom </td>";
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
     * @param [type] $mdp
     * @return boolean
     */
    function checkClientExistant($email, $mdp){
        ConnexionDB::getInstance();
        $sql = "SELECT * FROM client WHERE email = $email AND password = $mdp";
        $result = ConnexionDB::getInstance()->querySelect($sql);
        if (count($result) == 0) {
            return false;
        }
        else{
            return true;
        }
    }

    

    






?>