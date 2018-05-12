<div class="form-container">
    <div class="response alert"></div>
        <?php if(isset($_SESSION['flash'])): ?>
            <?php foreach($_SESSION['flash'] as $type => $message): ?>
                <div class="text-center alert alert-<?= $type; ?>">
                    <?= $message; ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
<form action="index.php?action=adminModifyComment&amp;id=<?= $comment['id'] ?>" method="post">
    <div>
        <label for="content">Commentaire</label><br />
        <textarea id="content" name="content"><?= htmlspecialchars($comment['content']) ?></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
</div>