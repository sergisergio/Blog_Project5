<?php $title = 'Article'; ?>
<?php ob_start(); ?>
<body class="full-layout">

<div class="body-wrapper">
  <?php include "includes/nav.php"; ?>
  <div class="container inner">
    <div class="blog box mgbottom row" style="margin-bottom: 50px;">
      <div class="col-md-12">
        <?php if (isset($_SESSION['pseudo'])): ?>
                                        <p class="pull-left">
                                            <btn class="btn btn-default"> <a href="index.php?action=profilePage">Voir mon profil</a> </btn>
                                        </p>
                                        <p class="pull-right">
                                            <btn style="float: right;" class="btn btn-default"> <a href="index.php?action=logout">Déconnexion</a> </btn>
                                            <?php if ($_SESSION['avatar'] != ''): ?> <img style="width: 10%;float: right;margin: 0 20px;" class="img-responsive img-circle" src="public/images/avatar/<?php echo $_SESSION['avatar']; ?>" />
                                                <?php else: ?> <img style="width: 5%;float: right;margin: 0 20px;" class="img-responsive img-circle" src="public/images/avatar/avatardefaut.png" />
                                                    <?php endif; ?>
                                        </p>
                                        <?php else: ?>
                                            <p class="pull-right">
                                                <btn class="btn btn-default"> <a href="index.php?action=loginPage">Connexion</a> </btn>
                                            </p>
                                            <p class="pull-right">
                                                <btn class="btn btn-default"> <a href="index.php?action=signupPage">Inscription</a> </btn>&nbsp;&nbsp; </p>
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
                <?= nl2br(htmlspecialchars($post['intro'])) ?>
              </p>
            </div>
            <h2>Modifier le commentaire</h2>
            <?php include "forms/form_modifycomment.php"; ?>
            <div class="divide20"></div>
          </div>
          <!-- /.post --> 
        </div>
        <!-- /.blog-posts -->
        <div class="divide20"></div>
        <div class="divide20"></div>
        <div class="divide20"></div>
        <div class="divide20"></div>
        <div class="divide20"></div>
      </div>
      <!-- /.content -->
      <aside class="col-md-4 col-sm-12 sidebar">
        <div class="sidebox box widget">
          <?php include "forms/form_search.php"; ?>
        </div>
        <div class="clearfix"></div>       
      </aside>
      <!-- /column .sidebar -->    
    <!-- /.blog --> 
    
    </div>
  <!-- /.container --> 
      <div class="container" style="margin-top: 130px;">
        <div class="row">
          <?php include "includes/footer.php"; ?>
        </div>
      </div>
  </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
