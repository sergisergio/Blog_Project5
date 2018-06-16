<?php $title = 'Connexion'; ?>
<?php ob_start(); ?>
    <div class="container">
        <?php require "App/frontend/Modules/Blog/Login/form_login.php"; ?></div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require 'App/frontend/templates/template.php'; ?>