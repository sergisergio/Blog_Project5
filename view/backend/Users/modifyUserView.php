<?php $title = 'Gestion des membres'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
        <?php include "view/frontend/includes/nav.php"; ?>
            <div class="container">
                <?php include "view/backend/includes/management.php"; ?>
                <h2 class="text-center">Gestion des membres</h2>
                <div class="post box">
                    <div class="row">
                        <h2 class="text-center">Modifier un membre</h2>
                        <?php include "view/backend/forms/form_modifyuser.php" ?>
                    </div>
                </div>
            </div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php require('view/backend/template.php'); ?>