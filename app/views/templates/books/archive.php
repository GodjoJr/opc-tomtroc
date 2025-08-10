<div class="books-archive">

    <div class="top-container">
        <h1>Nos livres à l'échange</h1>
        <form action="" method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <div class="search-container">
                <img src="/icons/search-icon.svg" alt="Icone de recherche">
                <input type="search" name="search" id="search" placeholder="Rechercher un livre">
            </div>
        </form>
    </div>

    <div class="books-grid">
        <?php foreach ($books as $book): ?>
            <article class="book-card">
                <a href="/books/detail/<?= $book['b_id'] ?>">
                    <div class="image-container">
                        <img src="<?= $book['b_image'] ?>" alt="Cover de <?= $book['b_title'] ?>">
                    </div>
                    <div class="content">
                        <p class="title"><?= $book['b_title'] ?></p>
                        <p class="author"><?= $book['b_author'] ?></p>
                        <p class="user">Vendu par : <?= $book['u_username'] ?></p>
                    </div>
                </a>
            </article>
        <?php endforeach; ?>
    </div>
</div>