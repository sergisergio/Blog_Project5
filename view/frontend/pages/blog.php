<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<div class="container inner">
    <div class="blog box mgbottom2 row">
        <div class="col-md-12">
        <!-- INCLUDE TOP -->
            <?php require 'view/frontend/includes/top.php' ?>
        <!-- END INCLUDE TOP -->
        </div>
    </div>
    <div class="blog list-view row">
        <div class="col-md-8 col-sm-12 content">
            <!-- PAGINATION -->
            <div class="pagination box mgbottom25">
                <?php require 'view/frontend/includes/paginate.php'; ?>
            </div>
            <!-- END PAGINATION -->
            <!-- ALL POSTS -->
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
                                if ($p->getLastUpdated()) {
                                    echo ($p->getLastUpdated());
                                }
                                else {
                                    echo ($p->getCreationdate());
                                }
                                    ?>
                                </div> 
                                <div class="divide30"></div>
                                <?php if ($p->getFileExtension() != '') : ?>
                                <img src="public/images/posts/<?php echo $p->getFileExtension(); ?>" class="img-responsive imageblog1" />
                                <?php else: ?>
                                <img src="public/images/posts/default.jpg" class="img-responsive imageblog1" />
                                <?php endif; ?>
                                <p>
                                    <?php echo htmlspecialchars($p->getIntro()); ?> ...
                                </p>
                                <hr>
                                <p class="pull-right"> 
                                    <btn class="btn btn-default"><a href="index.php?action=blogpost&amp;id=<?php echo $p->getId() ?>">Voir plus</a></btn>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            <!-- END ALL POSTS -->
            <!-- PAGINATION -->
            <div class="pagination box">
                <?php require 'view/frontend/includes/paginate.php'; ?>
            </div>
            <!-- END PAGINATION -->
        </div>
        <!-- ASIDE -->
        <?php require "view/frontend/includes/aside.php"; ?>
        <!-- END ASIDE -->
    </div>
</div>
<div class="container bottomcontainer">
    <div class="row">
        <!-- FOOTER -->
        <?php require "view/frontend/includes/footer.php"; ?>
        <!-- END FOOTER -->
    </div>
</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/frontend/templates/template.php'; ?>