<?php

    include("../Php/config.php");

    session_start();


    $sql = "SELECT * FROM newusers";
    $stmt = $pdo->query($sql);
    $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    if (isset($_GET['supprimer_id'])) {
        $id = intval($_GET['supprimer_id']); // Sécurisation de l'ID reçu
        $newStatut = 'inactif';
    
        $sql = "UPDATE newusers SET statut = :statut WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':statut', $newStatut, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            // Redirection pour éviter que la suppression soit rejouée lors d'un rafraîchissement
            header("Location: historic.php");
            exit();
        } else {
            echo "Erreur lors de la mise à jour du statut.";
        }
    }


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/index.css">
    <link rel="stylesheet" href="../Css/historic.css">
    <link rel="stylesheet" href="../Css/table.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <title>Historique</title>
</head>

<body>
    <div class="contain">
        <!-- navigation de la page newUser -->
        <div class="nav">
            <ul>
                <li class="logo"><a href="#">ARKA Engineering</a></li>
                <li><a href="./newUser.php">Registre</a></li>
                <li class="active"><a href="./historic.php">Historique</a></li>
                <?php echo "<li><a>Bienvenue " . htmlspecialchars($_SESSION['nom']) . "!</a></li>";  ?>
            </ul>
        </div>

        <!-- Tableau historique -->
        <div class="arrayWrapper" id="arrayWrapper">
            <div class="titre">
                <h1>Historique</h1>
            </div>

            <!-- Tableau historique -->
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>Lieu de naissance</th>
                        <th>Date de naissance</th>
                        <th>Téléphone</th>
                        <th>Module</th>
                        <th>Date de création</th>
                        <th>Créer par</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php if($etudiants){
                        foreach($etudiants as $etudiant){
                            $id = $etudiant['id'];
                            $prenom = $etudiant['prenom'];
                            $nom = $etudiant['nom'];
                            $lieu_naissance = $etudiant['lieu_naissance'];
                            $date_naissance = $etudiant['date_naissance'];
                            $telephone = $etudiant['telephone'];
                            $module = $etudiant['module'];
                            $date_creation = $etudiant['date_creation'];
                            $creer_par = $etudiant['creer_par'];
                            $statut = $etudiant['statut'];
                            
                           echo'<tr>';
                           echo '<td>' . $prenom . '</td>';
                           echo '<td>' . $nom . '</td>';
                           echo '<td>' . $lieu_naissance . '</td>';
                           echo '<td>' . $date_naissance . '</td>';
                           echo '<td>' . $telephone . '</td>';
                           echo '<td>' . $module . '</td>';
                           echo '<td>' . $date_creation . '</td>';
                           echo '<td>' . $creer_par . '</td>';
                           echo '<td>' . $statut . '</td>';
                           ?>
                            <td class="result_btn">
                                
                                <button type="submit" style ="background : green">
                                    <a href="detailsNote.php?update_id=<?php echo htmlspecialchars($id); ?>">Update</a>
                                </button>

                                <button type="submit" style ="background : red">
                                    <a href="?supprimer_id=<?php echo htmlspecialchars($id); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?');">Delete</a>
                                </button>
                            </td>
                                
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>


           
        </div>

    </div>
</body>

<script>
    new DataTable('#example');
</script>

</html>