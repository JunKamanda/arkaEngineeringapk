<?php
//importer la connexion de la base des données
include('config.php');


//Cette ligne verifie si la request method http est POST
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $prenom = $_POST['prenom'];
    $postnom = $_POST['postnom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $date_naissance = $_POST['date_naissance'];
    $password = $_POST['password'];
    $date_creation = date('Ymd H:i:s');
    $statut = "admin"; 
    $passwordCrypte = password_hash($password, PASSWORD_DEFAULT);
    // $date_creation = "09/11/2024";

    //requete d'insertion 
    try {
        $stmt = $pdo->prepare("INSERT INTO users_arka (username,password,nom,prenom,postnom,telephone,adresse,date_naissance,date_creation,statut)
        VALUES (:username, :password, :nom, :prenom, :postnom, :telephone, :adresse, :date_naissance, :date_creation, :statut)");

        $stmt->bindParam(':username', $email);
        $stmt->bindParam(':password', $passwordCrypte);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':postnom', $postnom);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->bindParam(':date_creation', $date_creation);
        $stmt->bindParam(':statut', $statut);

        $stmt->execute();

        header("location: ../connexion.html?message=success");
        // echo "Utilisateur créé " . $prenom;

    } catch (PDOException $error) {
        echo "Erreur création du user " . $error;
    }

}

?>

