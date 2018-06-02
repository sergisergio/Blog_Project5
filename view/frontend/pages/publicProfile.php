<?php $title = 'Profil membre'; ?>
<?php ob_start(); ?>
    <div class="container inner">
        <div class="blog box mgbottom2 row">
            <div class="col-md-12">
                <!-- INCLUDE TOP -->
                <?php require 'view/frontend/includes/top.php' ?>
                <!-- END INCLUDE TOP -->
            </div>
        </div>
        <div class="blog list-view row">
            <div class="col-md-offset-2 col-md-8 col-sm-12 content">
                <div class="blog-posts">
                    <div class="post box">
                        <div class="row">
                            <div class="col-sm-12 post-content">
                                <img class="img-responsive img-circle avatarblogpage2" src="public/images/avatar/<?php echo $user->getAvatar() ?>" />
                                Pseudo : <?php echo $user->getPseudo() ?><br />
                                Prénom : <?php echo $user->getFirstName() ?><br />
                                Nom : <?php echo $user->getLastName() ?><br />
                                Email : <?php echo $user->getEmail() ?><br />
                                Date d'inscription : <?php echo $user->getRegistrationDate() ?><br />
                                Statut : 
                                <?php if($user->getAuthorization1() == 1) : ?>
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
            <!-- INCLUDE FOOTER -->
            <?php require "view/frontend/includes/footer.php"; ?>
            <!-- END INCLUDE FOOTER -->
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
    <?php require 'view/frontend/templates/template.php'; ?>