<?php if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(isset($_SESSION['pseudo'])){
        
        header('Location: index.php?action=blog');
        exit();
    }
?>

<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>

<body class="full-layout">
    <div class="body-wrapper">
        <?php include "includes/nav.php"; ?>
            <!-- /#home -->
        <div class="container">

            <?php include "forms/form_login.php"; ?>
            
        </div>
            <!-- /.container -->
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>