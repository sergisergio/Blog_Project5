<?php $title = 'Zone interdite'; ?>
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
                            <div class="alert alert-danger">Vous n'avez pas les droits pour accéder à cette page...</div>
                            </div>
                            <btn class="btn btn-default"><a href="index.php">Accueil</a></btn>
                            <btn class="btn btn-default"><a href="index.php?action=blog">blog</a></btn>
                        </div>
                    </section>
                </div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>