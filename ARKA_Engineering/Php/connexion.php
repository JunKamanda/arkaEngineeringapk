<?php 
    include('config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT id, username, password, nom FROM users_arka WHERE username=:email");

        $stmt->execute(['email'=>$email]);

        //La ligne récupérée doit être retourné sous forme d'un tableau
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC); 
        
        //Verifier si l'utilisateur existe
        if ($user_data && password_verify($password, $user_data['password'])) {
            //Demarrage de la session
            session_start();

            $_SESSION['userId']=$user_data['id'];
            $_SESSION['username']=$user_data['username'];
            $_SESSION['nom']=$user_data['nom'];

            header("location: ../Pages/newUser.php");

            exit();

        }else{
            echo "Mot de passe ou adresse mail incorrect";
        }

    }



    // henocklitemanya@gmail.com
?>

()