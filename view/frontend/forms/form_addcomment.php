<form action="index.php?action=addcomment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="content">Commentaire</label>
        <br />
        <textarea id="content" name="content"></textarea>
    </div>
    <p>Votre commentaire sera publié dans les plus brefs délais après modération</p>
    <div>
        <input class="btn btn-default" type="submit" style="width: 100px;display: block; margin: 0 auto;"/>
    </div>
</form>