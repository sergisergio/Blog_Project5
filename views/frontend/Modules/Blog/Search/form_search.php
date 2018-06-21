<form class="searchform" method="post" action="index.php?action=search">
	<input type="text" id="search" name="search" value="Rechercher" onfocus="this.value=''" onblur="this.value='Rechercher'"/>
    <input type="hidden" name="token" id="token" value="<?= $csrfSearchToken; ?>" />
</form>