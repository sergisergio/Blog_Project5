<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<div class="container inner">
    <div class="blog box mgbottom2 row">
        <?php require 'views/frontend/Modules/Blog/Top/top.php' ?>
    </div>
    <div class="blog list-view row">
        <div class="col-md-8 col-sm-12 content">
            <div class="blog-posts">
                <div class="post box">
                    <div class="row">
                        <div class="col-sm-12 post-content">
                            <!-- <?php if($nbResults > 1) : ?>
                            <p>Nous avons trouvé <?php echo  $nbResults; ?> résultats correspondant à votre requête.</p>
                            <?php elseif($nbResults == 1) : ?>
                            <p>Nous avons trouvé <?php echo  $nbResults; ?> résultat correspondant à votre requête.</p>
                            <?php else: ?>
                            <p>Aucun résultat n'a été trouvé.</p>
                            <?php endif; ?>-->

                            <?php
                            foreach ($cResults as $c)
                            {
                            ?>
                            <ul>
                            <li>
                                <a href="index.php?action=blogpost&amp;id=<?php echo $c->getId() ?>"><?php echo htmlspecialchars($c->getTitle()); ?></a>
                            </li>
                            </ul>
                            <?php  
                            } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require "views/frontend/Modules/Blog/Aside/aside.php"; ?>
    </div>
</div>
<div class="container bottomcontainer">
    <div class="row">
        <?php require "views/frontend/Modules/Footer/footer.php"; ?>
    </div>
</div>
</div> 
<?php $content = ob_get_clean(); ?>
    <?php require 'views/frontend/templates/template.php'; ?>