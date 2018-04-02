<?php $title = 'Article'; ?>
<?php ob_start(); ?>
<body class="full-layout">

<div class="body-wrapper">
  <?php include "includes/nav.php"; ?>
  
  <div class="container inner">
      <div class="blog box mgbottom row" style="margin-bottom: 50px;">
        <div class="col-md-12">
            <p class="pull-right"><btn class="btn btn-default"><a href="index.php?action=connexion">Connexion</a></btn></p>
            <p class="pull-right"><btn class="btn btn-default"><a href="index.php?action=registration">Inscription</a></btn>&nbsp;&nbsp;</p>
            
          
        </div>
      </div>
    <div class="single blog row">
      <div class="col-md-8 col-sm-12 content">
        <div class="blog-posts">
          <div class="post box">
            
            <p><a href="index.php?action=blogpost&amp;id=<?= $post['id'] ?>">Retour au billet</a></p>

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
        <label for="member_pseudo">Auteur</label><br />
        <input type="text" id="member_pseudo" name="member_pseudo" value="<?= htmlspecialchars($comment['member_pseudo']) ?>" />
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
        <!-- /.widget -->
         <!--<div class="sidebox box widget">
          <h3 class="widget-title section-title">Les plus consultés</h3>
          <ul class="post-list">
            <li>
              <figure class="frame pull-left">
                <div class="icon-overlay"><a href="blog-post.html"><img src=""  alt="" /> </a></div>
              </figure>
              <div class="meta"> <em><span class="date">7 juin 2017</span><!-- <span class="comments"><a href="#">8 <i class="icon-chat-1"></i></a></span></em>
                <h5><a href="blog-post.html">REACT.js</a></h5>
              </div>
            </li>
            <li>
              <figure class="frame pull-left">
                <div class="icon-overlay"><a href="blog-post.html"><img src="#" alt="" /> </a></div>
              </figure>
              <div class="meta"> <em><span class="date">9 juin 2017</span></em>
                <h5><a href="blog-post.html">Les sites</a></h5>
              </div>
            </li>
            <li>
              <figure class="frame pull-left">
                <div class="icon-overlay"><a href="blog-post.html"><img src="#" alt="" /> </a></div>
              </figure>
              <div class="meta"> <em><span class="date">11 juin 2017</span></em>
                <h5><a href="blog-post.html">Jouer en Javascript</a></h5>
              </div>
            </li>
          </ul>
          <!-- /.post-list 
        </div>--> 
        
        <!-- /.widget -->
        <!--<div class="sidebox box widget">
          <h3 class="widget-title section-title">Je suis là aussi</h3>
          <p></p>
          <ul class="social">
           
            <li><a href="https://fr.pinterest.com/ptraon/" target="_blank"><i class="icon-s-pinterest"></i></a></li>
        <li><a href="https://www.linkedin.com/in/philippe-traon-2031ab118/" target="_blank"><i class="icon-s-linkedin"></i></a></li>
        <li><a href="https://github.com/sergisergio"  target="_blank"><i class="icon-s-github"></i></a></li>
        <li><a href="https://www.youtube.com/channel/UCNSAyQeQ132taTopmXCKSvQ/playlists" target="_blank"><i class="icon-s-youtube"></i></a></li>
        <li style="color: green;"><a href="https://www.freecodecamp.com/sergisergio"  target="_blank"> <i class="fa fa-free-code-camp" style="color: green;"></i></a></li>
        <li><a href="https://codepen.io/sergisergio/#"  target="_blank"> <i class="fa fa-codepen"></i></a></li>
</a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
       
        <!-- /.widget -->
        
       <!--<div class="sidebox box widget">
          <h3 class="widget-title section-title">Categories</h3>
          <ul class="circled">
            <li><a href="#">HTML</a></li>
            <li><a href="#">CSS</a></li>
            <li><a href="#">Javascript</a></li>
            <li><a href="#">PHP</a></li>
            <li><a href="#">MySQL</a></li>
          </ul>
        </div>
        <!-- /.widget -->
        <!--<div class="sidebox box widget">
          <h3 class="widget-title section-title">Tags</h3>
          <ul class="tag-list">
            <li><a href="#" class="btn">Web</a></li>
            <li><a href="#" class="btn">HTML</a></li>
            <li><a href="#" class="btn">CSS</a></li>
            <li><a href="#" class="btn">Javascript</a></li>
            <li><a href="#" class="btn">PHP</a></li>
            <li><a href="#" class="btn">MySQL</a></li>
            <li><a href="#" class="btn">Bootstrap</a></li>
            <li><a href="#" class="btn">React</a></li>
            <li><a href="#" class="btn">Redux</a></li>
            <li><a href="#" class="btn">Ruby</a></li>
            <li><a href="#" class="btn">UX</a></li>
            <li><a href="#" class="btn">AJAX</a></li>
          </ul>
          <!-- /.tag-list     
        </div>-->
        
        <!-- /.widget --> 
        
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
