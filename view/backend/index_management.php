<?php if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ){
        header('Location: index.php?action=noAdmin');
        exit();
    }
?>
<?php $title = 'Administration'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
    <?php include "view/frontend/includes/nav.php"; ?>
        <div class="container">
            <?php include "includes/management.php"; ?>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>