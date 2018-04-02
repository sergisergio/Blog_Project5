<?php $title = 'Connexion'; ?>
<?php ob_start(); ?>

    <body class="full-layout">
        <!--<div id="preloader"><div id="status"><div class="loadcircle"></div></div></div>-->
        <div class="body-wrapper">
            <?php include "view/frontend/includes/nav.php"; ?>
                <!-- /#home -->
                <div class="container">
                    
                                <?php include "view/backend/includes/management.php"; ?>

                                <h2 class="text-center">Gestion des commentaires</h2>

                                <?php
                    while ($data = $posts->fetch())
                    {
                    ?>

                                
    <div class="post box">
        <a href="index.php?action=adminModifyComment&amp;id=<?= $data['id'] ?>">
        <div class="row">
            <h2 class="post-title"><?php echo htmlspecialchars($data['title']); ?></h2>
        </div>
        </a>
    </div>
      <?php
                } // Fin de la boucle des billets
                $posts->closeCursor();
                ?>
                
    
    

 
</div>
                                   
                </div>
                <!-- /.container -->
        
        <!-- /.body-wrapper -->
        <?php include "view/frontend/includes/foot.php"; ?>
    </body>

    <?php $content = ob_get_clean(); ?>

    <?php require('view/backend/template.php'); ?>