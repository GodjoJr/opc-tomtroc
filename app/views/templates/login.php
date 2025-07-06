<div class="login-container container">

    <form action="/connectUser" method="post">
        <h1>Connexion</h1>

        <label for="email">Adresse email</label>
        <input type="email" name="email" id="email">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">

        <button type="submit">Se connecter</button>
        <span>Pas de compte ? <a href="/auth/signup">Inscrivez-vous</a></span>

    </form>

    <div class="image-container">
        <img src="/images/tomtroc-bookshelf.webp" alt="Etagère de livres">
    </div>

</div>