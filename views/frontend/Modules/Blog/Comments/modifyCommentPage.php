<?php $title = 'Modification commentaire'; ?>
<?php ob_start(); ?>
  <div class="container inner">
    <div class="blog box mgbottom2 row">
      <div class="col-md-12">
        <?php require 'views/frontend/Modules/Blog/Top/top.php' ?>
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
                <em>le <?php echo $post->getCreation_date() ?></em>
              </h3>
              <p>
                <?php echo nl2br(htmlspecialchars($post->getIntro())) ?>...
              </p>
            </div>
            <hr>
            <h2>Modifier le commentaire</h2>
            <?php require "views/frontend/Modules/Blog/Comments/form_modifycomment.php"; ?>
            <div class="divide20"></div>
          </div>
        </div>
        <div class="divide100"></div>
      </div>
        <?php require "views/frontend/Modules/Blog/Aside/aside.php"; ?>
    </div>
      <div class="container bottomcontainer">
        <div class="row">
            <?php require "views/frontend/Modules/Footer/footer.php"; ?>
        </div>
      </div>
  </div>
<?php $content = ob_get_clean(); ?>
<?php require 'views/frontend/templates/template.php'; ?>