<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<body class="full-layout">

  <div class="body-wrapper">
    <?php include "includes/nav.php"; ?>
  
    <div class="container inner">
      <div class="blog box mgbottom row" style="margin-bottom: 50px;">
        <div class="col-md-12">
          <?php if (isset($_SESSION['pseudo'])): ?>
            <p class="pull-left">
            <btn class="btn btn-default">
              <a href="index.php?action=profilePage">Voir mon profil</a>
            </btn>
            </p>

            <p class="pull-right">
            <btn class="btn btn-default">
              <a href="index.php?action=logout">Déconnexion</a>
            </btn>
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
            </btn>&nbsp;&nbsp;
          </p>
          <?php endif; ?>
        </div>
      </div>
      <div class="blog list-view row">
        <div class="col-md-8 col-sm-12 content">
          <?php
            while ($data = $posts->fetch())
          {
          ?>
          <div class="blog-posts">
            <div class="post box">
              <div class="row">
                <div class="col-sm-12 post-content">
                  <div class="meta">  
                    <!--<span class="category">Journal</span>-->
                    <span class="date">date de dernière publication</span> : 
                    <?php
                    if (isset($data['last_updated_fr'])) {
                      echo ($data['last_updated_fr']);
                    }
                    else
                      echo ($data['creation_date_fr']);
                    ?>
                    <!--<span class="comments"><a href="#">8 <i class="icon-chat-1"></i></a></span>-->
                  </div>
                  <h2 class="post-title"><?= htmlspecialchars($data['title']); ?></h2>
                  <h3 class="post-title">Auteur : <?= ($data['author']); ?></h3>
                  <img src="<?= $data['file_extension']; ?>" class="img-responsive" />
                  <p><?= htmlspecialchars($data['intro']); ?></p>
                  <hr>
                  <p class="pull-right">
                    <a href="index.php?action=blogpost&amp;id=<?= $data['id'] ?>">Voir plus</a>
                  </p>
                </div>
                <!-- /column -->
              </div>
            <!-- /.row -->
            </div>
          <!-- /.post -->
          </div>
          <?php
          } // Fin de la boucle des billets
            $posts->closeCursor();
          ?>
          <!-- /.blog-posts -->
          <div class="pagination box">
            <ul>
              <li><a href="#" class="btn">Prec</a></li>
              <li class="active"><a href="#" class="btn"><span>1</span></a></li>
              <li><a href="#" class="btn"><span>2</span></a></li>
              <li><a href="#" class="btn"><span>3</span></a></li>
              <li><a href="#" class="btn">Suiv</a></li>
            </ul>
          </div>
        <!-- /.pagination --> 
        </div>
      <!-- /.content -->
        <aside class="col-md-4 col-sm-12 sidebar">
        <!--<div class="sidebox box widget">
          <h3 class="widget-title section-title">Mise en page</h3>
          <p>Chacun a une préférence de lecture :-)</p>
          <ul class="layout-switcher">
            <li><a href="blog.html" class="btn btn-small hint--top active" data-hint="Liste"><i class="icon-menu-1"></i></a></li>
          </ul> 
        </div>
        <!-- /.widget -->
        
        <div class="sidebox box widget">
          
          <?php include "forms/form_search.php"; ?>
        </div>
        <!-- /.widget -->
        
        <!--<div class="sidebox box widget">
          <h3 class="widget-title section-title">Les plus consultés</h3>
          <ul class="post-list">
            <li>
              <figure class="frame pull-left">
                <div class="icon-overlay"><a href="blog-post.php"><img src=""  alt="" /> </a></div>
              </figure>
              <div class="meta"> <em><span class="date">7 juin 2017</span><!-- <span class="comments"><a href="#">8 <i class="icon-chat-1"></i></a></span></em>
                <h5><a href="blog-post.php">REACT.js</a></h5>
              </div>
            </li>
          </ul>
          <!-- /.post-list  
        </div>-->
        <!-- /.widget -->
        
        <!--<div class="sidebox box widget">
        </div>
        <!-- /.widget -->
        
        <!--<div class="sidebox box widget">
          <h3 class="widget-title section-title">Categories</h3>
          <ul class="circled">
            <li><a href="#">HTML</a></li>
          </ul>
        </div>
        <!-- /.widget -->
        
        <!--<div class="sidebox box widget">
          <h3 class="widget-title section-title">Tags</h3>
          <ul class="tag-list">
            <li><a href="#" class="btn">Web</a></li>
            
          </ul>
          <!-- /.tag-list    
        </div>-->
        <!-- /.widget --> 
        
        </aside>
      <!-- /column .sidebar --> 
      </div>
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
