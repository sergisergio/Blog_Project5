<?php include 'views/frontend/modules/responseAlert/responseAlert.php'; ?>
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