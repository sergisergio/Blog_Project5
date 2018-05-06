<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>

<body class="full-layout">
    <div class="body-wrapper">
        <?php include "includes/nav.php"; ?>
            <!-- /#home -->
        <div class="container">
            <?php include "forms/form_login.php"; ?></div>
            <!-- /.container -->
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>