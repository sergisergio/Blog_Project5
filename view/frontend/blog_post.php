<?php $title = 'Article'; ?>
<?php ob_start(); ?>
    <div class="container inner">
        <div class="blog box mgbottom2 row">
            <div class="col-md-12">
                <?php if (isset($_SESSION['pseudo'])): ?>
                    <p class="pull-right">
                        <btn class="btn btn-default logoutbtn"> <a href="index.php?action=logout">Déconnexion</a> </btn>
                            <?php if ($_SESSION['avatar'] != ''): ?> 
                                <img class="img-responsive img-circle avatarblogpage2" src="public/images/avatar/<?= $_SESSION['avatar']; ?>" />
                            <?php else: ?>  
                                <img class="img-responsive img-circle avatarblogpagedefault" src="public/images/avatar/avatardefaut.png" />
                            <?php endif; ?>
                    </p>
                <?php else: ?> 
                    <p class="pull-right">
                        <btn class="btn btn-default"> 
                            <a href="index.php?action=loginPage">Connexion</a> 
                        </btn>
                    </p>
                    <p class="pull-right">
                        <btn class="btn btn-default"> 
                            <a href="index.php?action=signupPage">Inscription</a> 
                        </btn>&nbsp;&nbsp; 
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="single blog row">
            <div class="col-md-8 col-sm-12 content">
                <div class="blog-posts">
                    <div class="post box">
                        <div class="post-title">
                            <h2><?= htmlspecialchars($post['title']) ?></h2>
                            <h3 class="post-title"><?= htmlspecialchars($post['chapo']); ?></h3>
                            <h4 class="post-title">Auteur : <?= ($post['author']); ?></h4>
                            <div class="meta"> <span class="date">date de dernière publication</span>le 
                                <?php
                                    if (isset($post['last_updated_fr'])) {
                                        echo $post['last_updated_fr'];
                                    }
                                    else
                                        echo $post['creation_date_fr'];
                                ?> 
                            </div>
                            <div class="divide30"></div>
                            <img src="public/images/posts/<?= $post['file_extension'] ?>" class="img-responsive" />
                            <div class="divide30"></div>
                            <p>
                                <?= nl2br(htmlspecialchars($post['content'])) ?>
                            </p>
                        </div>
                        <div class="divide20"></div>
                    </div>
                </div>
                <div class="divide20"></div>
                
                <div class="divide20"></div>
                <div class="blog-posts" id="comments">
                    <div class="post box">
                            <h3><i class="budicon-comment-2"></i>&nbsp;&nbsp;Commentaires (<?= $nbCount; ?>)</h3>
                            <?php
                                while ($comment = $comments->fetch())
                                {
                            ?>
                            <p>
                                <strong><?= htmlspecialchars($comment['author']) ?></strong> le 
                                    <?php
                                        if (isset($comment['last_updated_fr'])) {
                                        echo $comment['last_updated_fr'];
                                    }
                                    else
                                      echo $comment['creation_date_fr'];
                                    ?> 
                            </p>
                            <p>
                                <?= nl2br(htmlspecialchars($comment['content'])) ?> 
                                <?php if ((isset($_SESSION['pseudo']) && ($_SESSION['pseudo'] == $comment['author'])) || (isset($_SESSION['autorisation']) && ($_SESSION['autorisation']) == 1)): ?>
                                    <a href="index.php?action=modifyCommentPage&amp;id=<?= $comment['id'] ?>"> (Modifier)</a> 
                                    <a href="index.php?action=deleteComment&amp;id=<?= $comment['id'] ?>" data-toggle='confirmation' id="important_action"> (Supprimer)</a>
                                <?php endif; ?>
                            </p>
                            <?php
                                }
                            ?>
                    </div>
                </div>
                <div class="divide20"></div>
                <div class="blog-posts">
                    <div class="post box">
                        <h3>Ajouter un commentaire</h3>
                            <?php if (isset($_SESSION['pseudo'])): ?>       
                                <?php include "forms/form_addcomment.php"; ?>
                            <?php else: ?> 
                                <p>Vous devez être inscrit et connecté pour ajouter un commentaire !</p>
                                <a href="index.php?action=signupPage">M'inscrire</a>&nbsp;&nbsp;
                                <a href="index.php?action=loginPage">Me connecter</a>
                            <?php endif; ?>
                    </div>
                </div>
                <div class="divide60"></div>
            </div>
                <?php include "includes/aside.php"; ?>
            </div>
            <div class="container bottomcontainer">
                <div class="row">
                    <?php include "includes/footer.php"; ?>
                </div>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>