<?php $title = 'Mot de passe oublié'; ?>
<?php ob_start(); ?>
    <div class="container">
        <?php include "views/frontend/modules/blog/forgetPassword/form_forget.php"; ?>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
    <?php include 'views/frontend/templates/template.php'; ?>