<?php
session_start();

if (!isset($_SESSION['admin_connecte'])) {
    header("Location: login.php");
    exit;
}

require "../php/connexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];
    $titre = trim($_POST['titre']);
    $description = trim($_POST['description']);
    $technologies = trim($_POST['technologies']);
    $lien = trim($_POST['lien']);

    if (!empty($titre) && !empty($description) && !empty($technologies)) {
        $stmt = $pdo->prepare("UPDATE projets SET titre = :titre, description = :description, technologies = :technologies, lien = :lien WHERE id = :id");
        $stmt->execute([
            'titre' => $titre,
            'description' => $description,
            'technologies' => $technologies,
            'lien' => $lien,
            'id' => $id
        ]);

        header("Location: dashboard.php?succes_modif_projet=1");
        exit;
    } else {
        echo "Merci de remplir tous les champs obligatoires.";
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>