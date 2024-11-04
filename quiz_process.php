<?php

require 'db_connection.php'; // Connexion à la base de données
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirection vers la page de connexion si non connecté
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupérer le score envoyé par le formulaire
$score = isset($_POST['score']) ? intval($_POST['score']) : 0;

// Enregistrer le score dans la base de données
$stmt = $conn->prepare('INSERT INTO results (user_id, score) VALUES (?, ?)');
$stmt->bind_param('ii', $user_id, $score);
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Score Enregistré</title>
    <style>
        /* Style général du corps */
body {
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: linear-gradient(135deg, #3b5998, #192f6a); /* Dégradé élégant bleu */
    margin: 0;
}

/* Conteneur du résultat */
.result-container {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    padding: 30px;
    max-width: 600px;
    width: 100%;
    height: 250px;;
    text-align: center;
    animation: fadeIn 1s ease-out;
    transform: translateY(-20px);
    transition: transform 0.5s ease;
    backdrop-filter: blur(10px); /* Effet de flou */
}

.result-container:hover {
    transform: translateY(0);
}

/* Titre du résultat */
.result-container h1 {
    font-size: 28px;
    color: #EBEBD3;
    margin-bottom: 15px;
    letter-spacing: 1px;
    animation: fadeInUp 0.8s ease forwards;
}

/* Paragraphe du score */
.result-container p {
    font-size: 18px;
    color: #EBEBD3;
    margin-bottom: 25px;
    animation: fadeInUp 1s ease forwards;
}

.result-container strong {
    color: #E5B25D; /* Couleur mise en avant */
}

/* Bouton */
.result-container button {
    padding: 12px 25px;
    font-size: 16px;
    background-color: #4e7bad;
    color: white;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    animation: fadeInUp 1.2s ease forwards;
}

.result-container button:hover {
    background-color: #68B0AB;
    transform: scale(1.05);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
}

/* Lien */
.result-container a {
    display: block;
    margin-top: 20px;
    color: #ffffff;
    font-size: 16px;
    text-decoration: none;
    animation: fadeInUp 1.4s ease forwards;
}

.result-container a:hover {
    color: #E5B25D;
    text-decoration: none;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

   </style>
    <script>
        // Redirection automatique après 10 secondes
        /*
        setTimeout(function() {
            window.location.href = 'quiz.php';
        }, 100000);
        */
    </script>
</head>
<body>
    <div class="result-container">
        <h1>Fin du quiz voci votre score !</h1>
        <p><b>Score final : </b><strong style="text: zize 20px;"><?php echo $score; ?> /20 </strong></p>
        <form action="quiz.php" method="get">
            <button type="submit">Recommencer</button>
        </form>
        <p><a href="homepage.php"><b>Retour à l'accueil</b></a></p>
    </div>
</body>
</html>
