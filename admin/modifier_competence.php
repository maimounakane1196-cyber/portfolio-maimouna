<?php
session_start();

if (!isset($_SESSION['admin_connecte'])) {
    header("Location: login.php");
    exit;
}

require "../php/connexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];
    $niveau = (int) $_POST['niveau'];

    if ($niveau >= 0 && $niveau <= 100) {
        $stmt = $pdo->prepare("UPDATE competences SET niveau = :niveau WHERE id = :id");
        $stmt->execute([
            'niveau' => $niveau,
            'id' => $id
        ]);

        header("Location: dashboard.php?succes_modif=1");
        exit;
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>