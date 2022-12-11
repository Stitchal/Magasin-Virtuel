<?php
/*
// Create connection
function connexionBDD_MySQLi(){
    $servername = "134.59.22.40";
    $username = "S3T_ra103059";
    $password = "ra103059";
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
}


function connexionBDD_PDO(){
    $servername = "134.59.22.40";
    $username = "S3T_ra103059";
    $password = "ra103059";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=TDINFO", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }
}*/


function connexionBDD_PDO_OCI(){
    $param = $_POST;
    $db_username = "S3T_ra103059";
    $db_password = "ra103059";
    $db = "mysql:host=localhost;port=5432;dbname=alexis.rosset06@etu.unice.fr";
    $conn = new PDO($db,$db_username,$db_password);
    $name = $param['module'];
    $file = $param['file'];
    $stmt = $conn->exec("INSERT INTO AL_MODULE (AL_MODULENAME, AL_MODULEFILE) VALUES ('$name', '$file')");
}
?>