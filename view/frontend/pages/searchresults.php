<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<div class="container inner">
    <div class="blog box mgbottom2 row">
        <div class="col-md-12">
            <?php if (isset($_SESSION['pseudo'])): ?>
                <p class="pull-left">
                    <btn class="btn btn-default"> 
                        <a href="index.php?action=profilePage">Voir mon profil</a> 
                    </btn>
                </p>
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
            
            <div class="blog-posts">
                <div class="post box">
                    <div class="row">
                        <div class="col-sm-12 post-content">
                            <?php if($nbResults > 1): ?>
                            <p>Nous avons trouvé <?=  $nbResults; ?> résultats correspondant à votre requête.</p>
                            <?php elseif($nbResults == 1): ?>
                            <p>Nous avons trouvé <?=  $nbResults; ?> résultat correspondant à votre requête.</p>
                            <?php else: ?>
                            <p>Aucun résultat n'a été trouvé.</p>
                            <?php endif; ?>


                            <?php
                              while ($data = $results->fetch())
                              {
                              ?>
                              <ul>
                                <li>
                                  <a href="index.php?action=blogpost&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']); ?></a>
                                </li>
                              </ul>
                              <?php  
                                } 
                                $results->closeCursor();
                              ?>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <?php include "view/frontend/includes/aside.php"; ?>
    </div>
</div>
<div class="container bottomcontainer">
    <div class="row">
        <?php include "view/frontend/includes/footer.php"; ?>
    </div>
</div>
</div> <!-- end body-wrapper -->
<?php $content = ob_get_clean(); ?>
    <?php require('view/frontend/templates/template.php'); ?>