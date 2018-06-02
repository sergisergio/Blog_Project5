<?php      
    $csrfDeleteCommentToken = md5(time()*rand(1, 1000));
    $_SESSION['csrfDeleteCommentToken'] = $csrfDeleteCommentToken;        
?>
<form action="index.php?action=deleteComment&amp;id=<?php echo $c->getId() ?>&amp;postId=<?php echo $post->getId() ?>" method="post">
    <input type="submit" value="Supprimer" style="width: auto;" data-toggle='confirmation' id="important_action"/>
    <input type="hidden" name="token" id="token" value="<?= $csrfDeleteCommentToken; ?>" />
</form>