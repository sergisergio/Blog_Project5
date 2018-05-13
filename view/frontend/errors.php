<?php $title = 'Erreur'; ?>
    <?php ob_start(); ?><body class="full-layout">
        <div class="body-wrapper">
            <?php include "view/frontend/includes/nav.php"; ?>
                <div class="container">
                    <section>
                        <div class="blog box mgbottom2 row">
                            <div class="col-md-12">
                                <?php if (isset($_SESSION['pseudo'])): ?>
                                    <p class="pull-left">
                                        <btn class="btn btn-default"> <a href="index.php?action=profilePage">Voir mon profil</a> </btn>
                                    </p>
                                    <p class="pull-right">
                                        <btn class="btn btn-default logoutbtn"> <a href="index.php?action=logout">Déconnexion</a> </btn>
                                            <?php if ($_SESSION['avatar'] != ''): ?> <img class="img-responsive img-circle avatarblogpage" src="public/images/avatar/<?= $_SESSION['avatar']; ?>" />
                                            <?php else: ?> <img class="img-responsive img-circle avatarblogpagedefault" src="public/images/avatar/avatardefaut.png" />
                                            <?php endif; ?>
                                    </p>
                                <?php else: ?>
                                    <p class="pull-right">
                                        <btn class="btn btn-default"> 
                                            <a href="index.php?action=loginPage">Connexion</a> 
                                        </btn>
                                    </p>
                                    <p class="pull-right">
                                        <btn class="btn btn-default"> 
                                            <a href="index.php?action=signupPage">Inscription</a> 
                                        </btn>&nbsp;&nbsp; 
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="box">
                            <h2 class="section-title text-center">Erreur</h2>
                            <p></p>
                            <div class="divide30"></div>
                            <div class="form-container">
                            <?php if(isset($_SESSION['flash'])): ?>
                                <?php foreach($_SESSION['flash'] as $type => $message): ?>
                                <div class="text-center alert alert-<?= $type; ?>">
                                    <?= $message; ?>
                                </div>
                                <?php endforeach; ?>
                                <?php unset($_SESSION['flash']); ?>
                            <?php endif; ?>
                            </div>
                            <btn class="btn btn-default"><a href="index.php">Accueil</a></btn>
                            <btn class="btn btn-default"><a href="index.php?action=blog">blog</a></btn>
                        </div>
                    </section>
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