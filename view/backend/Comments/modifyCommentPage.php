<?php $title = 'Modification des commentaires'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
        <?php include "view/frontend/includes/nav.php"; ?>
        <div class="container">
            <?php include "view/backend/includes/management.php"; ?>
            <h2 class="text-center">Gestion des commentaires</h2>
            <div class="post box">
                <div class="row">
                    <div class="blog-posts">
                            <div class="post box">
                                <div class="meta">
                                    <span class="date">date de dernière publication</span><em>le <?= $post['creation_date_fr'] ?></em>
                                </div>
                                <div class="news">
                                    <h3>
                                        <?= htmlspecialchars($post['title']) ?>
                                    </h3>
                                    <p>
                                        <?= nl2br(htmlspecialchars($post['intro'])) ?>
                                    </p>
                                </div>
                                <div class="divide20"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-posts">
                    <div class="post box">
                        <h3>Ajouter un commentaire</h3>
                        <?php include "view/backend/forms/form_addcomment.php" ?>
                    </div>
                </div>
                <div class="blog-posts" id="viewcomments">
                    <div class="post box">
                    <h3>Commentaires</h3>
                    <?php
                    while ($comment = $comments->fetch())
                    {
                    ?>
                    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['creation_date_fr'] ?></p>
                    <p>
                        <?= nl2br(htmlspecialchars($comment['content'])) ?>
                        <a href="index.php?action=adminModifyCommentPage&amp;id=<?= $comment['id'] ?>"> (Modifier)</a>
                        <a href="index.php?action=adminDeleteComment&amp;id=<?= $comment['id'] ?>" data-toggle='confirmation' id="important_action"> (Supprimer)</a>
                    </p>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php require('view/backend/template.php'); ?>