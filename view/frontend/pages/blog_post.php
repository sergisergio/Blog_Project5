<?php $title = 'Article'; ?> 
<?php ob_start(); ?>
    <div class="container inner">
        <div class="blog box mgbottom2 row">
            <!-- INCLUDE TOP -->
            <div class="col-md-12">
                <?php include 'view/frontend/includes/top.php' ?>
            </div>
            <!-- END INCLUDE TOP -->
        </div>
        <div class="single blog row">
            <div class="col-md-8 col-sm-12 content">
                <div class="blog-posts">
                    <!-- SINGLE POST -->
                    <div class="post box">
                        <div class="post-title">
                            <h2><?= htmlspecialchars($post->getTitle()) ?></h2>
                            <h3 class="post-title"><?= htmlspecialchars($post->getChapo()); ?></h3>
                            <h4 class="post-title">Auteur : <?= ($post->getAuthor()); ?></h4>
                            <div class="meta"> <span class="date">date de dernière publication</span>le 
                                <?php
                                if (($post->getLastUpdated() != NULL)) {
                                    echo ($post->getLastUpdated());
                                }
                                else {
                                    echo ($post->getCreationDate());
                                }
                                ?> 
                            </div>
                            <div class="divide30"></div>
                            <?php if ($post->getFileExtension() != '') : ?>
                            <img src="public/images/posts/<?= $post->getFileExtension() ?>" class="img-responsive" />
                            <div class="divide30"></div>
                            <?php else: ?>
                            <img src="public/images/posts/default.jpg" class="img-responsive" />
                            <?php endif; ?>
                            <p>
                                <?= nl2br(htmlspecialchars($post->getContent())) ?>
                            </p>
                        </div>
                        <div class="divide20"></div>
                    </div>
                    <!-- END SINGLE POST -->
                </div>
                <div class="divide20"></div>
                <div class="divide20"></div>
                <div class="blog-posts" id="comments">
                    <!-- COMMENTS -->
                    <div class="post box">
                            <?php if($nbCount == 0) : ?>
                            <h3><i class="budicon-comment-2"></i>&nbsp;&nbsp;Il n'a aucun commentaire pour l'instant.</h3>
                            <?php else: ?>
                            <h3><i class="budicon-comment-2"></i>&nbsp;&nbsp;Commentaires (<?= $nbCount; ?>)</h3>
                            <?php endif; ?>
                            <?php
                            foreach ($comment as $c)
                            {
                            ?>
                            <p>
                            <a href="index.php?action=publicProfile&id=<?= $c->getAuthor() ?>"><strong><?= htmlspecialchars($c->getAuthor()) ?></strong></a> le 
                                <?php
                                if ($c->getLastUpdated()) {
                                    echo ($c->getLastUpdated());
                                }
                                else {
                                    echo ($c->getCreationDate());
                                }
                                    ?> 
                            </p>
                            <p>
                                <?= nl2br(htmlspecialchars($c->getContent())) ?> 
                                <?php if ((isset($_SESSION['pseudo']) && ($_SESSION['pseudo'] == $c->getAuthor())) || (isset($_SESSION['autorisation']) && ($_SESSION['autorisation']) == 1)) : ?>
                                    <a href="index.php?action=modifyCommentPage&amp;id=<?= $c->getId() ?>&amp;postId=<?= $post->getId() ?>"> (Modifier)</a> 
                                    <a href="index.php?action=deleteComment&amp;id=<?= $c->getId() ?>&amp;postId=<?= $post->getId() ?>" data-toggle='confirmation' id="important_action"> (Supprimer)</a>
                                <?php endif; ?>
                            </p>
                            <?php
                            }
                            ?>
                    </div>
                    <!-- END COMMENTS -->
                </div>
                <div class="divide20"></div>
                <div class="blog-posts">
                    <!-- ADD A COMMENT -->
                    <div class="post box">
                        <h3>Ajouter un commentaire</h3>
                            <?php if (isset($_SESSION['pseudo'])) : ?>       
                                <?php include "view/frontend/forms/form_addcomment.php"; ?>
                            <?php else: ?> 
                                <p>Vous devez être inscrit et connecté pour ajouter un commentaire !</p>
                                <a href="index.php?action=signupPage">M'inscrire</a>&nbsp;&nbsp;
                                <a href="index.php?action=loginPage">Me connecter</a>
                            <?php endif; ?>
                    </div>
                    <!-- END ADD A COMMENT -->
                </div>
                <div class="divide60"></div>
            </div>
            <!-- ASIDE -->
            <?php require "view/frontend/includes/aside.php";?>
            <!-- END ASIDE -->
            </div>
            <div class="container bottomcontainer">
                <div class="row">
            <!-- FOOTER -->
                    <?php require "view/frontend/includes/footer.php"; ?>
            <!-- END FOOTER -->
                </div>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/frontend/templates/template.php'; ?>