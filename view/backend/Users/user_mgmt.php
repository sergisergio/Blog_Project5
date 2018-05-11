<?php $title = 'Gestion des membres'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
        <?php include "view/frontend/includes/nav.php"; ?>
        <div class="container">
            <?php include "view/backend/includes/management.php"; ?>
            <h2 class="text-center">Gestion des membres</h2>
            <div class="divide20"></div>
            <div class="divide20"></div>
            <?php
                while ($data = $req->fetch())
                {
            ?>
            <div class="col-md-6 col-sm-12">
                <div class="post box">
                    <div class="row">
                        <h2 class="post-title">
                            <?php if ($data['avatar'] != ''): ?>
                                <img class="img-responsive img-circle" style="width: 8%;" src="public/images/avatar/<?= htmlspecialchars($data['avatar']); ?>" />
                            <?php else: ?>
                                <img class="img-responsive img-circle" style="width: 8%;" src="public/images/avatar/avatardefaut.png" />
                            <?php endif; ?>
                        </h2>
                        <h5 class="post-title">
                            Pseudo : <?= htmlspecialchars($data['pseudo']); ?><br />
                            Email : <?= htmlspecialchars($data['email']); ?><br />
                            Inscription : <?= htmlspecialchars($data['registration_date']); ?><br />
                            Administrateur : 
                            <?php if ($data['authorization'] == 1): ?>
                                <?= 'Oui'; ?><br />
                                <btn class="btn btn-default">
                                    <a href="index.php?action=cancelAdminRights&amp;id=<?= $data['id'] ?>">Retirer les droits admin</a>
                                </btn>
                            <?php else: ?>
                                <?= 'Non'; ?>
                                <br />
                                <btn class="btn btn-default">
                                    <a href="index.php?action=giveAdminRights&amp;id=<?= $data['id'] ?>">Donner les droits admin</a>
                                </btn>
                            <?php endif; ?>
                        </h5>
                        <btn class="btn btn-default" style="float: right;">
                            <a href="index.php?action=deleteUser&amp;id=<?= $data['id'] ?>" data-toggle='confirmation' id="important_action">Supprimer</a>
                        </btn>
                    </div>
                </div>
            </div>
            <?php
                } 
                $req->closeCursor();
            ?>
            </div>
                <div class="divide100"></div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php require('view/backend/template.php'); ?>