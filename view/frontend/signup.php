<?php $title = 'Inscription'; ?>
<?php ob_start(); ?>

    <body class="full-layout">
        <!--<div id="preloader"><div id="status"><div class="loadcircle"></div></div></div>-->
        <div class="body-wrapper">
            <?php include "includes/nav.php"; ?>
                <!-- /#home -->
            <div class="container">
                <?php include "forms/form_signup.php"; ?>
            </div>
                <!-- /.container -->
        </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>