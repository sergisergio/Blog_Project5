<?php $title = 'Connexion'; ?>
<?php ob_start(); ?>

<body class="full-layout">
    <div class="body-wrapper">
        <?php include "view/frontend/includes/nav.php"; ?>
        <div class="container">

            <?php include "view/backend/includes/management.php"; ?>

            <h2 class="text-center">Gestion des commentaires</h2>

            <?php
            while ($data = $submittedcomments->fetch())
            {
            ?>

            <div class="post box">
                    <div class="row">
                        <h3><?php echo htmlspecialchars($data['post_id']); ?></h3>
                        <p>Commentaire de <?php echo htmlspecialchars($data['author']); ?> publié le <?php echo htmlspecialchars($data['creation_date_fr']); ?></p>
                        <p><?php echo htmlspecialchars($data['content']); ?></p>

                    </div>
                    <btn class="btn btn-default" style="float: right;">
                            <a href="index.php?action=validateComment&amp;id=<?= $data['id'] ?>">Valider</a>
                    </btn>
                    <btn class="btn btn-default" style="float: right;">
                            <a href="index.php?action=adminDeleteComment&amp;id=<?= $data['id'] ?>">Supprimer</a>
                    </btn>
            </div>

            <?php
            } 
            $submittedcomments->closeCursor();
            ?>

        </div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('view/backend/template.php'); ?>