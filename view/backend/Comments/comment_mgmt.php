<?php $title = 'Connexion'; ?>
<?php ob_start(); ?>

    <body class="full-layout">
        <div class="body-wrapper">
            <?php include "view/frontend/includes/nav.php"; ?>
                <div class="container">
                    
                    <?php include "view/backend/includes/management.php"; ?>

                    <h2 class="text-center">Gestion des commentaires</h2>

                    <?php
                        while ($data = $posts->fetch())
                    {
                    ?>

                                
                    <div class="post box">
                        <a href="index.php?action=adminViewPost&amp;id=<?= $data['id'] ?>">
                        <div class="row">
                            <h2 class="post-title"><?php echo htmlspecialchars($data['title']); ?></h2>
                        </div>
                        </a>
                    </div>
                    <?php
                    } 
                    $posts->closeCursor();
                    ?>
                
                </div>
                                   
        </div>
                
        <?php include "view/frontend/includes/foot.php"; ?>
    </body>

    <?php $content = ob_get_clean(); ?>

    <?php require('view/backend/template.php'); ?>