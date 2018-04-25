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
                        <div class="row">
                        <h2>Modifier l'article</h2>


                        <form action="index.php?action=modifyPost&amp;id=<?= $post['id'] ?>" method="post">
                            <div>
                                <label for="title">Titre</label><br />
                                <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" />
                            </div>

                            <div>
                                <label for="intro">Intro</label><br />
                                <input type="text" id="intro" name="intro" value="<?= htmlspecialchars($post['intro']) ?>" />
                            </div>

                            <div>
                                <label for="author">Auteur</label><br />
                                <input type="text" id="author" name="author" value="<?= htmlspecialchars($post['author']) ?>" />
                            </div>

                            <div>
                                <label for="content">Article</label><br />

                                <textarea id="content" name="content"><?= htmlspecialchars($post['content']) ?></textarea>
                            </div>

                            <div>
                                <input type="submit" />
                            </div>
                        </form>

                        </div>
                    </div>
                    
                                                   
                </div>
                <!-- /.container -->
        </div>
        <!-- /.body-wrapper -->
        <?php include "view/frontend/includes/foot.php"; ?>
    </body>

    <?php $content = ob_get_clean(); ?>

    <?php require('view/backend/template.php'); ?>