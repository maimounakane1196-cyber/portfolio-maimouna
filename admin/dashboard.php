<?php
session_start();

if (!isset($_SESSION['admin_connecte'])) {
    header("Location: login.php");
    exit;
}

require "../php/connexion.php";

// Récupération des projets
$stmtProjets = $pdo->query("SELECT * FROM projets ORDER BY date_ajout DESC");
$listeProjets = $stmtProjets->fetchAll(PDO::FETCH_ASSOC);

// Récupération des compétences
$stmtComp = $pdo->query("SELECT * FROM competences ORDER BY categorie, nom");
$listeCompetences = $stmtComp->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="page-admin">
        <div class="entete-admin">
            <h1>Tableau de bord</h1>
            <a href="logout.php" class="btn btn-secondaire">Déconnexion</a>
        </div>

        <div class="carte-bienvenue">
            <p>Bienvenue, tu es bien connectée à ton espace admin.</p>
        </div>

        <!-- ===== Ajouter un projet ===== -->
        <div class="carte-formulaire-admin">
            <h2>Ajouter un projet</h2>

            <?php if (isset($_GET['succes'])): ?>
                <p class="message-succes">✓ Projet ajouté avec succès !</p>
            <?php endif; ?>

            <form action="ajouter_projet.php" method="POST" class="formulaire-contact">
                <div class="champ">
                    <label for="titre">Titre</label>
                    <input type="text" id="titre" name="titre" required>
                </div>

                <div class="champ">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="3" required></textarea>
                </div>

                <div class="champ">
                    <label for="technologies">Technologies</label>
                    <input type="text" id="technologies" name="technologies" placeholder="ex: HTML, CSS, PHP" required>
                </div>

                <div class="champ">
                    <label for="lien">Lien (GitHub, démo...)</label>
                    <input type="url" id="lien" name="lien" placeholder="https://github.com/...">
                </div>

                <button type="submit" class="btn btn-primaire btn-large">Ajouter le projet</button>
            </form>
        </div>

        <!-- ===== Modifier / Supprimer mes projets ===== -->
        <div class="carte-formulaire-admin">
            <h2>Modifier mes projets</h2>

            <?php if (isset($_GET['succes_modif_projet'])): ?>
                <p class="message-succes">✓ Projet mis à jour !</p>
            <?php endif; ?>

            <?php if (isset($_GET['succes_suppr'])): ?>
                <p class="message-succes">✓ Projet supprimé !</p>
            <?php endif; ?>

            <div class="liste-admin-projets">
                <?php foreach ($listeProjets as $proj): ?>
                    <div class="carte-projet-admin">
                        <form action="modifier_projet.php" method="POST" class="formulaire-contact">
                            <input type="hidden" name="id" value="<?= $proj['id'] ?>">

                            <div class="champ">
                                <label>Titre</label>
                                <input type="text" name="titre" value="<?= htmlspecialchars($proj['titre']) ?>" required>
                            </div>

                            <div class="champ">
                                <label>Description</label>
                                <textarea name="description" rows="3" required><?= htmlspecialchars($proj['description']) ?></textarea>
                            </div>

                            <div class="champ">
                                <label>Technologies</label>
                                <input type="text" name="technologies" value="<?= htmlspecialchars($proj['technologies']) ?>" required>
                            </div>

                            <div class="champ">
                                <label>Lien</label>
                                <input type="text" name="lien" value="<?= htmlspecialchars($proj['lien']) ?>">
                            </div>

                            <div class="actions-projet-admin">
                                <button type="submit" class="btn-mini">Mettre à jour</button>
                            </div>
                        </form>

                        <form action="supprimer_projet.php" method="POST" onsubmit="return confirm('Supprimer ce projet ?');">
                            <input type="hidden" name="id" value="<?= $proj['id'] ?>">
                            <button type="submit" class="btn-mini btn-danger">Supprimer</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ===== Ajouter une compétence ===== -->
        <div class="carte-formulaire-admin">
            <h2>Ajouter une compétence</h2>

            <?php if (isset($_GET['succes_comp'])): ?>
                <p class="message-succes">✓ Compétence ajoutée avec succès !</p>
            <?php endif; ?>

            <form action="ajouter_competence.php" method="POST" class="formulaire-contact">
                <div class="champ">
                    <label for="nom_comp">Nom</label>
                    <input type="text" id="nom_comp" name="nom" placeholder="ex: React" required>
                </div>

                <div class="champ">
                    <label for="niveau">Niveau (0 à 100)</label>
                    <input type="number" id="niveau" name="niveau" min="0" max="100" required>
                </div>

                <div class="champ">
                    <label for="categorie">Catégorie</label>
                    <input type="text" id="categorie" name="categorie" placeholder="ex: Frontend, Outils, Langues" required>
                </div>

                <button type="submit" class="btn btn-primaire btn-large">Ajouter la compétence</button>
            </form>
        </div>

        <!-- ===== Modifier mes compétences ===== -->
        <div class="carte-formulaire-admin">
            <h2>Modifier une compétence</h2>

            <?php if (isset($_GET['succes_modif'])): ?>
                <p class="message-succes">✓ Compétence mise à jour !</p>
            <?php endif; ?>

            <div class="liste-admin-competences">
                <?php foreach ($listeCompetences as $comp): ?>
                    <form action="modifier_competence.php" method="POST" class="ligne-competence-admin">
                        <input type="hidden" name="id" value="<?= $comp['id'] ?>">

                        <span class="nom-competence-admin"><?= htmlspecialchars($comp['nom']) ?></span>

                        <input type="number" name="niveau" value="<?= $comp['niveau'] ?>" min="0" max="100" class="input-niveau">

                        <button type="submit" class="btn-mini">Mettre à jour</button>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

</body>
</html>