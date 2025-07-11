<div class="signup-container container">

    <form action="/auth/signup" method="post">
        <h1>Inscription</h1>

        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

        <label for="username">Pseudo</label>
        <input type="text" name="username" id="username" 
               value="<?= isset($old['username']) ? htmlspecialchars($old['username']) : '' ?>">
        <?php if (!empty($errors['username'])): ?>
            <div class="error-message">
                <?php foreach ($errors['username'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <label for="email">Adresse email</label>
        <input type="email" name="email" id="email" required novalidate
               value="<?= isset($old['email']) ? htmlspecialchars($old['email']) : '' ?>">
        <?php if (!empty($errors['email'])): ?>
            <div class="error-message">
                <?php foreach ($errors['email'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <?php if (!empty($errors['password'])): ?>
            <div class="error-message">
                <?php foreach ($errors['password'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <button type="submit">S'inscrire</button>
        <span>Déjà inscrit ? <a href="/auth/login">Connectez-vous</a></span>

    </form>

    <div class="image-container">
        <img src="/images/tomtroc-bookshelf.webp" alt="Etagère de livres">
    </div>
</div>
