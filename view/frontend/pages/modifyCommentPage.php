<?php $title = 'Modification commentaire'; ?>
<?php ob_start(); ?>

  <div class="container inner">
    <div class="blog box mgbottom2 row">
      <div class="col-md-12">
        <?php include 'view/frontend/includes/top.php' ?>
      </div>
    </div>
    <div class="single blog row">
      <div class="col-md-8 col-sm-12 content">
        <div class="blog-posts">
          <div class="post box">
            <p>
              <a href="index.php?action=blogpost&amp;id=<?= $post->getId() ?>">Retour au billet</a>
            </p>
            <div class="news">
              <h3>
                <?= htmlspecialchars($post->getTitle()) ?>
                <em>le <?= $post->getCreationDate() ?></em>
              </h3>
              <p>
                <?= nl2br(htmlspecialchars($post->getIntro())) ?>...
              </p>
            </div>
            <hr>
            <h2>Modifier le commentaire</h2>
            <?php require "view/frontend/forms/form_modifycomment.php"; ?>
            <div class="divide20"></div>
          </div>
        </div>
        <div class="divide20"></div>
        <div class="divide20"></div>
        <div class="divide20"></div>
        <div class="divide20"></div>
        <div class="divide20"></div>
      </div>
            <?php require "view/frontend/includes/aside.php"; ?>
    </div>
      <div class="container bottomcontainer">
        <div class="row">
            <?php require "view/frontend/includes/footer.php"; ?>
        </div>
      </div>
  </div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/frontend/templates/template.php'; ?>