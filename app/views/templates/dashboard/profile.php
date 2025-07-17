<div class="container profile-page">
    <h1>Bienvenue, <?= htmlspecialchars($user['username']) ?> !</h1>

    <ul>
        <li><strong>Ton identifiant utilisateur :</strong> <?= htmlspecialchars($user['id']) ?></li>
        <li><strong>Ton email :</strong> <?= htmlspecialchars($user['email']) ?></li>
    </ul>

    <div class="book-list" style="display: flex; flex-wrap: wrap; gap: 30px">
        <?php foreach ($books as $book): ?>
            <div class="book-item" style="max-width: 300px;">
                <img style="width: 300px; height: 300px; object-fit: cover;" src="<?= htmlspecialchars($book['b_image']) ?>"
                    alt="<?= htmlspecialchars($book['b_image']) ?>">
                <p><strong>Titre : </strong><?= htmlspecialchars($book['b_title']) ?></p>
                <p><strong>Auteur : </strong><?= htmlspecialchars($book['b_author']) ?></p>
                <p><strong>Description : </strong><?= htmlspecialchars($book['b_description']) ?></p>
                <p><strong>Disponibilité : </strong><?= htmlspecialchars($book['b_status']) ?></p>
                <p><strong>Date d'ajout : </strong><?= htmlspecialchars($book['b_created_at']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="/books/create">Ajouter un livre</a>

    <a href="/auth/logout">Se déconnecter</a>
</div>