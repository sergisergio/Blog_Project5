<?php $title = 'Inscription'; ?>
<?php ob_start(); ?>
    <div class="container">
    	<?php include "forms/form_signup.php"; ?>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>