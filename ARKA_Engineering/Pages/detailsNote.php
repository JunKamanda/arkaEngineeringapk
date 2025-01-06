<?php

    include("../Php/config.php");

    session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/index.css">
    <link rel="stylesheet" href="../Css/details.css">
    <link rel="stylesheet" href="../Css/note.css">

    <title>Details</title>
</head>

<body>
    <!-- navigation -->
    <div class="nav">
        <ul>
            <li class="logo"><a href="#">ARKA Engineering</a></li>
            <li><a href="./newUser.php">Registre</a></li>
            <li class="active"><a href="./historic.php">Historique</a></li>
            <?php echo "<li><a>Bienvenue " . htmlspecialchars($_SESSION['nom']) . "!</a></li>";  ?>

        </ul>
    </div>
    
    <div class="contain">
        <div class="details">
            <!-- details -->          
                <div class="titre">
                    <h1>Details de l'élève</h1>
                </div>

                <div class="details-container">
                    <?php 
                        if (isset($_GET['update_id'])) {
                            $id = $_GET['update_id'];
                            $sql = "SELECT * FROM newusers WHERE id = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                            if (!$etudiant) {
                                echo "Élève non trouvé.";
                                exit;
                            }
                        }
                    ?>
                    
                    <!-- Tableau historique -->
                    <form class="table" method="POST" action="../Php/detailsNote.php">
                        <table >
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($etudiant['id']); ?>">
                            <tr>
                                <th class="bold">Prénom</th>
                                <td class="bold"><input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($etudiant['prenom']); ?>"></td>
                            </tr>
                            <tr>
                                <th class="color">Nom</th>
                                <td class="color"><input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($etudiant['nom']); ?>"></td>
                            </tr>
                            <tr>
                                <th>Postnom</th>
                                <td><input type="text" id="postnom" name="postnom" value="<?php echo htmlspecialchars($etudiant['postnom']); ?>"></td>
                            </tr>
                            <tr>
                                <th class="color">Date de naissance</th>
                                <td class="color"><input type="text" id="date_naissance" name="date_naissance" value="<?php echo htmlspecialchars($etudiant['date_naissance']); ?>"></td>
                            </tr>
                            <tr>
                                <th>Lieu de naissance</th>
                                <td><input type="text" id="lieu_naissance" name="lieu_naissance" value="<?php echo htmlspecialchars($etudiant['lieu_naissance']); ?>"></td>
                            </tr>
                            <tr>
                                <th class="color">Téléphone</th>
                                <td class="color"><input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($etudiant['telephone']); ?>"></td>
                            </tr>
                            <tr>
                                <th>Adresse</th>
                                <td><input type="text" id="adresse" name="adresse" value="<?php echo htmlspecialchars($etudiant['adresse']); ?>"></td>
                            </tr>
                            <tr>
                                <th class="color">Module</th>
                                <td class="color">
                                    <select id="module" name="module">
                                        <option><?php echo htmlspecialchars($etudiant['module']); ?></option>
                                        <option value="Dév. web et mob">Dév. web et mob</option>
                                        <option value="CyberSécurité">CyberSécurité</option>
                                        <option value="Initiation à l'informatique">Initiation à l'informatique</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <!-- bouton enregistrez -->
                        <input type="submit" value="Mise à jour">
                    </form>

                    <!-- profil -->
                    <div class="profil">
                        <div class="img">
                            <img src="../img/BeCool.png" alt="photo de profil">
                        </div>
                        <!-- moyenne -->
                        <div class="moyenne">
                            <p>Moyenne de 9 sur 10</p>
                        </div>
                    </div>

                </div>

            <!-- Note -->           
        </div>

        <div class="notes note">
            <div class="titre">
                <h1>Note de l'élève</h1>
            </div>

            <div class="reseach">
                <div class="input_search">
                    <input type="text" placeholder="Date de l'épreuve ...">
                    <input type="text" placeholder="Intitulé de l'épreuve ...">
                    <input type="text" placeholder="Note ...">
                </div>

                <div class="input_search">
                    <input type="submit" value="Enregistrez">
                </div>
            </div>

            <!-- Tableau -->
            <table border="1px" cellspacing="0" cellpadding="8">
                <thead>
                    <tr class="title">
                        <th>Module</th>
                        <th>Intitulé de l'épreuve</th>
                        <th>Date de l'épreuve</th>
                        <th>Note</th>
                        <th>Enregistrer Par</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Junior</td>
                        <td>Kamanda</td>
                        <td>Lubumbashi</td>
                        <td>01/01/2000</td>
                        <td>0123456789</td>
                        <td class="result_btn">
                            <input type="submit" value="Maj" class="green">
                            <input type="submit" value="Del" class="red">
                        </td>
                    </tr>
                    <tr id="invisible">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="result_btn">
                            <input type="submit" value="" id="green">
                            <input type="submit" value="" id="red">
                        </td>
                    </tr>
                    <tr id="invisible">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="result_btn">
                            <input type="submit" value="" class="green">
                            <input type="submit" value="" class="red">
                        </td>
                    </tr>
                    <tr id="invisible">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="result_btn">
                            <input type="submit" value="" class="green">
                            <input type="submit" value="" class="red">
                        </td>
                    </tr>
                    <tr id="invisible">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="result_btn">
                            <input type="submit" value="" class="green">
                            <input type="submit" value="" class="red">
                        </td>
                    </tr>
                    <tr id="invisible">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="result_btn">
                            <input type="submit" value="" class="green">
                            <input type="submit" value="" class="red">
                        </td>
                    </tr>
                    <tr id="invisible">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="result_btn">
                            <input type="submit" value="" class="green">
                            <input type="submit" value="" class="red">
                        </td>
                    </tr>
                </tbody>
            </table>

            <input class="maj" type="submit" value="Mise à jour">
         </div>
    </div>
</body>

</html>

