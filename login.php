<?php
// PAGE DE CONNECTION UTILISATEUR
session_start();
require 'db_connection.php';  // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification des informations de connexion
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: homepage.php');
    } else {
        $errorMessage = '<p style="color: red;">E-mail ou mot de passe incorrect.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Learning - Connexion">
    <title>Web Learning - Connexion/Inscription</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
    </style>
    <style>
        /* Style du corps */
        body {
            background: linear-gradient(135deg, #3b5998, #192f6a);
            /* Dégradé élégant */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family:"nunito";
            color: #fff;
            overflow: hidden;
        }

        /* Conteneur principal */
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            transition: all 0.4s ease;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        .error-message {
            color: red;
            font-size: 16px;
            text-align: center;
            margin-top: 10px;
            animation: fadeInUp 0.6s ease forwards;
        }


        /* Titre de la page */
        h2 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #ffffff;
            letter-spacing: 1px;
            animation: fadeInDown 1s ease-out;
        }

        /* Labels des champs */
        label {
            font-size: 16px;
            margin-bottom: 10px;
            color: #ffffff;
            text-align: left;
            display: block;
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Champs de formulaire */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 9px 0;
            border: none;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.3);
            color: #ffffff;
            font-size: 16px;
            transition: background-color 0.3s ease;
            animation: fadeInUp 0.8s ease forwards;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            background-color: rgba(255, 255, 255, 0.6);
            outline: none;
        }

        /* Bouton de connexion */
        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #4e7bad;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            animation: fadeInUp 1s ease forwards;
        }

        button:hover {
            background-color: #3b5998;
            transform: translateY(-3px);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Lien d'inscription */
        .link {
            margin-top: 25px;
            animation: fadeInUp 1.2s ease forwards;
        }

        .email {
            margin-bottom: -2px;
        }

        .mdp {
            margin-bottom: -2px;
        }

        .login {
            margin-left: 10px;


        }

        .login:hover {
            background-color: #68B0AB;
        }

        .link a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .link a:hover {
            color: #f0f0f0;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Connexion</h2>
        <form action="login.php" method="POST">
            <label for="email" class="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="password" class="mdp">Mot de passe</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="login">Se connecter</button>
        </form>

        <div class="link">
            <p>Pas encore inscrit ? <a href="register.php" style="color:#FFDF64 ">Créez un compte</a></p>
            <div class="error-message">


                <?php if (isset($errorMessage)) echo $errorMessage; ?>

            </div
        </div>

        </div>
</body>

</html>