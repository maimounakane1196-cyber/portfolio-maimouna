<?php
session_start();
require "../php/connexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifiant = trim($_POST['identifiant']);
    $mot_de_passe = trim($_POST['mot_de_passe']);

    // On cherche l'admin correspondant à cet identifiant
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE identifiant = :identifiant");
    $stmt->execute(['identifiant' => $identifiant]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // On vérifie que l'admin existe ET que le mot de passe correspond au hash stocké
    if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {
        $_SESSION['admin_connecte'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        header("Location: login.php?erreur=1");
        exit;
    }
}
?>