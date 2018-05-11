<?php $title = 'Connexion'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
        <?php include "view/frontend/includes/nav.php"; ?>
        <div class="container">
        	<?php include "view/backend/forms/form_login.php"; ?>
       	</div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>