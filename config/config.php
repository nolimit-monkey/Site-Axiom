<?php
// Sécurité
if (!defined('APP_STARTED')) {
    define('APP_STARTED', true);
}

define('BASE_URL', '/axiom/');

$host = "localhost";
$dbname = "axiom";
$username = "root";
$password = "FritesCh@udes834";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Erreur BDD : " . $e->getMessage());
}
?>