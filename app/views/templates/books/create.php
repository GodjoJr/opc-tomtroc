<div id="create-book" class="container">

    <a href="/dashboard/profile/<?= $_SESSION['user']['username'] ?>">Retour</a>


    <h1>Ajouter un livre</h1>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="left-container image-container">
            <label for="cover">Couverture</label>
            <img id="preview" src="#" alt="Aperçu de l'image">
            <input type="file" name="cover" id="cover">

            //
        </div>

        <div class="right-container">

            <label for="title">Titre</label>
            <input type="text" name="title" id="title" value="<?= htmlspecialchars($old['title'] ?? '') ?>">

            <label for="author">Auteur</label>
            <input type="text" name="author" id="author" value="<?= htmlspecialchars($old['author'] ?? '') ?>">

            <label for="commentary">Description</label>
            <textarea name="commentary" id="commentary" cols="30"
                rows="10"><?= htmlspecialchars($old['commentary'] ?? '') ?></textarea>

            <label for="availaibility">Disponibilité</label>
            <select name="availaibility" id="availaibility">
                <option value="available">Disponible</option>
                <option value="unavailable">Indisponible</option>
            </select>

            <button type="submit">Ajouter</button>

        </div>

    </form>

</div>