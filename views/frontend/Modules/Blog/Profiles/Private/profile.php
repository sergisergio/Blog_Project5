<?php $title = 'Profil membre'; ?>
<?php ob_start(); ?>
    <div class="container inner">
        <div class="blog box mgbottom2 row">
            <div class="col-md-12">
                <?php require 'views/frontend/Modules/Blog/Top/top.php' ?>
            </div>
        </div>
        <div class="blog list-view row">
            <div class="col-md-offset-2 col-md-8 col-sm-12 content">
                <div class="blog-posts">
                    <div class="post box">
                        <div class="row">
                            <div class="col-sm-12 post-content">
                                <div class="meta">
                                    <?php require 'views/frontend/Modules/ResponseAlert/responseAlert.php'; ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                    <p>
                                        <?php if ($_SESSION['avatar'] != '') : ?> 
                                            <img class="img-responsive img-circle avatarprofile" alt="avatar" style="width: 50%;" src="public/images/avatar/<?php echo $_SESSION['avatar']; ?>" />
                                        <?php else: ?> <img class="img-responsive img-circle avatarprofile" src="public/images/avatar/avatardefaut.png" alt="avatar" />
                                        <?php endif; ?>
                                    </p>
                                        </div>
                                        <div class="col-md-8">
                                    <p>Pseudo :
                                        
                                        <?php echo $post->getPseudo(); ?>&nbsp;&nbsp;
                                    </p>
                                    <p>Date d'inscription :
                                        <?php echo $post->getRegistration_date(); ?>
                                    </p>
                                    <p>Mode :
                                        <?php if($post->getAuthorization() == 1) : ?>
                                        <?php echo 'Administrateur' ?>
                                        <?php else: ?>
                                        <?php echo 'Utilisateur' ?>
                                        <?php endif; ?>
                                    </p>
                                        </div>
                                    </div>
                                </div>
                                <?php require 'views/frontend/Modules/Blog/Profiles/Private/formProfile.php' ?>
                                <hr>
                                <?php require 'views/frontend/Modules/Blog/Profiles/Private/form_deleteAccount.php' ?>
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
            <?php require "views/frontend/Modules/Footer/footer.php"; ?>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
    <?php require 'views/frontend/templates/template.php'; ?>