<?php $title = 'Inscription'; ?>
<?php ob_start(); ?>
    <div class="container">
        <?php include "views/frontend/modules/blog/signup/form_signup.php"; ?>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include 'views/frontend/templates/template.php'; ?>