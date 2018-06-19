<?php $title = 'Connexion'; ?>
<?php ob_start(); ?>
    <div class="container">
        <?php require "views/frontend/Modules/Blog/Login/form_login.php"; ?></div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require 'views/frontend/templates/template.php'; ?>