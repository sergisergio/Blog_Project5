<?php $title = 'Administration'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
    <?php require "view/frontend/includes/nav.php"; ?>
        <div class="container">
            <?php require "view/backend/includes/management.php"; ?>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/backend/templates/template.php'; ?>