<?php
// Importer le fichier de configuration
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $postnom = $_POST['postnom'];
    $date_naissance = $_POST['date_naissance'];
    $lieu_naissance = $_POST['lieu_naissance'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $module = $_POST['module'];


    // Validation des données
    if (empty($prenom) || empty($nom)) {
        echo "Le prénom et le nom sont requis.";
        exit();
    }

    // Préparer et exécuter la requête SQL
    $sql = "UPDATE newusers SET prenom = :prenom, nom = :nom, postnom = :postnom, date_naissance = :date_naissance, lieu_naissance = :lieu_naissance, telephone = :telephone, adresse = :adresse, module = :module WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':postnom', $postnom);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':lieu_naissance', $lieu_naissance);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':module', $module);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: ../Pages/historic.php?message=update");
        exit();
    } else {
        echo "Erreur lors de la mise à jour : " . $stmt->errorInfo()[2];
    }
}
?>
