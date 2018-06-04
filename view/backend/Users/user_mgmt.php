<?php $title = 'Gestion des membres'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
        <?php require "view/frontend/includes/nav.php"; ?>
        <div class="container">
            <?php require "view/backend/includes/management.php"; ?>
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
                        Inscription : <?php echo htmlspecialchars($u->getRegistrationDate()); ?><br />
                        Administrateur : 
                        <?php if ($u->getAuthorization1() == 1) : ?>
                                <?php echo 'Oui'; ?><br />
                                <btn class="btn btn-default">
                                    <a href="index.php?action=cancelAdminRights&amp;id=<?php echo $u->getId() ?>" data-toggle='confirmation' id="important_action">Retirer les droits admin</a>
                                </btn>
                            <?php else: ?>
                                <?php echo 'Non'; ?>
                                <br />
                                <btn class="btn btn-default">
                                    <a href="index.php?action=giveAdminRights&amp;id=<?php echo $u->getId() ?>" data-toggle='confirmation' id="important_action">Donner les droits admin</a>
                                </btn>
                            <?php endif; ?>
                    </h5>
                    <btn class="btn btn-default" style="float: right;">
                        <a href="index.php?action=deleteUser&amp;id=<?php echo $u->getId() ?>" data-toggle='confirmation' id="important_action">Supprimer</a>
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
<?php require 'view/backend/templates/template.php'; ?>