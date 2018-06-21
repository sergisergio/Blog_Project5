<div class="form-container">
    <div class="response alert"></div>
    <?php include 'views/frontend/modules/responseAlert/responseAlert.php'; ?>
<form action="index.php?action=addcomment&amp;id=<?= $post->getId() ?>" method="post">
    <div>
        <label for="content">Commentaire</label>
        <br />
        <textarea id="content" name="content"></textarea>
    </div>
    <p class="text-center">Votre commentaire sera publié dans les plus brefs délais après modération</p>
    <div class="text-center">
        <input class="btn btn-default validate" type="submit" />
    </div>
    <div>
        <input type="hidden" name="token" id="token" value="<?= $csrfAddCommentToken; ?>" />
    </div>
</form>
</div>