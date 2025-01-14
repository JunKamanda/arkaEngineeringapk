<?php

    include("../Php/config.php");

    session_start();

    
    $sql = "SELECT * FROM newusers ORDER BY id DESC LIMIT 1";
    $stmt = $pdo->query($sql); 
    $dernier_etudiant = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!isset($_SESSION['userId'])) {
        header('Location: ../connexion.html');
        exit();        
    }



?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- lien css -->
    <link rel="stylesheet" href="../Css/index.css">
    <link rel="stylesheet" href="../Css/newUser.css">

    <!-- titre de la page -->
    <title>Nouvel Etudiant</title>
</head>

<body>
    <div class="contain">
        <!-- navigation de la page newUser -->
        <div class="nav"> 
            <ul>
                <li class="logo"><a href="#">ARKA Engineering</a></li>
                <li class="active"><a href="./newUser.html">Registre</a></li>
                <li><a href="./historic.php">Historique</a></li>
                <?php echo "<li><a>Bienvenue " . htmlspecialchars($_SESSION['nom']) . "!</a></li>";  ?>
            </ul>
        </div>

        <!-- formulaire -->
        <div class="formNewUser">
            <div class="titre">
                <h1>Nouvel Etudiant</h1>
            </div>

            <form action="../Php/newUser.php" method="POST">
                <div class="inputsContainer">
                    <!-- coté gauche -->
                    <div class="leftForm">
                        <div class="inputs">
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" placeholder="Prénom..." autocomplete="none">
                        </div>
                        <div class="inputs">
                            <label for="postnom">Postnom</label>
                            <input type="text" id="postnom" name="postnom" placeholder="Postnom..." autocomplete="none">
                        </div>
                        <div class="inputs">
                            <label for="adresse">Adresse</label>
                            <input type="text" id="adresse" name="adresse" placeholder="Adresse..." autocomplete="none">
                        </div>
                        <div class="inputs">
                            <label for="lieu_naissance">Lieu e naissance</label>
                            <input type="text" id="lieu_naissance" name="lieu_naissance" placeholder="lieuNaissance..." autocomplete="none">
                        </div>
                    </div>
                    <!-- Coté droite -->
                    <div class="rightForm">
                        <div class="inputs">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" placeholder="Nom..." autocomplete="none">
                        </div>
                        <div class="inputs">
                            <label for="telephone">Télephone</label>
                            <input type="text" id="telephone" name="telephone" placeholder="Télephone..." autocomplete="none">
                        </div>
                        <div class="inputs">
                            <label for="date_naissance">Date de naissance</label>
                            <input type="text" id="date_naissance" name="date_naissance" placeholder="Date de naissance..." autocomplete="none">
                        </div>
                        <div class="inputs">
                            <label for="module">Module</label>
                            <select id="module" name="module">
                                <option value="Dév. web et mob">Dév. web et mob</option>
                                <option value="CyberSécurité">CyberSécurité</option>
                                <option value="Initiation à l'informatique">Initiation à l'informatique</option>
                            </select>
                        </div>
                    </div>
                </div>


                <!-- bouton enregistrez -->
                <input type="submit" value="Enregistrez">
                <!-- <button type="submit">Connexion</button> -->
            </form>
        </div>

        <!-- Enregistrement -->
         <table border="1px" cellspacing="0" cellpadding="8">
            <thead>
                <tr class="save">
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Postnom</th>
                    <th>Lieu de naissance</th>
                    <th>Date de naissance</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Module</th>
                    <th>Créer par</th>
                    <th>Action</th>
                </tr>
            </thead>
            <!-- <tbody>
                <tr>
                    <td>Junior</td>
                    <td>Kamanda</td>
                    <td>Lubumbashi</td>
                    <td>01/01/2000</td>
                    <td>0123456789</td>
                    <td>Dev. Web et mobile</td>
                    <td class="result_btn">
                        <input type="submit" value="Update" class="green">
                        <input type="submit" value="Delete" class="red">
                    </td>
                </tr>
            </tbody> -->

            <tbody>
            <?php if ($dernier_etudiant): ?>
                <tr>
                    <td><?= htmlspecialchars($dernier_etudiant['prenom']); ?></td>
                    <td><?= htmlspecialchars($dernier_etudiant['nom']); ?></td>
                    <td><?= htmlspecialchars($dernier_etudiant['postnom']); ?></td>
                    <td><?= htmlspecialchars($dernier_etudiant['lieu_naissance']); ?></td>
                    <td><?= htmlspecialchars($dernier_etudiant['date_naissance']); ?></td>
                    <td><?= htmlspecialchars($dernier_etudiant['telephone']); ?></td>
                    <td><?= htmlspecialchars($dernier_etudiant['adresse']); ?></td>
                    <td><?= htmlspecialchars($dernier_etudiant['module']); ?></td>
                    <td><?= htmlspecialchars($dernier_etudiant['nom']); ?></td>
                    <td class="result_btn">
                        <input type="submit" value="Update" class="green">
                        <input type="submit" value="Delete" class="red">
                    </td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="8">Aucun étudiant enregistré pour le moment.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        </table>
    

    </div>
</body>

</html>