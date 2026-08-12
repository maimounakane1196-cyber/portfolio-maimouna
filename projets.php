<?php
require "php/connexion.php";

// Ici, pas de LIMIT : on récupère TOUS les projets
$stmt = $pdo->query("SELECT * FROM projets ORDER BY date_ajout DESC");
$projets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tous mes projets - Maïmouna Kane</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <nav class="navbar navbar-simple">
        <span class="logo">Maïmouna Kane</span>
        <div class="nav-liens">
            <a href="index.php">Accueil</a>
            <a href="index.php#contact">Contact</a>
        </div>
    </nav>

    <section id="projets" class="page-projets">
        <h2>Tous mes projets</h2>

        <div class="grille-projets">
            <?php foreach ($projets as $projet): ?>
                <div class="carte-projet">
                    <h3><?= htmlspecialchars($projet['titre']) ?></h3>
                    <p><?= htmlspecialchars($projet['description']) ?></p>
                    <p class="technologies"><?= htmlspecialchars($projet['technologies']) ?></p>
                    <?php if ($projet['lien']): ?>
                        <a href="<?= htmlspecialchars($projet['lien']) ?>" target="_blank">Voir le projet</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</body>
</html>