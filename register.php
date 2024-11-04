<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Learning - Inscription">
    <title>Web Learning - Inscription</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
    background: linear-gradient(135deg, #3b5998, #192f6a); /* Dégradé élégant */
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
    font-family: 'Poppins', sans-serif;
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
input[type="text"],
input[type="email"],
input[type="tel"],
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

input[type="text"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
input[type="password"]:focus {
    background-color: rgba(255, 255, 255, 0.6);
    outline: none;
}

/* Bouton d'inscription */
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
    background-color: #68B0AB;
    transform: translateY(-3px);
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
}

/* Lien de connexion */
.link {
    margin-top: 25px;
    animation: fadeInUp 1.2s ease forwards;
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
        <h2>Inscription</h2>
        <form action="register_process.php" method="POST">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Téléphone</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirm">Confirmer le mot de passe</label>
            <input type="password" id="password_confirm" name="password_confirm" required>

            <button type="submit">S'inscrire</button>
        </form>

        <div class="link">
            <p>Déjà inscrit ? <a href="login.php" style="color:#FFDF64">Connectez-vous</a></p>
        </div>
    </div>
</body>
</html>
