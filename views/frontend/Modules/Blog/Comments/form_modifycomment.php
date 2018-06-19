<?php require 'views/frontend/Modules/ResponseAlert/responseAlert.php'; ?> 
<?php      
    $csrfModifyCommentToken = md5(time()*rand(1, 1000));       
?>
<form action="index.php?action=modifyComment&amp;id=<?php echo $comment->getId() ?>&amp;postId=<?php echo $post->getId() ?>" method="post">
    <div>
        <label for="content">Commentaire</label><br />
        <textarea id="content" name="content"><?php echo htmlspecialchars($comment->getContent()) ?></textarea>
    </div>
    <div class="text-center">
        <input  class="btn btn-default validate" type="submit" />
    </div>
    <div>
        <input type="hidden" name="token" id="token" value="<?= $csrfModifyCommentToken; ?>" />
    </div>
</form>