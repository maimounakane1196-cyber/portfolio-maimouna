<?php
session_start();

if (!isset($_SESSION['admin_connecte'])) {
    header("Location: login.php");
    exit;
}

require "../php/connexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];

    $stmt = $pdo->prepare("DELETE FROM projets WHERE id = :id");
    $stmt->execute(['id' => $id]);

    header("Location: dashboard.php?succes_suppr=1");
    exit;
} else {
    header("Location: dashboard.php");
    exit;
}
?>