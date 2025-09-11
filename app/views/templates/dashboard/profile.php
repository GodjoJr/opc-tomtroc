<div class="container profile-page">
    <h1>Mon compte</h1>
    <div class="user-container">
        <div class="left-container">

            <div class="top-container">

                <form action="" method="post" enctype="multipart/form-data">

                    <div class="image-container">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <img id="preview" src="<?= $user['avatar'] ?: '/images/default-avatar.jpg' ?>"
                            alt="Aperçu de l'image">

                    </div>

                    <input type="file" name="avatar" id="avatar" accept="image/*" style="display:none"
                        onchange="previewImage(this)">

                    <button class="file-btn" type="button" onclick="document.getElementById('avatar').click();">
                        Modifier la photo
                    </button>

                </form>

            </div>

            <div class="infos">

                <h3 class="username"><?= $user['username'] ?></h3>
                <p class="member-since"><?= $user['account_age'] ?></p>

                <span class="title">Bibliothèque</span>
                <a class="books-count" href="#books"><img src="/icons/livres.svg"
                        alt="Icone de livre"><?= count($user['books']) ?>
                    livre<?= count($user['books']) > 1 ? 's' : '' ?></a>

            </div>

        </div>

        <div class="right-container">
            <form action="" method="post">
                <p>Vos informations personnelles</p>

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

                <button class="btn transparent" type="submit">Enregistrer</button>
            </form>
        </div>
    </div>

    <div id="books">

        <table>

            <thead>
                <tr>
                    <th class="cover">Photo</th>
                    <th class="title">Titre</th>
                    <th class="author">Auteur</th>
                    <th class="description">Description</th>
                    <th class="status">Disponibilité</th>
                    <th class="actions">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($user['books'] as $book): ?>
                    <tr>
                        <td class="cover">
                            <img src="<?= $book['b_image'] ?: '/images/default-cover.jpg' ?>" alt="Couverture du livre">
                        </td>
                        <td class="title">
                            <div><?= $book['b_title'] ?></div>
                        </td>
                        <td class="author">
                            <div><?= $book['b_author'] ?></div>
                        </td>
                        <td class="description">
                            <div><?= $book['b_description'] ?></div>
                        </td>
                        <td class="status <?= $book['b_status']; ?>">
                            <div>
                                <?php switch ($book['b_status']):
                                    case 'available':
                                        echo 'Disponible';
                                        break;
                                    case 'unavailable':
                                        echo 'Non disp.';
                                        break;
                                    default:
                                        echo 'Non renseigné';
                                        break;
                                endswitch;
                                ?>
                            </div>
                        </td>
                        <td class="actions">
                            <div>
                                <a class="edit" href="/books/edit/<?= $book['b_id'] ?>">Modifier</a>
                                <a class="delete" href="/books/delete/<?= $book['b_id'] ?>">Supprimer</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <a href="/books/create" class="btn">Ajouter un livre</a>

    </div>

</div>

<script>
    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('avatar').src = e.target.result;
            };
            reader.readAsDataURL(file);
            input.form.submit();
        }
    }
</script>