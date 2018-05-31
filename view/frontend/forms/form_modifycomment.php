<?php include 'view/frontend/includes/responseAlert.php'; ?> 
<form action="index.php?action=modifyComment&amp;id=<?= $comment->getId() ?>&amp;postId=<?= $post->getId() ?>" method="post">
    <div>
        <label for="content">Commentaire</label><br />
        <textarea id="content" name="content"><?= htmlspecialchars($comment->getContent()) ?></textarea>
      </div>
      <div class="text-center">
        <input  class="btn btn-default validate" type="submit" />
      </div>
</form>