<?php $title = 'Connexion'; ?>
<?php ob_start(); ?>
    <div class="container">
    	<!-- FORM LOGIN -->
        <?php require "view/frontend/forms/form_login.php"; ?></div>
        <!-- END FORM LOGIN -->
    </div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/frontend/templates/template.php'; ?>