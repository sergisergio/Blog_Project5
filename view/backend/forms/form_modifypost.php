<form action="index.php?action=modifyPost&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" />
    </div>
    <div>
        <label for="content">Article</label><br />

        <textarea id="content" name="content"><?= htmlspecialchars($post['content']) ?></textarea>
    </div>
    <div>
        <input class="btn btn-default" type="submit" style="width: 100px;display: block; margin: 0 auto;"/>
    </div>
</form>