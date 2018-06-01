<?php $title = 'Modifier le mot de passe'; ?>
<?php ob_start(); ?>
	<div class="container">
		<?php include "view/frontend/forms/form_changePassword.php"; ?>
    </div>
   </div>
<?php $content = ob_get_clean(); ?>
    <?php require('template.php'); ?>