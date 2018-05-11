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
            <div class="col-md-6 col-sm-12 content">
                <div class="blog-posts">
                    <div class="post box">
                        <div class="row">
                            <div class="col-sm-12 post-content">
                                <div class="meta">
                                    <p>
                                        <?php if ($_SESSION['avatar'] != ''): ?> 
                                            <img class="img-responsive img-circle avatarprofile" src="public/images/avatar/<?= $_SESSION['avatar']; ?>" />
                                        <?php else: ?> <img class="img-responsive img-circle avatarprofile" src="public/images/avatar/avatardefaut.png" />
                                        <?php endif; ?>
                                    </p>
                                    <p>Pseudo :
                                        <?= $_SESSION['pseudo']; ?>&nbsp;&nbsp;
                                        <a href="">(Modifier)</a>
                                    </p>
                                    <p>Prénom :
                                        <?= $_SESSION['prenom']; ?>&nbsp;&nbsp;
                                        <?php if ($_SESSION['prenom'] == ''): ?>
                                            <a href="">(Ajouter)</a>
                                        <?php else: ?>
                                            <a href="">(Modifier)</a>
                                        <?php endif; ?> 
                                    </p>
                                    <p>Nom :
                                        <?= $_SESSION['nom']; ?>&nbsp;&nbsp;
                                        <?php if ($_SESSION['nom'] == ''): ?>
                                            <a href="">(Ajouter)</a>
                                        <?php else: ?>
                                            <a href="">(Modifier)</a>
                                        <?php endif; ?> 
                                    </p>
                                    <p>Email :
                                        <?= $_SESSION['email']; ?>&nbsp;&nbsp;
                                            <a href="">(Modifier)</a>
                                    </p>
                                    <p>Date d'inscription :
                                        <?= $_SESSION['registration_date']; ?>
                                    </p>
                                </div>
                                <btn class="btn btn-default">
                                    <a href="index.php?action=deleteUser&amp;id=<?= $_SESSION['id'] ?>" data-toggle='confirmation' id="important_action">Supprimer mon compte</a>
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
<?php require('template.php'); ?>