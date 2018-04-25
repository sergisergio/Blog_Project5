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
            <form action="index.php?action=modifyComment&amp;id=<?= $comment['id'] ?>" method="post">
              <div>
                <label for="author">Auteur</label><br />
                <input type="text" id="author" name="author" value="<?= htmlspecialchars($comment['author']) ?>" />
              </div>
              <div>
                <label for="content">Commentaire</label><br />
                <textarea id="content" name="content"><?= htmlspecialchars($comment['content']) ?></textarea>
              </div>
              <div>
                <input type="submit" />
              </div>
            </form>
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
          <form class="searchform" method="get">
            <input type="text" id="s2" name="s" value="Rechercher" onfocus="this.value=''" onblur="this.value='Rechercher'"/>
          </form>
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
<!-- /.body-wrapper --> 
  <script src="public/js/jquery.min.js"></script> 
  <script src="public/js/bootstrap.min.js"></script> 
  <script src="public/js/jquery.themepunch.tools.min.js"></script> 
  <script src="public/js/classie.js"></script> 
  <script src="public/js/plugins.js"></script> 
  <script src="public/js/scripts.js"></script>  
  <script>
	 $.backstretch(["public/images/art/react2.png"]);
  </script>
</body>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
