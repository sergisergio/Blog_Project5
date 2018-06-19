<div class="form-container">
    <div class="response alert"></div>
    <?php require 'views/frontend/Modules/responseAlert/responseAlert.php'; ?>       
    <?php      
        $csrfAddCommentToken = md5(time()*rand(1, 1000));
        $_SESSION['csrfAddCommentToken'] = $csrfAddCommentToken;        
    ?>
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