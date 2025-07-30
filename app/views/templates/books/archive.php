<div class="books-archive">

    <div class="top-container">
        <h1>Nos livres à l'échange</h1>
        <form action="" method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="search" name="search" id="search" placeholder="Rechercher un livre">
            <button type="submit">Rechercher</button>
        </form>
    </div>

    <div class="books-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
        <?php foreach ($books as $book): ?>
            <article class="book-card">
                <a href="/books/detail/<?= $book['b_id'] ?>">
                    <img style="max-width: 150px; max-height: 100px;" src="<?= $book['b_image'] ?>"
                        alt="Cover de <?= $book['b_title'] ?>">
                    <p class="title"><?= $book['b_title'] ?></>
                        <p class="author"><?= $book['b_author'] ?></p>
                        <p class="user">Vendu par : <?= $book['u_username'] ?></p>
                </a>
            </article>
        <?php endforeach; ?>
    </div>
</div>