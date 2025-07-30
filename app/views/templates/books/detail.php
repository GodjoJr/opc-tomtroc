<div class="book-detail">

    <div class="breadcrumbs"><a href="/books/archive">Nos livres</a> > <?= $book['b_title'] ?></div>

    <div class="container">

        <div class="left-container">
            <img src="<?= $book['b_image'] ?: '/images/default-cover.jpg' ?>" alt="Couverture du livre">
        </div>

        <div class="right-container">
            <h1><?= $book['b_title'] ?></h1>
            <p>Par <?= $book['b_author'] ?></p>

            <div class="sep"></div>

            <span>Description</span>
            <p><?= $book['b_description'] ?></p>

            <span>Propriétaire</span>
            <a href="/dashboard/profile/<?= $book['u_username'] ?>" class="user">
                <img src="<?= $book['u_avatar'] ?: '/images/default-avatar.jpg' ?>"
                    alt="Avatar de <?= $book['u_username'] ?>">
                <p><?= $book['u_username'] ?></p>
            </a>
        </div>

    </div>

</div>