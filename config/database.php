<?php
// Identifiants de connexion à la base de données MySQL.
// Modifier ces valeurs selon votre environnement local.
$host = "localhost";
$dbname = "axiom";
$username = "root";
$password = "";

// Création de la connexion PDO avec charset UTF-8.
// $pdo est injecté dans les contrôleurs qui en ont besoin via index.php.
// En cas d'échec, l'exécution est stoppée avec un message d'erreur.
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Erreur BDD : " . $e->getMessage());
}
