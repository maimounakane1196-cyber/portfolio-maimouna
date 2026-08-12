<?php
require "php/connexion.php";

$stmt = $pdo->query("SELECT * FROM projets ORDER BY date_ajout DESC LIMIT 3");
$projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmtComp = $pdo->query("SELECT * FROM competences ORDER BY categorie, niveau DESC");
$toutesCompetences = $stmtComp->fetchAll(PDO::FETCH_ASSOC);

// On regroupe les compétences par catégorie
$competencesParCategorie = [];
foreach ($toutesCompetences as $comp) {
    $competencesParCategorie[$comp['categorie']][] = $comp;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Portfolio</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <header class="hero">
        <nav class="navbar">
            <span class="logo"><i class="fa-solid fa-code logo-icone"></i> Maïmouna <span class="logo-accent">Kane</span></span>
            <div class="nav-liens">
                <a href="#accueil">Accueil</a>
                <a href="#projets">Projets</a>
                <a href="#competences">Compétences</a>
                <a href="#contact">Contact</a>
            </div>
        </nav>

        <div class="hero-contenu">
            <div class="hero-texte">
                <h1>Salut, moi c'est <span class="nom-accent">Maïmouna Kane</span></h1>
                <p class="sous-titre">Étudiante passionnée par les mathématiques, la cryptographie et la cybersécurité, animée par l'envie de comprendre ce qui se cache derrière chaque ligne de code et chaque système sécurisé.</p>
                <p class="description">Passionnée par les technologies et le développement de solutions informatiques, j’ai réalisé plusieurs projets pratiques dans les domaines du développement logiciel, des bases de données, du DevOps et de la sécurité informatique.
                    Curieuse et motivée, je souhaite aujourd’hui mettre mes compétences en pratique, acquérir une première expérience professionnelle et continuer à progresser au sein d’une équipe.
                </p>

                <div class="boutons-hero">
                    <a href="#projets" class="btn btn-primaire"><i class="fa-solid fa-briefcase"></i> Voir mes projets</a>
                    <a href="#contact" class="btn btn-secondaire"><i class="fa-solid fa-paper-plane"></i> Me contacter</a>
                    <a href="documents/cv.pdf" class="btn btn-secondaire" download><i class="fa-solid fa-download"></i> Mon CV</a>
                </div>

                <div class="icones-reseaux">
                   <a href="https://www.linkedin.com/in/ma%C3%AFmouna-kane-90759031b/" target="_blank" title="LinkedIn">
                   <i class="fa-brands fa-linkedin"></i>
                   </a>
                   <a href="https://github.com/maimounakane1196-cyber" target="_blank" title="GitHub">
                   <i class="fa-brands fa-github"></i>
                   </a>
                   <a href="mailto:ton@email.com" title="Email">
                   <i class="fa-solid fa-envelope"></i>
                   </a>
                </div>
            </div>

            <div class="hero-photo">
                <img src="images/image.jpg" alt="moi">
            </div>
        </div>

        <div class="stats">
            <div class="stat">
                <span class="stat-nombre"><?= count($projets) ?>+</span>
                <span class="stat-label">Projets réalisés</span>
            </div>
            <div class="stat">
                <span class="stat-nombre">4+</span>
                <span class="stat-label">Technologies apprises</span>
            </div>
            <div class="stat">
                <span class="stat-nombre">L3</span>
                <span class="stat-label">Niveau d'études</span>
            </div>
        </div>
    </header>

    <section id="projets">
        <h2>Mes Projets</h2>

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

        <div class="voir-tout">
            <a href="projets.php" class="btn btn-primaire">Voir tous mes projets</a>
        </div>
    </section>

    <section id="competences">
        <h2>Mes Compétences</h2>

        <div class="grille-categories">
            <?php foreach ($competencesParCategorie as $categorie => $listeComp): ?>
                <div class="bloc-categorie">
                    <h3 class="titre-categorie"><?= htmlspecialchars($categorie) ?></h3>

                    <div class="liste-competences">
                        <?php foreach ($listeComp as $comp): ?>
                            <div class="carte-competence">
                                <div class="cercle-progression" style="--pourcentage: <?= (int) $comp['niveau'] ?>;">
                                    <span class="cercle-texte"><?= (int) $comp['niveau'] ?>%</span>
                                </div>
                                <span class="competence-nom"><?= htmlspecialchars($comp['nom']) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="contact">
        <div class="contenu-contact">
            <div class="contact-intro">
                <h2>Travaillons ensemble</h2>
                <p>Une question, une opportunité de stage, ou juste envie d'échanger ? N'hésite pas à m'écrire.</p>
            </div>

            <div class="carte-formulaire">
                <?php if (isset($_GET['succes'])): ?>
                    <p class="message-succes">✓ Ton message a bien été envoyé, merci !</p>
                <?php endif; ?>

                <form action="php/traiter_contact.php" method="POST" class="formulaire-contact">
                    <div class="champ">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" placeholder="Ton nom" required>
                    </div>

                    <div class="champ">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="ton@email.com" required>
                    </div>

                    <div class="champ">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Ton message..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primaire btn-large">Envoyer le message</button>
                </form>
            </div>
        </div>
    </section>

</body>
</html>