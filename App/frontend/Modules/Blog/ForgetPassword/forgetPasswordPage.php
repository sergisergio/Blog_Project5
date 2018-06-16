<?php $title = 'Mot de passe oublié'; ?>
<?php ob_start(); ?>
    <div class="container">
        <?php require "App/frontend/Modules/Blog/ForgetPassword/form_forget.php"; ?>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
    <?php require 'App/frontend/templates/template.php'; ?>