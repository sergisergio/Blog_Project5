<?php $title = 'Gestion des articles'; ?>
<?php ob_start(); ?>

    <body class="full-layout">
        
        <div class="body-wrapper">
            <?php include "view/frontend/includes/nav.php"; ?>
                <!-- /#home -->
            <div class="container">
                    
                <?php include "view/backend/includes/management.php"; ?>

                <h2 class="text-center">Gestion des articles</h2>

                <div class="post box">

                    <h2>Ajouter un article</h2>

                    <?php include "view/backend/forms/form_addpost.php"; ?>

                </div>
                    
                <h2>Modifier/Supprimer un article</h2>
                <?php
                    while ($data = $posts->fetch())
                {
                ?>
                        
                <div class="post box" id="viewposts">
                    <div class="row">
                        <h2 class="post-title">
                            <a href="index.php?action=blogpost&amp;id=<?= $data['id'] ?>" target="_blank"><?php echo htmlspecialchars($data['title']); ?></a>
                        </h2>

                        <btn class="btn btn-default" style="float: right;">
                            <a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>"   data-toggle='confirmation' id="important_action">Supprimer</a>
                        </btn>
                        <btn class="btn btn-default" style="float: right;">
                            <a href="index.php?action=modifyPostPage&amp;id=<?= $data['id'] ?>">Modifier</a>
                        </btn>

                    </div>
                </div>
                    
                <?php
                } 
                    $posts->closeCursor();
                ?>
                                                   
            </div>
                <!-- /.container -->
        </div>
<?php $content = ob_get_clean(); ?>
<?php require('view/backend/template.php'); ?>