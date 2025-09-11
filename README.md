# TOMTROC - Site de troc de livres

## Description du projet

Tomtroc est une plateforme de troc de livres inspirée du modèle de Vinted.  
Elle permet aux utilisateurs de créer un compte, proposer leurs livres à l’échange et discuter directement via une messagerie intégrée.  
L’objectif est de favoriser la seconde main et de donner une nouvelle vie aux ouvrages tout en facilitant les échanges entre passionnés de lecture.

## Prérequis

Avant de lancer le projet **Tomtroc**, assurez-vous d’avoir installé et configuré les éléments suivants :  

- **PHP** : version 8.1 recommandée (minimum 8.0+)  
- **Base de données relationnelle** : MariaDB ou MySQL  
- **Serveur web** : Apache ou Nginx capable d’exécuter du PHP  

## Configuration

Pour configurer correctement **Tomtroc**, suivez les étapes ci-dessous :  

1. Ouvrez le fichier `/config/config.php` et renseignez vos identifiants de connexion à votre base de données.  
2. Importez le fichier `tomtroc-db.sql` dans votre base.  
3. Assurez-vous que votre serveur web pointe vers le dossier `public/` du projet comme racine web.  
   > Cela permet de protéger les fichiers sensibles (`/config`) et de n’exposer que les fichiers publics.

## Lancement du projet

Pour lancer le projet en local, vous pouvez utiliser le serveur PHP intégré :  
```bash
php -S localhost:8000 -t public public/index.php
