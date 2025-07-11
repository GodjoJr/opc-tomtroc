<?php if (isset($_SESSION['user']) && $_SESSION['user'])
    header('Location: /dashboard/profile/' . $_SESSION['user']['username']); ?>


<div class="login-container container">

    <form action="/auth/login" method="post">
        <h1>Connexion</h1>

        <?php if (!empty($errors['global'])): ?>
            <div class="error-message">
                <?php foreach ($errors['global'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        <label for="email">Adresse email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>">
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

        <button type="submit">Se connecter</button>

        <span>Pas de compte ? <a href="/auth/signup">Inscrivez-vous</a></span>
    </form>

    <div class="image-container">
        <img src="/images/tomtroc-bookshelf.webp" alt="Etagère de livres">
    </div>

</div>