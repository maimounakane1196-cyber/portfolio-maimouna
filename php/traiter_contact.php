<?php
require "connexion.php";

// On vérifie que le formulaire a bien été envoyé en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // On récupère les données envoyées, en enlevant les espaces inutiles
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Validation simple : on vérifie que rien n'est vide
    if (!empty($nom) && !empty($email) && !empty($message)) {

        // Requête préparée : protège contre les injections SQL
        $stmt = $pdo->prepare("INSERT INTO messages (nom, email, message) VALUES (:nom, :email, :message)");
        $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'message' => $message
        ]);

        // On redirige vers la page d'accueil avec un paramètre de succès
        header("Location: ../index.php?succes=1#contact");
        exit;

    } else {
        echo "Merci de remplir tous les champs.";
    }
} else {
    // Si on accède au fichier directement sans passer par le formulaire
    header("Location: ../index.php");
    exit;
}
?>