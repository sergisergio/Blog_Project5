<?php $title = 'Profil membre'; ?>
<?php ob_start(); ?>
    <div class="container inner">
        <div class="blog box mgbottom2 row">
            <div class="col-md-12">
                <?php if (isset($_SESSION['pseudo'])): ?>
                    <p class="pull-left">
                        <btn class="btn btn-default"> 
                            <a href="index.php?action=blog">Revenir au blog</a> 
                        </btn>
                    </p>
                    <p class="pull-right">
                        <btn class="btn btn-default logoutbtn"> 
                            <a href="index.php?action=logout">Déconnexion</a> 
                        </btn>
                        <?php if ($_SESSION['avatar'] != ''): ?> 
                            <img class="img-responsive img-circle avatarblogpage2" src="public/images/avatar/<?= $_SESSION['avatar']; ?>" />
                        <?php else: ?> 
                            <img class="img-responsive img-circle avatarblogpagedefault" src="public/images/avatar/avatardefaut.png" />
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
                        </btn>&nbsp;&nbsp; </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="blog list-view row">
            <div class="col-md-offset-2 col-md-8 col-sm-12 content">
                <div class="blog-posts">
                    <div class="post box">
                        <div class="row">
                            <div class="col-sm-12 post-content">
                                <div class="meta">
                                    <?php if(isset($_SESSION['flash'])): ?>
                                        <?php foreach($_SESSION['flash'] as $type => $message): ?>
                                            <div class="text-center alert alert-<?= $type; ?>">
                                                <?= $message; ?>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php unset($_SESSION['flash']); ?>
                                    <?php endif; ?>
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
                                        <?= $post['pseudo']; ?>&nbsp;&nbsp;
                                    </p>
                                    <p>Date d'inscription :
                                        <?= $post['registration_date_fr']; ?>
                                    </p>
                                    <p>Mode :
                                        <?php if($post['authorization'] == 1): ?>
                                        <?= 'Administrateur' ?>
                                        <?php else: ?>
                                        <?= 'Utilisateur' ?>
                                        <?php endif; ?>
                                    </p>
                                        </div>
                                    </div>
                                </div>

                                <form action="index.php?action=modifyProfile&amp;id=<?= $_SESSION['id'] ?>" method="post">
                                    <div>
                                        <label for="first_name">Prénom</label><br />
                                        <input type="text" id="first_name" name="first_name" value="<?= $post['first_name'] ?>" />
                                    </div>
                                    <div>
                                        <label for="name">Nom</label><br />
                                        <input type="text" id="name" name="name" value="<?= $post['last_name'] ?>" />
                                    </div>

                                    <div>
                                        <label for="email">Email</label><br />
                                        <input type="text" id="email" name="email" value="<?= $post['email'] ?>" />
                                    </div>
                                    <div>
                                        <label for="description">Description (max : 600 caractères)</label><br />
                                        <textarea type="text" id="description" name="description" /><?= $post['description'] ?></textarea>
                                    </div>
                                    <div class="text-center">
                                        <input  class="btn btn-default validate" type="submit" />
                                    </div>
                                    <input type="hidden" name="userId" value="<?= $_SESSION['id'] ?>"/> 
                                </form>

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
            <?php include "includes/footer.php"; ?>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php if(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'aqua'): ?>
    <?php require('view/frontend/colortemplates/aquatemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'blue'): ?>
    <?php require('view/frontend/colortemplates/bluetemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'gray'): ?>
    <?php require('view/frontend/colortemplates/graytemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'orange'): ?>
    <?php require('view/frontend/colortemplates/orangetemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'pink'): ?>
    <?php require('view/frontend/colortemplates/pinktemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'aqua'): ?>
    <?php require('view/frontend/colortemplates/aquatemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'red'): ?>
    <?php require('view/frontend/colortemplates/redtemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'yellow'): ?>
    <?php require('view/frontend/colortemplates/yellowtemplate.php'); ?>
<?php else: ?>
    <?php require('template.php'); ?>
<?php endif; ?>