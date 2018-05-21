<?php $title = 'Modification commentaire'; ?>
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
              <img class="img-responsive img-circle avatarblogpage2" src="public/images/avatar/<?= $_SESSION['avatar']; ?>" />
            <?php else: ?> <img class="img-responsive img-circle avatarblogpagedefault" src="public/images/avatar/avatardefaut.png" />
            <?php endif; ?>
          </p>
        <?php else: ?>
          <p class="pull-right">
            <btn class="btn btn-default"> 
              <a href="index.php?action=loginPage">Connexion</a> 
            </btn>
          </p>
          <p class="pull-right">
            <btn class="btn btn-default"> 
              <a href="index.php?action=signupPage">Inscription</a> 
            </btn>&nbsp;&nbsp; </p>
        <?php endif; ?>
      </div>
    </div>
    <div class="single blog row">
      <div class="col-md-8 col-sm-12 content">
        <div class="blog-posts">
          <div class="post box">
            <p>
              <a href="index.php?action=blogpost&amp;id=<?= $post['id'] ?>">Retour au billet</a>
            </p>
            <div class="news">
              <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
              </h3>
              <p>
                <?= nl2br(htmlspecialchars($post['intro'])) ?>...
              </p>
            </div>
            <hr>
            <h2>Modifier le commentaire</h2>
            <?php include "forms/form_modifycomment.php"; ?>
            <div class="divide20"></div>
          </div>
        </div>
        <div class="divide20"></div>
        <div class="divide20"></div>
        <div class="divide20"></div>
        <div class="divide20"></div>
        <div class="divide20"></div>
      </div>
          <?php include "includes/aside.php"; ?>
    </div>
      <div class="container bottomcontainer">
        <div class="row">
          <?php include "includes/footer.php"; ?>
        </div>
      </div>
  </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>