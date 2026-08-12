<?php
session_start();

if (!isset($_SESSION['admin_connecte'])) {
    header("Location: login.php");
    exit;
}

require "../php/connexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $niveau = (int) $_POST['niveau'];
    $categorie = trim($_POST['categorie']);

    if (!empty($nom) && !empty($categorie) && $niveau >= 0 && $niveau <= 100) {
        $stmt = $pdo->prepare("INSERT INTO competences (nom, niveau, categorie) VALUES (:nom, :niveau, :categorie)");
        $stmt->execute([
            'nom' => $nom,
            'niveau' => $niveau,
            'categorie' => $categorie
        ]);

        header("Location: dashboard.php?succes_comp=1");
        exit;
    } else {
        echo "Merci de remplir tous les champs correctement.";
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>