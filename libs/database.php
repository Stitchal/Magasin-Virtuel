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
        self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    }
    
}

//execute la requete (modification, creation, suppression) mise en parametre
public function execute($sql, $params = null) {
    $sth = self::$pdo->prepare($sql);
    if(is_array($params)) {
        return $sth->execute($params);
    }
    return $sth->execute();			
}
  
//execute la requete (consultation) mise en parametre et remplit la matrice resultat
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