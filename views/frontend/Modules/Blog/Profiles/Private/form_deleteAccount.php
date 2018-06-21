<form action="index.php?action=deleteAccount&amp;id=<?php echo $_SESSION['id'] ?>" method="post">
	<input type="hidden" name="token" id="token" value="<?= $csrfDeleteAccountToken; ?>" />
    <input type="submit" value="Supprimer mon compte" data-toggle='confirmation' id="important_action" />
</form>