<div class="container profile-page">
    <h1>Bienvenue, <?= htmlspecialchars($user['username']) ?> !</h1>

    <ul>
        <li><strong>Ton identifiant utilisateur :</strong> <?= htmlspecialchars($user['id']) ?></li>
        <li><strong>Ton email :</strong> <?= htmlspecialchars($user['email']) ?></li>
    </ul>

    <a href="/auth/logout">Se déconnecter</a>
</div>