<?php

session_start();

// Supprimer toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion ou l'index
header("Location: login.php");
exit();
?>
