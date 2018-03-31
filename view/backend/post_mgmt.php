<?php $title = 'Gestion des articles'; ?>
<?php ob_start(); ?>

    <body class="full-layout">
        <!--<div id="preloader"><div id="status"><div class="loadcircle"></div></div></div>-->
        <div class="body-wrapper">
            <?php include "view/frontend/includes/nav.php"; ?>
                <!-- /#home -->
                <div class="container">
                    
                                <?php include "includes/management.php"; ?>

                                <h2 class="text-center">Gestion des articles</h2>

                                <div class="post box">

                                <h2>Ajouter un article</h2>


                    <form action="index.php?action=addpost" method="post">
                        <div>
                            <label for="title">Titre</label><br />
                            <input type="text" id="title" name="title" value="" />
                        </div>

                        <div>
                            <label for="intro">Intro</label><br />
                            <input type="text" id="intro" name="intro" value="" />
                        </div>

                        <div>
                            <label for="member_pseudo">Auteur</label><br />
                            <input type="text" id="member_pseudo" name="member_pseudo" value="" />
                        </div>

                        <div>
                            <label for="content">Article</label><br />
                            <textarea type="text" id="content" name="content" value=""></textarea>
                        </div>

                        <div>
                            <input type="submit" />
                        </div>
                    </form>

                </div>
                                <h2>Modifier/Supprimer un article</h2>
                <?php
                    while ($data = $posts->fetch())
                    {
                    ?>
                        <div class="post box">
            <div class="row">
                    <h2 class="post-title"><a href="blog-post.php"><?php echo htmlspecialchars($data['title']); ?></a></h2>
                    <btn class="btn btn-default" style="float: right;"><a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>">Supprimer</a></btn>
                    <btn class="btn btn-default" style="float: right;"><a href="index.php?action=modifyPost&amp;id=<?= $data['id'] ?>">Modifier</a></btn>
                   


            </div>
        </div>
                     <?php
                } // Fin de la boucle des billets
                $posts->closeCursor();
                ?>
                                                   
                </div>
                <!-- /.container -->
        </div>
        <!-- /.body-wrapper -->
        <?php include "view/frontend/includes/foot.php"; ?>
    </body>

    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>