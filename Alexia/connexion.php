<?php

$connexion = null;

function connect(){

    require_once 'config.php';

    try{
        $connexion = new PDO("mysql:host=". $dbHost . ";dbname=" . $dbName, $dbUser, $dbUserPw);
    }
    catch(Exception $e){
        die('Erreur: '. $e->getMessage());
    }
    return $connexion;
}
?>