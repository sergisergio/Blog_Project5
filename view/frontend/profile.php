<?php $title = 'Mon blog'; ?>
        <?php ob_start(); ?>

            <body class="full-layout">
                <div class="body-wrapper">
                    <?php include "includes/nav.php"; ?>
                        <div class="container inner">
                            <div class="blog box mgbottom row" style="margin-bottom: 50px;">
                                <div class="col-md-12">
                                    <?php if (isset($_SESSION['pseudo'])): ?>
                                        <p class="pull-left">
                                            <btn class="btn btn-default"> <a href="index.php?action=blog">Revenir au blog</a> </btn>
                                        </p>
                                        <p class="pull-right">
                                            <btn style="float: right;" class="btn btn-default"> <a href="index.php?action=logout">Déconnexion</a> </btn>
                                            <?php if ($_SESSION['avatar'] != ''): ?> <img style="width: 10%;float: right;margin: 0 20px;" class="img-responsive img-circle" src="public/images/avatar/<?php echo $_SESSION['avatar']; ?>" />
                                                <?php else: ?> <img style="width: 5%;float: right;margin: 0 20px;" class="img-responsive img-circle" style="width: 5%;" src="public/images/avatar/avatardefaut.png" />
                                                    <?php endif; ?>
                                        </p>
                                        <?php else: ?>
                                            <p class="pull-right">
                                                <btn class="btn btn-default"> <a href="index.php?action=loginPage">Connexion</a> </btn>
                                            </p>
                                            <p class="pull-right">
                                                <btn class="btn btn-default"> <a href="index.php?action=signupPage">Inscription</a> </btn>&nbsp;&nbsp; </p>
                                            <?php endif; ?>
                                </div>
                            </div>
                            <div class="blog list-view row">
                                <div class="col-md-6 col-sm-12 content">
                                    <div class="blog-posts">
                                        <div class="post box">
                                            <div class="row">
                                                <div class="col-sm-12 post-content">
                                                    <div class="meta">
                                                        <p>Avatar :
                                                            <?php if ($_SESSION['avatar'] != ''): ?> <img class="img-responsive img-circle" style="width: 20%;" src="public/images/avatar/<?php echo $_SESSION['avatar']; ?>" />
                                                                <?php else: ?> <img class="img-responsive img-circle" style="width: 20%;" src="public/images/avatar/avatardefaut.png" />
                                                                    <?php endif; ?>
                                                        </p>
                                                        <!--<span class="category">Journal</span>-->
                                                        <p>Pseudo :
                                                            <?php echo $_SESSION['pseudo']; ?>
                                                        </p>
                                                        <!--<span class="comments"><a href="#">8 <i class="icon-chat-1"></i></a></span>-->
                                                        <p>Prénom :
                                                            <?php echo $_SESSION['prenom']; ?>
                                                        </p>
                                                        <p>Nom :
                                                            <?php echo $_SESSION['nom']; ?>
                                                        </p>
                                                        <p>Email :
                                                            <?php echo $_SESSION['email']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- /column -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.post -->
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 content"> </div>
                            </div>
                            <!-- /.blog -->
                        </div>
                        <!-- /.container -->
                        <div class="container" style="margin-top: 130px;">
                            <div class="row">
                                <?php include "includes/footer.php"; ?>
                            </div>
                        </div>
                </div>
                <?php $content = ob_get_clean(); ?>
                    <?php require('template.php'); ?>