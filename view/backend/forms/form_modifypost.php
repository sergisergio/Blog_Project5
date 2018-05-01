<form action="index.php?action=modifyPost&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" />
    </div>

    <div>
        <label for="intro">Intro</label><br />
        <input type="text" id="intro" name="intro" value="<?= htmlspecialchars($post['intro']) ?>" />
    </div>

    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="<?= htmlspecialchars($post['author']) ?>" />
    </div>

    <div>
        <label for="content">Article</label><br />

        <textarea id="content" name="content"><?= htmlspecialchars($post['content']) ?></textarea>
    </div>

    <div>
        <input type="submit" />
    </div>
</form>