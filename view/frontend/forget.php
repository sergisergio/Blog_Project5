<?php $title = 'Mot de passe oublié'; ?>

<?php ob_start(); ?>

    
            <!-- /#home -->
        <div class="container">

            <?php include "forms/form_forget.php"; ?>
            
        </div>
            <!-- /.container -->
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>