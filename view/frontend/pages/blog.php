<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<div class="container inner">
    <div class="blog box mgbottom2 row">
        <div class="col-md-12">
            <?php if (isset($_SESSION['pseudo'])) : ?>
                <p class="pull-right">
                    <btn class="btn btn-default logoutbtn"> 
                        <a href="index.php?action=logout">Déconnexion</a> 
                    </btn>
                    <?php if ($_SESSION['avatar'] != '') : ?>
                        <img class="img-responsive img-circle avatarblogpage" src="public/images/avatar/<?= $_SESSION['avatar']; ?>" />
                    <?php else: ?> 
                        <img class="img-responsive img-circle avatarblogpagedefault" src="public/images/avatar/avatardefaut.png" />
                    <?php endif; ?>
                </p>
            <?php else: ?>
                <p class="pull-right">
                    <btn class="btn btn-default"> <a href="index.php?action=loginPage">Connexion</a> </btn>
                </p>
                <p class="pull-right">
                    <btn class="btn btn-default"> <a href="index.php?action=signupPage">Inscription</a> </btn>&nbsp;&nbsp; 
                </p>
            <?php endif; ?>
        </div>
    </div>
    <div class="blog list-view row">
        <div class="col-md-8 col-sm-12 content">
            
            <div class="pagination box mgbottom25">
                <ul>
                    <li><?= '<a class="btn" href="index.php?action=blog&page='. ($currentPage - 1) . '">'.'Précédent'.'</a> '; ?></li>
                        <?php
                        for($i=1;$i<=$totalPages;$i++){
                            if($i == $currentPage) {
                                echo '<li><a class="btn active" href="index.php?action=blog&page='.$i. '">'.$i.'</a></li> ';
                            }
                            else {
                                echo '<li><a class="btn" href="index.php?action=blog&page='.$i. '">'.$i.'</a></li> ';
                            }
                        }
                        ?>
                    <li><?= '<a class="btn" href="index.php?action=blog&page='. ($currentPage + 1) . '">'.'Suivant'.'</a> '; ?></li>
                </ul>
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
                        <h2 class="post-title"><?= htmlspecialchars($p->getTitle()); ?></h2>
                        <h3 class="post-title"><?= htmlspecialchars($p->getChapo()); ?></h3>
                        <h4 class="post-title">Auteur : <?= htmlspecialchars($p->getAuthor()); ?></h4>
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
                            <img src="public/images/posts/<?= $p->getFileExtension(); ?>" class="img-responsive imageblog1" />
                            <?php else: ?>
                            <img src="public/images/posts/default.jpg" class="img-responsive imageblog1" />
                            <?php endif; ?>
                            <p>
                                <?= htmlspecialchars($p->getIntro()); ?> ...
                            </p>
                            <hr>
                            <p class="pull-right"> 
                                <btn class="btn btn-default"><a href="index.php?action=blogpost&amp;id=<?= $p->getId() ?>">Voir plus</a></btn>
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <?php
                }
                
            ?>
            <div class="pagination box">
                <ul>
                    <li><?= '<a class="btn" href="index.php?action=blog&page='. ($currentPage - 1) . '">'.'Précédent'.'</a> '; ?></li>
                        <?php
                        for($i=1;$i<=$totalPages;$i++){
                            if($i == $currentPage) {
                                echo '<li><a class="btn active" href="index.php?action=blog&page='.$i. '">'.$i.'</a></li> ';
                            }
                            else {
                                echo '<li><a class="btn" href="index.php?action=blog&page='.$i. '">'.$i.'</a></li> ';
                            }
                        }
                        ?>
                    <li><?= '<a class="btn" href="index.php?action=blog&page='. ($currentPage + 1) . '">'.'Suivant'.'</a> '; ?></li>
                </ul>
            </div>
        </div>
        <?php require "view/frontend/includes/aside.php"; ?>
    </div>
</div>
<div class="container bottomcontainer">
    <div class="row">
        <?php require "view/frontend/includes/footer.php"; ?>
    </div>
</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/frontend/templates/template.php'; ?>