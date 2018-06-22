<?php $title = 'Mon blog'; ?>
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