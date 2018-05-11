<?php $title = 'Gestion des commentaires'; ?>
<?php ob_start(); ?>
    <body class="full-layout">
        <div class="body-wrapper">
            <?php include "view/frontend/includes/nav.php"; ?>
            <div class="container">
                <?php include "includes/management.php"; ?>
                <h2 class="text-center">Gestion des commentaires</h2>
                <div class="blog-posts">
                    <div class="post box">
                        <p><a href="#">Retour au billet</a></p>
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
                        <?php include "view/backend/forms/form_modifycomment.php" ?>
                        <div class="divide20"></div>
                    </div>
                </div>
            </div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>