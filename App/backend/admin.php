<?php $title = 'Administration'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
    <?php require "App/frontend/includes/nav.php"; ?>
        <div class="container">
            <?php require "App/backend/includes/management.php"; ?>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require 'App/backend/templates/template.php'; ?>