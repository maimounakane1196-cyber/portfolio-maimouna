<?php
$host = "localhost";
$port = "5432";
$dbname = "portfolio";
$user = "postgres";
$password = "mouna1407";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connexion réussie à la base de données !";
    
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>