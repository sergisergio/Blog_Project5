<?php $title = 'Connexion'; ?>
<?php ob_start(); ?>
    <div class="container">
        <?php require "view/frontend/forms/form_login.php"; ?></div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/frontend/templates/template.php'; ?>