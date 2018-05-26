<?php $title = 'Zone interdite'; ?>
    <?php ob_start(); ?><body class="full-layout">
        <div class="body-wrapper">
            <?php require "view/frontend/includes/nav.php"; ?>
                <div class="container">
                    <section>
                        <div class="blog box mgbottom2 row">
                            <div class="col-md-12">
                                <?php if (isset($_SESSION['pseudo'])) : ?>
                                    <p class="pull-left">
                                        <btn class="btn btn-default"> <a href="index.php?action=profilePage">Voir mon profil</a> </btn>
                                    </p>
                                    <p class="pull-right">
                                        <btn class="btn btn-default logoutbtn"> <a href="index.php?action=logout">Déconnexion</a> </btn>
                                            <?php if ($_SESSION['avatar'] != '') : ?> <img class="img-responsive img-circle avatarblogpage" src="public/images/avatar/<?php echo $_SESSION['avatar']; ?>" />
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
                            <p></p>
                            <div class="divide30"></div>
                            <div class="form-container">
                            <div class="alert alert-danger" style="font-weight: bold; text-align:center;">Vous n'avez pas les droits pour accéder à cette page...</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <btn class="btn btn-default pull-right"><a href="index.php">Accueil</a></btn>
                                </div>
                                <div class="col-md-6">
                                    <btn class="btn btn-default pull-left"><a href="index.php?action=blog">blog</a></btn>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/frontend/templates/template.php'; ?>