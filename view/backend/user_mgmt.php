<?php $title = 'Gestion des membres'; ?>
<?php ob_start(); ?>

    <body class="full-layout">
        <!--<div id="preloader"><div id="status"><div class="loadcircle"></div></div></div>-->
        <div class="body-wrapper">
            <?php include "view/frontend/includes/nav.php"; ?>
                <!-- /#home -->
                <div class="container">
                    
                                <?php include "includes/management.php"; ?>

                                <h2>Modifier/supprimer un membre</h2>
                                <?php
                    while ($data = $req->fetch())
                    {
                    ?>
                        <div class="post box">
            <div class="row">
                    <h2 class="post-title"><a href="blog-post.php"><?php echo htmlspecialchars($data['pseudo']); ?></a></h2>

                    <btn class="btn btn-default" style="float: right;"><a href="#">Supprimer</a></btn>
                    <btn class="btn btn-default" style="float: right;"><a href="#">Modifier</a></btn>

                   


            </div>
        </div>
                     <?php
                } // Fin de la boucle des billets
                $req->closeCursor();
                ?>
                                   
                </div>
                <!-- /.container -->
        </div>
        <!-- /.body-wrapper -->
        <?php include "view/frontend/includes/foot.php"; ?>
    </body>

    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>