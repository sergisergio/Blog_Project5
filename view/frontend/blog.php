<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<div class="container inner">
    <div class="blog box mgbottom2 row">
        <div class="col-md-12">
            <?php if (isset($_SESSION['pseudo'])): ?>
                <p class="pull-right">
                    <btn class="btn btn-default logoutbtn"> 
                        <a href="index.php?action=logout">Déconnexion</a> 
                    </btn>
                    <?php if ($_SESSION['avatar'] != ''): ?>
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
                while ($data = $posts->fetch())
                {
            ?>
            <div class="blog-posts">
                <div class="post box">
                    <div class="row">
                        <div class="col-sm-12 post-content">
                            <div class="post-title">
                            <h2 class="post-title"><?= htmlspecialchars($data['title']); ?></h2>
                            <h3 class="post-title"><?= htmlspecialchars($data['chapo']); ?></h3>
                            <h4 class="post-title">Auteur : <?= htmlspecialchars($data['author']); ?></h4>
                            <div class="meta">
                                <span class="date"></span>
                                <?php
                                    if (isset($data['last_updated_fr'])) {
                                        echo htmlspecialchars($data['last_updated_fr']);
                                    }
                                    else
                                        echo htmlspecialchars($data['creation_date_fr']);
                                ?>
                            </div> 
                            <div class="divide30"></div>
                            <img src="public/images/posts/<?= $data['file_extension']; ?>" class="img-responsive imageblog1" />
                            <p>
                                <?= htmlspecialchars($data['intro']); ?> ...
                            </p>
                            <hr>
                            <p class="pull-right"> 
                                <btn class="btn btn-default"><a href="index.php?action=blogpost&amp;id=<?= $data['id'] ?>">Voir plus</a></btn>
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <?php
                }
                $posts->closeCursor();
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
        <?php include "includes/aside.php"; ?>
    </div>
</div>
<div class="container bottomcontainer">
    <div class="row">
        <?php include "includes/footer.php"; ?>
    </div>
</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>