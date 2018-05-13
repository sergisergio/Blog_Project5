<?php $title = 'Confirmation d\'inscription;' ?>
<?php ob_start(); ?>
    <div class="container">
        <div class="divide30"></div>
        <div class="col-md-offset-2 col-md-6 col-sm-12"></div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php if(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'aqua'): ?>
    <?php require('view/frontend/colortemplates/aquatemplate.php'); ?>
<?php if(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'blue'): ?>
    <?php require('view/frontend/colortemplates/bluetemplate.php'); ?>
<?php if(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'gray'): ?>
    <?php require('view/frontend/colortemplates/graytemplate.php'); ?>
<?php if(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'orange'): ?>
    <?php require('view/frontend/colortemplates/orangetemplate.php'); ?>
<?php if(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'pink'): ?>
    <?php require('view/frontend/colortemplates/pinktemplate.php'); ?>
<?php if(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'aqua'): ?>
    <?php require('view/frontend/colortemplates/aquatemplate.php'); ?>
<?php if(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'red'): ?>
    <?php require('view/frontend/colortemplates/redtemplate.php'); ?>
<?php if(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'yellow'): ?>
    <?php require('view/frontend/colortemplates/yellowtemplate.php'); ?>
<?php else: ?>
    <?php require('template.php'); ?>
<?php endif; ?>