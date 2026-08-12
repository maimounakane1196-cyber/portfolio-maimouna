<?php
session_start();

// Si déjà connecté, redirige directement vers le dashboard
if (isset($_SESSION['admin_connecte'])) {
    header("Location: dashboard.php");
    exit;
}

$erreur = "";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="page-login">
        <div class="carte-login">
            <h2>Connexion</h2>

            <?php if (isset($_GET['erreur'])): ?>
                <p class="message-erreur">Identifiant ou mot de passe incorrect.</p>
            <?php endif; ?>

            <form action="verifier_login.php" method="POST">
                <div class="champ">
                    <label for="identifiant">Identifiant</label>
                    <input type="text" id="identifiant" name="identifiant" required>
                </div>

                <div class="champ">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                </div>

                <button type="submit" class="btn btn-primaire btn-large">Se connecter</button>
            </form>
        </div>
    </div>

</body>
</html>