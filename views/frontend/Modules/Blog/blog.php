<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<div class="container inner">
    <div class="blog box mgbottom2 row">
        <div class="col-md-12">
            <?php include 'views/frontend/modules/blog/top/top.php' ?>
        </div>
    </div>
    <div class="blog list-view row">
        <div class="col-md-8 col-sm-12 content">
            <div class="pagination box mgbottom25">
                <?php include 'views/frontend/modules/paginate/paginate.php'; ?>
            </div>
            <?php
            foreach ($posts as $p) 
            {
            ?>
            <div class="blog-posts">
            <div class="post box">
                <div class="row">
                    <div class="col-sm-12 post-content">
                        <div class="post-title">
                            <h2 class="post-title"><?php echo htmlspecialchars($p->getTitle()); ?></h2>
                            <h3 class="post-title"><?php echo htmlspecialchars($p->getChapo()); ?></h3>
                            <h4 class="post-title">Auteur : <?php echo htmlspecialchars($p->getAuthor()); ?></h4>
                            <div class="meta">
                                <span class="date"></span>
                                <?php
                                if ($p->getLast_updated()) {
                                    echo ($p->getLast_updated());
                                }
                                else {
                                    echo ($p->getCreation_date());
                                }
                                ?>
                            </div> 
                            <div class="divide30"></div>
                                <?php if ($p->getFile_extension() != '') : ?>
                                <img src="public/images/posts/<?php echo $p->getFile_extension(); ?>" class="img-responsive imageblog1" alt="imagePosts" />
                                <?php else: ?>
                                <img src="public/images/posts/default.jpg" class="img-responsive imageblog1" alt="imagePosts" />
                                <?php endif; ?>
                                <?php echo htmlspecialchars_decode($p->getIntro()); ?> ...
                                <hr>
                                <a href="index.php?action=blogpost&amp;id=<?php echo $p->getId() ?>" class="btn btn-default btn-lg pull-right" role="button">Voir plus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="pagination box">
                <?php include 'views/frontend/modules/paginate/paginate.php'; ?>
            </div>
        </div>
        <?php include "views/frontend/modules/blog/aside/aside.php"; ?>
    </div>
    <div class="container bottomcontainer">
        <div class="row">
            <?php include "views/frontend/modules/footer/footer.php"; ?>
        </div>
    </div>
</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include 'views/frontend/templates/template.php'; ?>