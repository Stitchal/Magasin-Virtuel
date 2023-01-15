<?php


class ConnexionDB {

private static $dsn     = "mysql:host=localhost;dbname=magasinvirtuel";
private static $login   = "root";
private static $password  = "";

private static $pdo;
private static $instance_singleton;

public static function getInstance() {
    if(!self::$instance_singleton) {
        self::$instance_singleton = new ConnexionDB();
    }
    return self::$instance_singleton;
}


private function __construct() {
    
    if(!self::$pdo) { 
        self::$pdo = new PDO(self::$dsn, self::$login, self::$password); 
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        //Activer le mode ASSOC pour les résultats du SELECT
        self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    }
    
}

//exécute la requête (modification, création, suppression) mise en paramètre
//
public function execute($sql, $params = null) {
    $sth = self::$pdo->prepare($sql);
    if(is_array($params)) {
        return $sth->execute($params);
    }
    return $sth->execute();			
}
  
//exécute la requête (consultation) mise en paramètre et remplit la matrice résultat
//
public function querySelect($sql, $params = null) {
    $sth = self::$pdo->prepare($sql);
    if(is_array($params)) {
        $sth->execute($params);
    } else {
        $sth->execute();				
    }
    return $sth->fetchAll();
}
}
?>