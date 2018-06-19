<?php $title = 'Modifier le mot de passe'; ?>
<?php ob_start(); ?>
    <div class="container">
    <?php require "views/frontend/Modules/Blog/ForgetPassword/form_changePassword.php"; ?>
    </div>
   </div>
<?php $content = ob_get_clean(); ?>
    <?php require 'views/frontend/templates/template.php'; ?>