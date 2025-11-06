<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title><?= $title ?? "" ?></title>
</head>

<body>
    <?php include "components/components_navbar.php"; ?>

    <h1>Ajouter un livre</h1>
    <form action="/book" method="POST">
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" rows="4" required></textarea>

         <label for="author">Auteur :</label>
        <input type="text" id="author" name="author" required>

        <label for="publication_date">Date de parution :</label>
        <input type="date" id="publication_date" name="publication_date" required>

        <label for="id_category">Catégorie :</label>
        <select id="id_category" name="id_category" >
            <option value="">Sélectionner une catégorie </option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['id_category'] ?>">
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="submit">Ajouter</button>
    </form>
    <?php include "components/components_footer.php"; ?>


</body>

</html>