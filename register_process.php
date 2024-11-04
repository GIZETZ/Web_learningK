<?php
require 'db_connection.php';  // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password === $password_confirm) {
        // Hachage du mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertion des informations dans la base de données
        $stmt = $conn->prepare('INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $name, $email, $phone, $hashed_password);

        if ($stmt->execute()) {
            header('Location: login.php');  // Redirection vers la page de connexion après l'inscription réussie
        } else {
            echo '<p style="color: red;">Erreur lors de l\'inscription.</p>';
        }
    } else {
        echo '<p style="color: red;">Les mots de passe ne correspondent pas.</p>';
        header('Location: login.php'); 
    }
}
?>
