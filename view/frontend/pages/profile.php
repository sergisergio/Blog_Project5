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
                                <div class="meta">
                                    <!-- INCLUDE RESPONSES -->
                                    <?php require 'view/frontend/includes/responseAlert.php'; ?> 
                                    <!-- END INCLUDE RESPONSES -->
                                    <div class="row">
                                        <div class="col-md-4">
                                    <p>
                                        <?php if ($_SESSION['avatar'] != '') : ?> 
                                            <img class="img-responsive img-circle avatarprofile" style="width: 50%;" src="public/images/avatar/<?php echo $_SESSION['avatar']; ?>" />
                                        <?php else: ?> <img class="img-responsive img-circle avatarprofile" src="public/images/avatar/avatardefaut.png" />
                                        <?php endif; ?>
                                    </p>
                                        </div>
                                        <div class="col-md-8">
                                    <p>Pseudo :
                                        
                                        <?php echo $post->getPseudo(); ?>&nbsp;&nbsp;
                                    </p>
                                    <p>Date d'inscription :
                                        <?php echo $post->getRegistrationDate(); ?>
                                    </p>
                                    <p>Mode :
                                        <?php if($post->getAuthorization1() == 1) : ?>
                                        <?php echo 'Administrateur' ?>
                                        <?php else: ?>
                                        <?php echo 'Utilisateur' ?>
                                        <?php endif; ?>
                                    </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FORM MODIFY PROFILE -->
                                <?php require 'view/frontend/forms/formProfile.php' ?>
                                <!-- END FORM MODIFY PROFILE -->
                                <hr>
                                <?php require 'view/frontend/forms/form_deleteAccount.php' ?>
                                <!--<btn class="btn btn-default">
                                    <a href="index.php?action=deleteAccount&amp;id=<?php echo $_SESSION['id'] ?>" data-toggle='confirmation' id="important_action">Supprimer mon compte</a>
                                </btn>-->
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