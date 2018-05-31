<?php $title = 'Profil membre'; ?>
<?php ob_start(); ?>
    <div class="container inner">
        <div class="blog box mgbottom2 row">
            <div class="col-md-12">
                <?php include 'view/frontend/includes/top.php' ?>
            </div>
        </div>
        <div class="blog list-view row">
            <div class="col-md-offset-2 col-md-8 col-sm-12 content">
                <div class="blog-posts">
                    <div class="post box">
                        <div class="row">
                            <div class="col-sm-12 post-content">
                                <div class="meta">
                                    <?php include 'view/frontend/includes/responseAlert.php'; ?> 
                                    <div class="row">
                                        <div class="col-md-4">
                                    <p>
                                        <?php if ($_SESSION['avatar'] != ''): ?> 
                                            <img class="img-responsive img-circle avatarprofile" style="width: 50%;" src="public/images/avatar/<?= $_SESSION['avatar']; ?>" />
                                        <?php else: ?> <img class="img-responsive img-circle avatarprofile" src="public/images/avatar/avatardefaut.png" />
                                        <?php endif; ?>
                                    </p>
                                        </div>
                                        <div class="col-md-8">
                                    <p>Pseudo :
                                        
                                        <?= $post->getPseudo(); ?>&nbsp;&nbsp;
                                    </p>
                                    <p>Date d'inscription :
                                        <?= $post->getRegistrationDate(); ?>
                                    </p>
                                    <p>Mode :
                                        <?php if($post->getAuthorization1() == 1): ?>
                                        <?= 'Administrateur' ?>
                                        <?php else: ?>
                                        <?= 'Utilisateur' ?>
                                        <?php endif; ?>
                                    </p>
                                        </div>
                                    </div>
                                </div>
                                <?php require 'view/frontend/forms/formProfile.php' ?>
                                <hr>
                                <btn class="btn btn-default">
                                    <a href="index.php?action=deleteAccount&amp;id=<?= $_SESSION['id'] ?>" data-toggle='confirmation' id="important_action">Supprimer mon compte</a>
                                </btn>
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
            <?php include "view/frontend/includes/footer.php"; ?>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
    <?php require('view/frontend/templates/template.php'); ?>