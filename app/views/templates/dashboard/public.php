<div class="container profile-page-public">
    <div class="left-container">

        <div class="top-container">
            <div class="image-container">
                <img src="<?= $user->getAvatar() ?: '/images/default-avatar.jpg' ?>" alt="avatar de l'utilisateur">
            </div>
        </div>

        <div class="infos">

            <h3 class="username"><?= $user->getUsername() ?></h3>
            <p class="member-since"><?= $user->AccountAge() ?></p>

            <span class="title">Bibliothèque</span>
            <a class="books-count" href="#books"><img src="/icons/livres.svg" alt="Icone de livre"><?= count($books) ?>
                livre<?= count($books) > 1 ? 's' : '' ?></a>

        </div>

        <form class="send-message" action="/message/mailbox" method="post">
            <input type="hidden" name="receiver" value="<?= $user->getId() ?>">
            <button class="btn btn-secondary">Envoyer un message</button>
        </form>

    </div>

    <div id="books" class="right-container public">
        <table>
            <thead>
                <tr>
                    <th class="cover">Photo</th>
                    <th class="title">Titre</th>
                    <th class="author">Auteur</th>
                    <th class="description">Description</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr class="public" onclick="window.location.href='/books/detail/<?= $book['b_id'] ?>'">
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
                    </tr>
                <?php endforeach; ?>
            </tbody>


        </table>

    </div>
</div>
</div>