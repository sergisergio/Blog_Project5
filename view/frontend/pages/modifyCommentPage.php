<?php $title = 'Modification commentaire'; ?>
<?php ob_start(); ?>

  <div class="container inner">
    <div class="blog box mgbottom2 row">
      <div class="col-md-12">
        <!-- INCLUDE TOP -->
        <?php require 'view/frontend/includes/top.php' ?>
        <!-- END INCLUDE TOP -->
      </div>
    </div>
    <div class="single blog row">
      <div class="col-md-8 col-sm-12 content">
        <div class="blog-posts">
          <div class="post box">
            <p>
              <a href="index.php?action=blogpost&amp;id=<?php echo $post->getId() ?>">Retour au billet</a>
            </p>
            <div class="news">
              <h3>
                <?php echo htmlspecialchars($post->getTitle()) ?>
                <em>le <?php echo $post->getCreationDate() ?></em>
              </h3>
              <p>
                <?php echo nl2br(htmlspecialchars($post->getIntro())) ?>...
              </p>
            </div>
            <hr>
            <h2>Modifier le commentaire</h2>
            <!-- FORM MODIFY COMMENT -->
            <?php require "view/frontend/forms/form_modifycomment.php"; ?>
            <!-- END FORM MODIFY COMMENT -->
            <div class="divide20"></div>
          </div>
        </div>
        <div class="divide100"></div>
      </div>
      <!-- INCLUDE ASIDE -->
        <?php require "view/frontend/includes/aside.php"; ?>
      <!-- END INCLUDE ASIDE -->
    </div>
      <div class="container bottomcontainer">
        <div class="row">
            <!-- INCLUDE TOP -->
            <?php require "view/frontend/includes/footer.php"; ?>
            <!-- END INCLUDE TOP -->
        </div>
      </div>
  </div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/frontend/templates/template.php'; ?>