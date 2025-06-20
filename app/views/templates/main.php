<?php
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="./css/style.dev.css">
</head>

<body>

    <header>
        <img src="./images/logo.svg" alt="Logo du site">

        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="/test">Nos livres à l'échange</a></li>
            </ul>
        </nav>

        <nav>
            <ul>
                <li><a href="/mailbox">Messagerie</a></li>
                <li><a href="/account">Mon compte</a></li>

                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="/logout">Deconnexion</a></li>
                <?php else: ?>
                    <li><a href="/login">Connexion</a></li>
                <?php endif; ?>
                
            </ul>
        </nav>
    </header>

    <main>
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>

    <footer>
        <nav>
            <ul>
                <li><a href="/privacy">Politique de confidentialité</a></li>
                <li><a href="/legal">Mentions légales</a></li>
                <li><a href="/contact">Tom Troc©</a></li>
            </ul>

            <img src="./images/logo-footer.svg" alt="Logo du site">
        </nav>
    </footer>

</body>

</html>