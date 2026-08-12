<?php
session_start();

// Protection : seul un admin connecté peut ajouter un projet
if (!isset($_SESSION['admin_connecte'])) {
    header("Location: login.php");
    exit;
}

require "../php/connexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre']);
    $description = trim($_POST['description']);
    $technologies = trim($_POST['technologies']);
    $lien = trim($_POST['lien']);

    if (!empty($titre) && !empty($description) && !empty($technologies)) {
        $stmt = $pdo->prepare("INSERT INTO projets (titre, description, technologies, lien) VALUES (:titre, :description, :technologies, :lien)");
        $stmt->execute([
            'titre' => $titre,
            'description' => $description,
            'technologies' => $technologies,
            'lien' => $lien
        ]);

        header("Location: dashboard.php?succes=1");
        exit;
    } else {
        echo "Merci de remplir tous les champs obligatoires.";
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>