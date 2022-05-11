<?php

/* fonction connexion à la base de donnée (PDO) */

function connect()
{
    require('config.php');

    try
    {
        $co = new PDO("mysql:host=" . $dbHost . ";dbname=" . $dbName,$dbUser,$dbUserPassword);
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }	
    catch(PDOException $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    return $co;
}	

/* fonction déconnection à la base de donnée */

function disconnect()
{
    $co = null;
} 

/* fonction qui contrôle que l'email soit bien un email */

function isEmail ($var)
{
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

/* fonction qui fait un contrôle de sécurité */

function verifyInput($var)
{
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

?>