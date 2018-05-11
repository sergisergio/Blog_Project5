<?php $title = 'Connexion'; ?>
<?php ob_start(); ?>
    <div class="container">
        <?php include "forms/form_login.php"; ?></div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>