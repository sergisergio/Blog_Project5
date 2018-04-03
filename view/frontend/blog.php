<?php $title = 'Mon blog'; ?>
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
                    <?= ($data['last_updated_fr']);?>
                    <!--<span class="comments"><a href="#">8 <i class="icon-chat-1"></i></a></span>-->
                  </div>
                  <h2 class="post-title"><a href="blog-post.php"><?php echo htmlspecialchars($data['title']); ?></a></h2>
                  <p><?php echo htmlspecialchars($data['intro']); ?></p>
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
          <form class="searchform" method="get">
            <input type="text" id="s2" name="s" value="Rechercher" onfocus="this.value=''" onblur="this.value='Rechercher'"/>
          </form>
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
