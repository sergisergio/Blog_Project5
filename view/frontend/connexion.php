<?php $title = 'Connexion'; ?>
<?php ob_start(); ?>

<body class="full-layout">
    <div class="body-wrapper">
        <?php include "includes/nav.php"; ?>
            <!-- /#home -->
        <div class="container">
            <?php include "includes/form_connexion.php"; ?>
        </div>
            <!-- /.container -->
    </div>
    <!-- /.body-wrapper -->
    <?php include "includes/foot.php"; ?>
</body>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>