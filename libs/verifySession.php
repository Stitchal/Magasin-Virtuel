<?php
class VerifSession
{
    public function verifConnection(){
        if(isset($_SESSION["nom"]) && isset($_SESSION["prenom"]) && isset($_SESSION["email"])){
            return true;
        }
        return false;
    }

    public function verifPaiementAdmin(){
        if(isset($_SESSION["montantPayer"]) && isset($_SESSION["idProdReappro"])){
            return true;
        }
        return false;
    }

    public function verifPaiementClient(){
        if(isset($_SESSION['panier']) && isset($_SESSION["totalPaiement"])){
            return true;
        }
        return false;
    }


}