<?php $title = 'Article'; ?>
<?php ob_start(); ?>
<body class="full-layout">

<div class="body-wrapper">
  <?php include "includes/nav.php"; ?>
  <div class="container inner">
    <div class="blog box mgbottom row" style="margin-bottom: 50px;">
      <div class="col-md-12">
        <p class="pull-right">
          <btn class="btn btn-default">
            <a href="index.php?action=connexion">Connexion</a>
          </btn>
        </p>
        <p class="pull-right">
          <btn class="btn btn-default">
            <a href="index.php?action=registration">Inscription</a>
          </btn>&nbsp;&nbsp;
        </p>
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
