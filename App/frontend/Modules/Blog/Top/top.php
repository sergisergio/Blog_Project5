<?php if (isset($_SESSION['pseudo'])) : ?>
    <a href="index.php?action=profilePage" class="btn btn-default btn-lg pull-left" role="button">Voir mon profil</a>
    <p class="pull-right">
        <a href="index.php?action=logout" class="btn btn-default btn-lg logoutbtn pull-right" role="button">Déconnexion</a>
        <?php if ($_SESSION['avatar'] != '') : ?>
            <img class="img-responsive img-circle avatarblogpage" alt="avatar" src="Web/images/avatar/<?php echo $_SESSION['avatar']; ?>" />
        <?php else: ?> 
            <img class="img-responsive img-circle avatarblogpagedefault" alt="avatar" src="Web/images/avatar/avatardefaut.png" />
        <?php endif; ?>
    </p>
<?php else: ?>
    <a href="index.php?action=loginPage" class="btn btn-default btn-lg pull-right" role="button">Connexion</a>
    <a href="index.php?action=signupPage" class="btn btn-default btn-lg pull-right" role="button">Inscription</a>&nbsp;&nbsp;
<?php endif; ?>