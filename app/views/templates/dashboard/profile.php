<div class="container profile-page">
    <h1>Mon compte</h1>
    <div class="user-container">
        <div class="left-container">
            <div class="image-container" style="width: 200px; height: 200px;">
                <img src="<?= $user['avatar'] ?: '/images/default-avatar.jpg' ?>" alt="avatar de l'utilisateur">
            </div>
            
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="file" name="avatar" id="avatar">
                <button type="submit">Modifier</button>
                <?php if (!empty($errors['avatar'])): ?>
                    <div class="error-message">
                        <?php foreach ($errors['avatar'] as $error): ?>
                            <p><?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </form>

            <h2 class="username"><?= $user['username'] ?></h2>
            <p class="member-since"><?= $user['account_age'] ?></p>

            <p class="bookshelf">Bibliothèque</p>
            <a href="#books"><img src="/icons/livres.svg" alt="Icone de livre"><?= count($user['books']) ?>
                livre<?= count($user['books']) > 1 ? 's' : '' ?></a>
        </div>

        <div class="right-container">
            <form action="" method="post">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" value="<?= $user['email'] ?>">
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

                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" value="<?= $user['username'] ?>">
                <?php if (!empty($errors['username'])): ?>
                    <div class="error-message">
                        <?php foreach ($errors['username'] as $error): ?>
                            <p><?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <button type="submit">Modifier</button>
            </form>
        </div>
    </div>

    <div id="books">
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                    <th>Disponibilité</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user['books'] as $book): ?>
                    <tr>
                        <td><img style="max-width: 150px; max-height: 100px;"
                                src="<?= $book['b_image'] ?: '/images/default-cover.jpg' ?>" alt="Couverture du livre"></td>
                        <td><?= $book['b_title'] ?></td>
                        <td><?= $book['b_author'] ?></td>
                        <td><?= $book['b_description'] ?></td>
                        <td><?= $book['b_status'] ? 'Disponible' : 'Indisponible' ?></td>
                        <td>
                            <a href="/books/edit/<?= $book['b_id'] ?>">Modifier</a>
                            <a href="/books/delete/<?= $book['b_id'] ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>