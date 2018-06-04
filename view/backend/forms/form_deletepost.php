<?php      
    $csrfDeletePostToken = md5(time()*rand(1, 1000));
    $_SESSION['csrfDeletePostToken'] = $csrfDeletePostToken;        
?>
<form action="" method="post">
    <input type="submit" value="Supprimer" style="width: auto;margin-top: 20px;" data-toggle='confirmation' id="important_action"/>
    <input type="hidden" name="token" id="token" value="<?= $csrfDeletePostToken; ?>" />
</form>