<?php $title = 'Modifier le mot de passe'; ?>
<?php ob_start(); ?>
    <div class="container">
    <?php include "views/frontend/Modules/blog/forgetPassword/form_changePassword.php"; ?>
    </div>
   </div>
<?php $content = ob_get_clean(); ?>
    <?php include 'views/frontend/templates/template.php'; ?>