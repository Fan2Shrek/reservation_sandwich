<?php

$connection = null;

function connect(){

    require_once 'config.php';

    try{
        $connection = new PDO("mysql:host=". $dbHost . ";dbname=" . $dbName, $dbUser, $dbUserPw);
    }
    catch(Exception $e){
        die('Erreur: '. $e->getMessage());
    }
    return $connection;
}
?>