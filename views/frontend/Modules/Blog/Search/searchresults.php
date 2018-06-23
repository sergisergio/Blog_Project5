<?php $title = 'Résultats'; ?>
<?php ob_start(); ?>
<div class="container inner">
    <div class="blog box mgbottom2 row">
        <?php include 'views/frontend/modules/blog/top/top.php' ?>
    </div>
    <div class="blog list-view row">
        <div class="col-md-8 col-sm-12 content">
            <div class="blog-posts">
                <div class="post box">
                    <div class="row">
                        <div class="col-sm-12 post-content">
                            <?php if($nbResults > 1) : ?>
                            <p>Nous avons trouvé <?php echo  $nbResults; ?> résultats correspondant à votre requête.</p>
                            <?php elseif($nbResults == 1) : ?>
                            <p>Nous avons trouvé <?php echo  $nbResults; ?> résultat correspondant à votre requête.</p>
                            <?php else: ?>
                            <p>Aucun résultat n'a été trouvé.</p>
                            <?php endif; ?>

                            <?php if($searchResults >= 0) : ?>
                            <?php
                            foreach ($searchResults as $sr)
                            {
                            ?>
                            <ul>
                            <li>
                                <a href="index.php?action=blogpost&amp;id=<?php echo $sr->getId() ?>"><?php echo htmlspecialchars($sr->getTitle()); ?></a>
                            </li>
                            </ul>
                            <?php  
                            } 
                            ?>
                            <?php else: ?>
                                <p>Le champ est vide !</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "views/frontend/modules/blog/aside/aside.php"; ?>
    </div>
</div>
<div class="container bottomcontainer">
    <div class="row">
        <?php include "views/frontend/modules/footer/footer.php"; ?>
    </div>
</div>
</div>
<?php $content = ob_get_clean(); ?>
    <?php include 'views/frontend/templates/template.php'; ?>