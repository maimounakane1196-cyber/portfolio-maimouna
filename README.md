# Portfolio - Maïmouna Kane

Portfolio personnel présentant mon parcours, mes projets et mes compétences en développement.

## Architecture technique

Ce projet suit une architecture de type LAMP (adaptée avec PostgreSQL à la place de MySQL) :
- **Serveur** : Apache (via XAMPP)
- **Langage backend** : PHP (avec PDO pour la connexion à la base de données)
- **Base de données** : PostgreSQL
- **Frontend** : HTML, CSS, JavaScript

## Fonctionnalités

- Affichage dynamique des projets et compétences, stockés en base de données
- Formulaire de contact avec enregistrement des messages
- Espace d'administration sécurisé (authentification avec mot de passe haché, gestion de session)
- Ajout, modification et suppression des projets et compétences depuis un tableau de bord admin

## Structure du projet

    portfolio/
    ├── index.php          (Page d'accueil)
    ├── projets.php        (Page listant tous les projets)
    ├── css/                (Styles)
    ├── php/                (Connexion base de données et traitement des formulaires)
    ├── admin/              (Espace d'administration protégé)
    ├── images/
    └── documents/          (CV téléchargeable)

## Technologies utilisées

HTML, CSS, JavaScript, PHP, PostgreSQL

## Auteur

Maïmouna Kane — Étudiante 