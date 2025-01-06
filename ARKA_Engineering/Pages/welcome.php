<?php
    include('../Php/config.php');

    session_start();

    if (!isset($_SESSION['userId'])) {
        header('Location: ../connexion.html');
        exit();
    }

    echo "<h1>Bienvenue " . htmlspecialchars($_SESSION['nom']) . "!</h1>";

?>