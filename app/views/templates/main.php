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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/style.dev.css">
</head>

<body>

    <header id="header-site" class="container">
        <a class="logo-container desktop" href="/">
            <img src="/icons/logo.svg" alt="Logo du site">
        </a>

        <a class="logo-container mobile" href="/">
            <img src="/icons/logo-mobile.svg" alt="Logo du site">
        </a>

        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="/test">Nos livres à l'échange</a></li>
            </ul>
        </nav>

        <nav>
            <ul>
                
                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="/mailbox"><img src="/icons/mailbox.svg" alt="Icone de messagerie">Messagerie</a></li>
                    <li><a href="/account"><img src="/icons/account.svg" alt="Icone de compte">Mon compte</a></li>
                    <li><a href="/logout">Deconnexion</a></li>
                <?php else: ?>
                    <li><a href="/auth/login">Connexion</a></li>
                <?php endif; ?>

            </ul>
        </nav>

        <button class="burger"
            onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened')), getElementById('header-site').classList.toggle('opened')"
            aria-label="Main Menu">
            <svg width="100" height="100" viewBox="0 0 100 100">
                <path class="line line1"
                    d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                <path class="line line2" d="M 20,50 H 80" />
                <path class="line line3"
                    d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
            </svg>
        </button>

    </header>

    <main>
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>

    <footer class="container">
        <nav>
            <ul>
                <li><a href="/privacy">Politique de confidentialité</a></li>
                <li><a href="/legal">Mentions légales</a></li>
                <li><a href="/contact">Tom Troc©</a></li>
            </ul>
        </nav>

        <a href="/" class="logo-container">
            <img src="/icons/logo-footer.svg" alt="Logo du site">
        </a>
    </footer>

</body>

</html>