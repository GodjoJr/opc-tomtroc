<div class="homepage">

    <section class="hero">
        <div class="left-container">
            <h1>Rejoignez nos lecteurs passionnés</h1>
            <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons
                en la magie du partage de connaissances et d'histoires à travers les livres. </p>
            <a href="/books/archive" class="btn">Découvrir</a>
        </div>

        <div class="right-container image-container">
            <img src="/images/tomtroc-bookshelf.webp" alt="">
            <p>Hamza</p>
        </div>
    </section>

    <section class="last-books">

        <h2>Les derniers livres</h2>

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

        <a class="btn" href="/books/archive">Voir tous les livres</a>
    </section>

    <section class="how-does-that-work">

        <h2>Comment ça marche ?</h2>

        <div class="how-does-that-work-grid">
            <article class="card">
                <p>Inscrivez-vous gratuitement sur
                    notre plateforme.</p>
            </article>

            <article class="card">
                <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
            </article>

            <article class="card">
                <p>Parcourez les livres disponibles chez d'autres membres.</p>
            </article>

            <article class="card">
                <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
            </article>
        </div>

        <a class="btn transparent" href="/books/archive">Voir tous les livres</a>

    </section>

    <section class="image-full image-container">
        <img src="/images/tomtroc-bookshelf.webp" alt="Etagère de livres">
    </section>

    <section class="our-values">

        <div class="content">

            <h2>Nos valeurs</h2>

            <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont
                ancrées
                dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en
                la
                puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.

                Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.

                Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se
                connecter,
                de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les
                étagères.</p>

            <p class="signing">L’équipe Tom Troc</p>

        </div>

    </section>


</div>