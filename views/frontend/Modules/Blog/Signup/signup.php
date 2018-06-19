<?php $title = 'Inscription'; ?>
<?php ob_start(); ?>
    <div class="container">
        <?php require "views/frontend/Modules/Blog/Signup/form_signup.php"; ?>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'views/frontend/templates/template.php'; ?>