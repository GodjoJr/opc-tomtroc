<div id="create-book" class="container">

    <div class="breadcrumbs container"><img src="/icons/arrow-back.svg" alt="icone de retour"><a href="/dashboard/profile/<?= $_SESSION['user']['username'] ?>">Retour</a></div>

    <h1>Ajouter un livre</h1>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="left-container image-container">
            <label for="cover">Photo</label>

            <img id="preview" src="/images/default-cover.png" alt="Aperçu de l'image">

            <input type="file" name="cover" id="cover" accept="image/*" style="display:none"
                onchange="previewImage(this)">

            <button class="file-btn" type="button" onclick="document.getElementById('cover').click();">
                Ajouter une couverture
            </button>
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

<script>
function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>