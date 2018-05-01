<form action="index.php?action=adminModifyComment&amp;id=<?= $comment['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="<?= htmlspecialchars($comment['author']) ?>" />
    </div>
    <div>
        <label for="content">Commentaire</label><br />
        <textarea id="content" name="content"><?= htmlspecialchars($comment['content']) ?></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>