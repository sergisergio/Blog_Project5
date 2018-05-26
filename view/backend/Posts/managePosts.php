<?php
    if(!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ) {
    header('Location: index.php?action=noAdmin');
    exit();
}
?>
<?php $title = 'Gestion des articles'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
            <?php require "view/frontend/includes/nav.php"; ?>
            <div class="container">
                <?php require "view/backend/includes/management.php"; ?>
                <h2 class="text-center">Gestion des articles</h2>
                <div class="divide20"></div>
                <div class="post box">
                    <h2>Ajouter un article</h2>
                    <?php require "view/backend/forms/form_addpost.php"; ?>
                </div>
                <div class="divide20"></div>
                <div class="divide20"></div>
                <h2 class="text-center">Modifier/Supprimer un article</h2>
                <div class="divide20"></div>
                <?php
                while ($data = $posts->fetch())
                {
                ?>
                <div class="post box" id="viewposts">
                <div class="row">
                    <h2 class="post-title">
                        <a href="index.php?action=blogpost&amp;id=<?php echo $data['id'] ?>" target="_blank"><?php echo htmlspecialchars($data['title']); ?></a>
                    </h2>
                    <?php if ($data['file_extension'] != '') : ?>
                        <img src="public/images/posts/<?php echo $data['file_extension']; ?>" class="img-responsive" style="width: 10%;" />
                        <?php else: ?>
                        <img src="public/images/posts/default.jpg" class="img-responsive" style="width: 10%;" />
                        <?php endif; ?>

                    <btn class="btn btn-default" style="float: right;">
                        <a href="index.php?action=deletePost&amp;id=<?php echo $data['id'] ?>" data-toggle='confirmation' id="important_action">Supprimer</a>
                    </btn>
                    <btn class="btn btn-default" style="float: right;">
                        <a href="index.php?action=modifyPostPage&amp;id=<?php echo $data['id'] ?>">Modifier</a>
                    </btn>
                </div>
                </div>
                <?php
                } 
                    $posts->closeCursor();
                ?>
                <div class="pagination box">
                <ul>
                    <li><?php echo '<a class="btn" href="index.php?action=manage_posts&page='. ($currentPage - 1) . '#viewposts' . '">'.'Précédent'.'</a> '; ?></li>
                        <?php
                        for($i=1;$i<=$totalPages;$i++){
                            if($i == $currentPage) {
                                echo '<li><a class="btn active" href="index.php?action=manage_posts&page='.$i. '#viewposts' . '">'.$i.'</a></li> ';
                            }
                            else {
                                echo '<li><a class="btn" href="index.php?action=manage_posts&page='.$i. '#viewposts' . '">'.$i.'</a></li> ';
                            }
                        }
                        ?>
                    <li><?php echo '<a class="btn" href="index.php?action=manage_posts&page='. ($currentPage + 1) . '#viewposts' . '">'.'Suivant'.'</a> '; ?></li>
                </ul>
            </div>
            </div>
                <div class="divide100"></div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/backend/templates/template.php'; ?>