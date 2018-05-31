<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<div class="container inner">
    <div class="blog box mgbottom2 row">
        <?php include 'view/frontend/includes/top.php' ?>
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
                              foreach ($searchResults as $sr)
                              {
                              ?>
                              <ul>
                                <li>
                                  <a href="index.php?action=blogpost&amp;id=<?= $sr->getId() ?>"><?= htmlspecialchars($sr->getTitle()); ?></a>
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