<?php if(isset($_SESSION['flash'])) : ?>
                <?php foreach($_SESSION['flash'] as $type => $message): ?>
                    <div class="alert alert-<?php echo $type; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endforeach; ?>
                <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
<form action="index.php?action=modifyComment&amp;id=<?php echo $comment['id'] ?>" method="post">
    <div>
        <label for="content">Commentaire</label><br />
        <textarea id="content" name="content"><?php echo htmlspecialchars($comment['content']) ?></textarea>
      </div>
      <div class="text-center">
        <input  class="btn btn-default validate" type="submit" />
      </div>
</form>