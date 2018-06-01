<?php $title = 'Profil membre'; ?>
<?php ob_start(); ?>
    <div class="container inner">
        <div class="blog box mgbottom2 row">
            <div class="col-md-12">
                <!-- INCLUDE TOP -->
                <?php include 'view/frontend/includes/top.php' ?>
                <!-- END INCLUDE TOP -->
            </div>
        </div>
        <div class="blog list-view row">
            <div class="col-md-offset-2 col-md-8 col-sm-12 content">
                <div class="blog-posts">
                    <div class="post box">
                        <div class="row">
                            <div class="col-sm-12 post-content">
                                <img class="img-responsive img-circle avatarblogpage2" src="public/images/avatar/<?= $user->getAvatar() ?>" />
                                Pseudo : <?= $user->getPseudo() ?><br />
                                Prénom : <?= $user->getFirstName() ?><br />
                                Nom : <?= $user->getLastName() ?><br />
                                Email : <?= $user->getEmail() ?><br />
                                Date d'inscription : <?= $user->getRegistrationDate() ?><br />
                                Statut : 
                                <?php if($user->getAuthorization1() == 1): ?>
                                    <?= 'Administrateur' ?><br />
                                <?php else: ?>
                                    <?= 'Utilisateur' ?><br />
                                <?php endif; ?>
                                Bio : <?= $user->getDescription() ?>
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
            <?php include "view/frontend/includes/footer.php"; ?>
            <!-- END INCLUDE FOOTER -->
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
    <?php require('view/frontend/templates/template.php'); ?>