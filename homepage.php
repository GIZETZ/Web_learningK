<?php
// PAGE D'ACCUEILL
session_start();
require 'db_connection.php'; // Connexion à la base de données

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirection vers la page de connexion si non connecté
    exit();
}

$user_id = $_SESSION['user_id'];
// Récupérer les informations de l'utilisateur si nécessaire
$query = "SELECT name FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_name = $user['name'] ?? 'Utilisateur'; // Si le nom n'est pas trouvé, afficher "Utilisateur"

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Learning - Accueil">
    <title>Web Learning - Accueil</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
    </style>
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            /* Dégradé élégant bleu */
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            font-family: "nunito";
            /* Centrer le texte */
        }

        h1 {
            font-size: 2.5rem;
            /* Taille de police pour le titre */
            margin-bottom: 20px;
            /* Espacement en bas du titre */
            animation: fadeIn 1s ease-in-out;
            /* Animation d'apparition */


        }


        p {
            font-size: 1.2rem;
            /* Taille de police pour le paragraphe */
            margin-bottom: 20px;
            /* Espacement en bas du paragraphe */
            animation: fadeIn 1s ease-in-out;
            /* Animation d'apparition */
        }

        ul {
            list-style-type: none;
            /* Supprimer les puces */
            padding: 0;
            /* Supprimer le padding */
        }

        li {
            height: 30px;
            padding: 17px;
            display: grid;
            margin: 10px 0;
            /* Espacement entre les éléments de la liste */
        }

        a {
            text-decoration: none;
            /* Supprimer le soulignement des liens */
            background-color: #2a5298;
            /* Couleur de fond pour les liens */
            color: #ffffff;
            /* Couleur du texte des liens */
            padding: 10px 20px;
            /* Espacement autour du texte */
            border-radius: 20px;
            /* Coins arrondis */
            transition: background-color 0.3s ease, transform 0.3s ease;
            /* Transition pour l'effet de survol */
        }

        a:hover {
            background-color: #68B0AB;
            /* Couleur au survol */
            transform: scale(1.05);
            /* Effet de zoom au survol */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <h1>
        <strong style="color:#FFDF64;"><?php echo htmlspecialchars($user_name); ?></strong> Bienvenue sur <strong style="color:#FFDF64;">Web_Learning</strong>
    </h1>
    <p>Ceci est votre espace d'apprentissage. <strong style="color:#FFDF64;">Prêt-à-coder ?</strong>
    </p>
    <ul>
        <li><a href="quiz.php">Commencer le Quiz</a></li>
        <li><a href="logout.php">Se déconnecter</a></li>
    </ul>
</body>
<footer>
    <p style="color:#FFDF64;">@TeamDev_GL</p>
</footer>

</html>