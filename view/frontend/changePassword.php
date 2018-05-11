<?php $title = 'Modifier le mot de passe'; ?>

<?php ob_start(); ?>

    
            <!-- /#home -->
        <div class="container">

            <?php include "forms/form_changePassword.php"; ?>
            
        </div>
            <!-- /.container -->
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>