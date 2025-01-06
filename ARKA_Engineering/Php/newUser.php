<?php
    // importer le fichier config pour la conexion à la bdd
    include("config.php");

    //Si le formulaire est saisi
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        session_start();

        //Récupérer les données du formulaire
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $postnom = $_POST['postnom'];
        $adresse = $_POST['adresse'];
        $lieu_naissance = $_POST['lieu_naissance'];
        $telephone = $_POST['telephone'];
        $date_naissance = $_POST['date_naissance'];
        $module = $_POST['module'];
        $date_creation = date('Ymd H:i:s');
        $statut = "actif";
        $creer_par = $_SESSION['nom'];

        //Insértion des données dans la base de données
        try {
            $stmt = $pdo->prepare("INSERT INTO newusers(prenom, nom, postnom, adresse, lieu_naissance, telephone, date_naissance, module, date_creation, statut, creer_par)
            VALUES(:prenom, :nom, :postnom, :adresse, :lieu_naissance, :telephone, :date_naissance, :module, :date_creation, :statut, :creer_par)");

            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':postnom', $postnom);
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':lieu_naissance', $lieu_naissance);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':date_naissance', $date_naissance);
            $stmt->bindParam(':module', $module);
            $stmt->bindParam(':date_creation', $date_creation);
            $stmt->bindParam(':statut', $statut);
            $stmt->bindParam(':creer_par', $creer_par);

            $stmt->execute();

            header("location: ../Pages/newUser.php?message=success");
            // echo "Utilisateur créé " . $prenom;

        }catch (PDOException $error) {
            echo "Erreur création d'un nouvel utilisateur " . $error;
        }
    }


?>