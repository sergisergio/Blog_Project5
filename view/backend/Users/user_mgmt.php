<?php $title = 'Gestion des membres'; ?>
<?php ob_start(); ?>

    <body class="full-layout">
        
        <div class="body-wrapper">
            <?php include "view/frontend/includes/nav.php"; ?>
                <!-- /#home -->
            <div class="container">
                    
                <?php include "view/backend/includes/management.php"; ?>

                <h2 class="text-center">Modifier/supprimer un membre</h2>

                <?php
                    while ($data = $req->fetch())
                {
                ?>
                <div class="post box">
                    <div class="row">
                        <a href="#"></a>
                        <h2 class="post-title">
                            <?php echo htmlspecialchars($data['pseudo']); ?>
                        </h2>
                        <h5 class="post-title">
                            <?php echo htmlspecialchars($data['email']); ?>
                        </h5>

                        <btn class="btn btn-default" style="float: right;">
                            <a href="index.php?action=deleteUser&amp;id=<?= $data['id'] ?>" data-toggle='confirmation' id="important_action">Supprimer</a>
                        </btn>
                        <!-- <btn class="btn btn-default" style="float: right;">
                            <a href="index.php?action=modifyUserPage&amp;id=">Modifier</a>
                        </btn> -->
                    </div>
                </div>
                
                <?php
                } // Fin de la boucle des billets
                    $req->closeCursor();
                ?>
            </div>
                <!-- /.container -->
        </div>
<?php $content = ob_get_clean(); ?>
<?php require('view/backend/template.php'); ?>