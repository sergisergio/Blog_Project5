<?php $title = 'Profil membre'; ?>
<?php ob_start(); ?>
    <div class="container inner">
        <div class="blog box mgbottom2 row">
            <div class="col-md-12">
                <?php require 'App/frontend/Modules/Blog/Top/top.php' ?>
            </div>
        </div>
        <div class="blog list-view row">
            <div class="col-md-offset-2 col-md-8 col-sm-12 content">
                <div class="blog-posts">
                    <div class="post box">
                        <div class="row">
                            <div class="col-sm-12 post-content">
                                <img class="img-responsive img-circle avatarblogpage2" src="Web/images/avatar/<?php echo $user->getAvatar() ?>" />
                                Pseudo : <?php echo $user->getPseudo() ?><br />
                                Prénom : <?php echo $user->getFirst_name() ?><br />
                                Nom : <?php echo $user->getLast_name() ?><br />
                                Email : <?php echo $user->getEmail() ?><br />
                                Date d'inscription : <?php echo $user->getRegistration_date() ?><br />
                                Statut : 
                                <?php if($user->getAuthorization() == 1) : ?>
                                    <?php echo 'Administrateur' ?><br />
                                <?php else: ?>
                                    <?php echo 'Utilisateur' ?><br />
                                <?php endif; ?>
                                Bio : <?php echo $user->getDescription() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 content"> </div>
        </div>
    </div>
    <div class="container bottomcontainer">
        <div class="row">
            <?php require "App/frontend/Modules/Footer/footer.php"; ?>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
    <?php require 'App/frontend/templates/template.php'; ?>