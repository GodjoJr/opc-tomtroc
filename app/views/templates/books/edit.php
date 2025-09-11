<div id="edit-book" class="container">

        <div class="breadcrumbs container"><img src="/icons/arrow-back.svg" alt="icone de retour"><a href="/dashboard/profile/<?= $_SESSION['user']['username'] ?>">Retour</a></div>


    <h1>Modifier les informations</h1>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="left-container image-container">
            <label for="cover">Photo</label>
            
            <img id="preview" src="<?= $book['b_image'] ?? '' ?>" alt="Aperçu de l'image">

            <input type="file" name="cover" id="cover" accept="image/*" style="display:none" onchange="previewImage(this)">
            
            <button class="file-btn" type="button" onclick="document.getElementById('cover').click();">
                Modifier la photo
            </button>
        </div>

        <div class="right-container">

            <label for="title">Titre</label>
            <input type="text" name="title" id="title" value="<?= $book['b_title'] ?? '' ?>">

            <label for="author">Auteur</label>
            <input type="text" name="author" id="author" value="<?= $book['b_author'] ?? '' ?>">

            <label for="commentary">Description</label>
            <textarea name="commentary" id="commentary" cols="30"
                rows="10"><?= $book['b_description'] ?? '' ?></textarea>

            <label for="availaibility">Disponibilité</label>
            <select name="availaibility" id="availaibility">
                <option value="available">Disponible</option>
                <option value="unavailable">Indisponible</option>
            </select>

            <button type="submit">Modifier</button>

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