<div class="form-container">
    <div class="response alert"></div>
    <?php require 'view/frontend/includes/responseAlert.php'; ?>       
                
<form action="index.php?action=addcomment&amp;id=<?php echo $post->getId() ?>" method="post">
    <div>
        <label for="content">Commentaire</label>
        <br />
        <textarea id="content" name="content"></textarea>
    </div>
    <p class="text-center">Votre commentaire sera publié dans les plus brefs délais après modération</p>
    <div class="text-center">
        <input class="btn btn-default validate" type="submit" />
    </div>
</form>
</div>