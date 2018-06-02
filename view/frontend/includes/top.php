<?php if (isset($_SESSION['pseudo'])) : ?>
    <p class="pull-left">
        <btn class="btn btn-default"> 
            <a href="index.php?action=profilePage">Voir mon profil</a> 
        </btn>
    </p>
    <p class="pull-right">
        <btn class="btn btn-default logoutbtn"> 
            <a href="index.php?action=logout">Déconnexion</a> 
        </btn>
        <?php if ($_SESSION['avatar'] != '') : ?>
            <img class="img-responsive img-circle avatarblogpage" src="public/images/avatar/<?php echo $_SESSION['avatar']; ?>" />
        <?php else: ?> 
            <img class="img-responsive img-circle avatarblogpagedefault" src="public/images/avatar/avatardefaut.png" />
        <?php endif; ?>
    </p>
<?php else: ?>
    <p class="pull-right">
        <btn class="btn btn-default"> <a href="index.php?action=loginPage">Connexion</a> </btn>
    </p>
    <p class="pull-right">
        <btn class="btn btn-default"> <a href="index.php?action=signupPage">Inscription</a> </btn>&nbsp;&nbsp; 
    </p>
<?php endif; ?>