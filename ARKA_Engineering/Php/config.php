<?php

// Information connexion bdd
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arka_engineering";

// créer connexion bdd
try {
    //Creation chaine de connexion
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $error) {

    die("Erreur de connexion : " . $error->getMessage());

}


?>