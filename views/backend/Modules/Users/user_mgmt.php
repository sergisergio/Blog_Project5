<?php $title = 'Gestion des membres'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
        <?php require "views/frontend/modules/nav/nav.php"; ?>
        <div class="container">
            <section style="margin-bottom: 50px;">
                  <div class="box">
                    <div class="col-md-12">
                      <?php if (isset($_SESSION['pseudo'])) : ?>
                        <p class="pull-center"><h2>Espace administrateur</h2></p>
                        <p class="pull-right">
                        <btn class="btn btn-default logoutbtn"> <a href="index.php?action=logout">Déconnexion</a> </btn>
                        <?php if ($_SESSION['avatar'] != '') : ?> <img style="width: 10%;float: right;margin: 0 20px;" class="img-responsive img-circle" src="public/images/avatar/<?php echo $_SESSION['avatar']; ?>" />
                        <?php else: ?> <img style="width: 5%;float: right;margin: 0 20px;" class="img-responsive img-circle" style="width: 5%;" src="public/images/avatar/avatardefaut.png" />
                        <?php endif; ?>
                        </p>
                        <?php else: ?> 
                        <p class="pull-right"><btn class="btn btn-default"> <a href="index.php?action=loginPage">Connexion</a></btn></p>
                        <p class="pull-right"><btn class="btn btn-default"> <a href="index.php?action=signupPage">Inscription</a> </btn>&nbsp;&nbsp; </p>
                        <?php endif; ?>
                    </div>
                    <p></p>
                    <div class="divide30"></div>
                    <ul class="nav nav-tabs menuadmin">
                      <li class="nav-item">
                        <a class="nav-link active" href="index.php?action=manage_posts">Gestion articles</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?action=manage_comments">Gestion commentaires</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?action=manage_users">Gestion membres</a>
                      </li>
                    </ul>
                  </div>
                </section>
            <h2 class="text-center">Gestion des membres</h2>
            <div class="divide20"></div>
            <div class="divide20"></div>
            <?php
            foreach ($users as $u)
            {
            ?>
            <div class="col-md-6 col-sm-12">
            <div class="post box">
                <div class="row">
                    <h2 class="post-title">
                        <?php if ($u->getAvatar() != '') : ?>
                                <img class="img-responsive img-circle" style="width: 8%;" src="public/images/avatar/<?php echo htmlspecialchars($u->getAvatar()); ?>" />
                            <?php else: ?>
                                <img class="img-responsive img-circle" style="width: 8%;" src="public/images/avatar/avatardefaut.png" />
                            <?php endif; ?>
                    </h2>
                    <h5 class="post-title">
                        Pseudo : <?php echo htmlspecialchars($u->getPseudo()); ?><br />
                        Email : <?php echo htmlspecialchars($u->getEmail()); ?><br />
                        Inscription : <?php echo htmlspecialchars($u->getRegistration_date()); ?><br />
                        Administrateur : 
                        <?php if ($u->getAuthorization() == 1) : ?>
                                <?php echo 'Oui'; ?><br />
                                <?php      
                                    $csrfCancelAdminRightsToken = md5(time()*rand(1, 1000));
                                ?>
                                <btn class="btn btn-default">
                                    <a href="index.php?action=cancelAdminRights&amp;id=<?php echo $u->getId() ?>&amp;token=<?php echo $csrfCancelAdminRightsToken ?>" data-toggle='confirmation' id="important_action">Retirer les droits admin</a>
                                </btn>
                            <?php else: ?>
                                <?php echo 'Non'; ?>
                                <br />
                                <?php      
                                    $csrfGiveAdminRightsToken = md5(time()*rand(1, 1000));
                                ?>
                                <btn class="btn btn-default">
                                    <a href="index.php?action=giveAdminRights&amp;id=<?php echo $u->getId() ?>&amp;token=<?php echo $csrfGiveAdminRightsToken ?>" data-toggle='confirmation' id="important_action">Donner les droits admin</a>
                                </btn>
                            <?php endif; ?>
                    </h5>
                    <?php      
                        $csrfDeleteUserToken = md5(time()*rand(1, 1000));
                    ?>
                    <btn class="btn btn-default" style="float: right;">
                        <a href="index.php?action=deleteUser&amp;id=<?php echo $u->getId() ?>&amp;token=<?php echo $csrfDeleteUserToken ?>" data-toggle='confirmation' id="important_action">Supprimer</a>
                    </btn>
                </div>
            </div>
            </div>
            <?php
            } 
            ?>
            </div>
                <div class="divide100"></div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php require 'views/backend/templates/template.php'; ?>