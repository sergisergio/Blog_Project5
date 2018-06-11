<?php $title = 'Article'; ?> 
<?php ob_start(); ?>
    <div class="container inner">
        <div class="blog box mgbottom2 row">
            <!-- INCLUDE TOP -->
            <div class="col-md-12">
                <?php require 'view/frontend/includes/top.php' ?>
            </div>
            <!-- END INCLUDE TOP -->
        </div>
        <div class="single blog row">
            <div class="col-md-8 col-sm-12 content">
                <div class="blog-posts">
                    <!-- SINGLE POST -->
                    <div class="post box">
                        <div class="post-title">
                            <h2><?php echo htmlspecialchars($post->getTitle()) ?></h2>
                            <h3 class="post-title"><?php echo htmlspecialchars($post->getChapo()); ?></h3>
                            <h4 class="post-title">Auteur : <?php echo ($post->getAuthor()); ?></h4>
                            <div class="meta"> <span class="date">date de dernière publication</span>le 
                                <?php
                                if (($post->getLastUpdated() != null)) {
                                    echo ($post->getLastUpdated());
                                }
                                else {
                                    echo ($post->getCreationDate());
                                }
                                ?> 
                            </div>
                            <div class="divide30"></div>
                            <?php if ($post->getFileExtension() != '') : ?>
                            <img src="public/images/posts/<?php echo $post->getFileExtension() ?>" class="img-responsive" />
                            <div class="divide30"></div>
                            <?php else: ?>
                            <img src="public/images/posts/default.jpg" class="img-responsive" />
                            <?php endif; ?>
                            <p>
                                <?php echo nl2br(htmlspecialchars_decode($post->getContent())) ?>
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
                            <h3><i class="budicon-comment-2"></i>&nbsp;&nbsp;Commentaires (<?php echo $nbCount; ?>)</h3>
                            <?php endif; ?>
                            <?php
                            foreach ($comment as $c)
                            {
                            ?>
                            <p>
                            <div class="row">
                                <div class="col-md-1 col-sm-1 col-xs-2">
                                    <img class="img-responsive img-circle" src="public/images/avatar/<?= $c->getAvatar() ?>" />
                                </div>
                                <div class="col-md-11 col-sm-11 col-xs-10">
                                    <a href="index.php?action=publicProfile&id=<?php echo $c->getAuthor() ?>"><strong><?php echo htmlspecialchars($c->getAuthor()) ?></strong></a> 
                                    <em style="font-weight: 200">le 
                                    <?php
                                        if ($c->getLastUpdated()) {
                                            echo ($c->getLastUpdated());
                                        }
                                        else {
                                            echo ($c->getCreationDate());
                                        }
                                    ?> 
                                    </em>
                                </div>
                            </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-md-1 col-sm-1 col-xs-2">
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-xs-10">
                                        <p style="margin: -10px 0 0px !important;font-weight: 700;">
                                        <?php echo nl2br(htmlspecialchars($c->getContent())) ?> 
                                        </p>
                                        <?php if ((isset($_SESSION['pseudo']) && ($_SESSION['pseudo'] == $c->getAuthor())) || (isset($_SESSION['autorisation']) && ($_SESSION['autorisation']) == 1)) : ?>
                                            <a href="index.php?action=modifyCommentPage&amp;id=<?php echo $c->getId() ?>&amp;postId=<?php echo $post->getId() ?>"> (Modifier)</a>
                                            <?php      
                                                $csrfDeleteCommentToken = md5(time()*rand(1, 1000));
                                            ?>
                                            <a href="index.php?action=deleteComment&amp;id=<?php echo $c->getId() ?>&amp;postId=<?php echo $post->getId() ?>&amp;token=<?php echo $csrfDeleteCommentToken ?>" data-toggle='confirmation' id="important_action"> (Supprimer)</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
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