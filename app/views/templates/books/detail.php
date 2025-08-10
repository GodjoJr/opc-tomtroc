<div class="books-detail">

    <div class="breadcrumbs container"><a href="/books/archive">Nos livres</a> > <?= $book['b_title'] ?></div>

    <div class="detail container">

        <div class="left-container image-container">
            <img src="<?= $book['b_image'] ?: '/images/default-cover.jpg' ?>" alt="Couverture du livre">
        </div>

        <div class="right-container">
            <h1><?= $book['b_title'] ?></h1>
            <p class="author">Par <?= $book['b_author'] ?></p>

            <div class="sep"></div>

            <span class="title">Description</span>
            <p class="description"><?= $book['b_description'] ?></p>

            <span class="title">Propriétaire</span>
            <a href="/dashboard/profile/<?= $book['u_username'] ?>" class="user">
                <div class="image-container">
                    <img src="<?= $book['u_avatar'] ?: '/images/default-avatar.jpg' ?>"
                        alt="Avatar de <?= $book['u_username'] ?>">
                </div>
                <p><?= $book['u_username'] ?></p>
            </a>
        </div>

    </div>

</div>