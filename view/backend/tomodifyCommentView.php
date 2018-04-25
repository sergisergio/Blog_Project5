<?php $title = 'Gestion des articles'; ?>
<?php ob_start(); ?>

    <body class="full-layout">
        
        <div class="body-wrapper">
            <?php include "view/frontend/includes/nav.php"; ?>
                
                <div class="container">
                    
                    <?php include "includes/management.php"; ?>

                    <h2 class="text-center">Gestion des commentaires</h2>
                
                    <div class="blog-posts">
                        <div class="post box">
                            <p>
                                <a href="#">Retour au billet</a>
                            </p>

                            <div class="news">
                                <h3>
                                    <?= htmlspecialchars($post['title']) ?>
                                    <em>le <?= $post['creation_date_fr'] ?></em>
                                </h3>
    
                                <p>
                                    <?= nl2br(htmlspecialchars($post['intro'])) ?>
                                </p>
                            </div>

                            <h2>Modifier le commentaire</h2>

                            <form action="index.php?action=adminModifyComment&amp;id=<?= $comment['id'] ?>" method="post">
                                <div>
                                    <label for="author">Auteur</label><br />
                                    <input type="text" id="author" name="author" value="<?= htmlspecialchars($comment['author']) ?>" />
                                </div>
                                <div>
                                    <label for="content">Commentaire</label><br />
                                    <textarea id="content" name="content"><?= htmlspecialchars($comment['content']) ?></textarea>
                                </div>
                                <div>
                                    <input type="submit" />
                                </div>
                            </form>
            
                            <div class="divide20"></div>
              
                        </div>
          <!-- /.post --> 
                    </div>
        <!-- /.blog-posts -->
                <!-- /.container -->
                </div>
        <!-- /.body-wrapper -->
        <?php include "view/frontend/includes/foot.php"; ?>
    </body>

    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>