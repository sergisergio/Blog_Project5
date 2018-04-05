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
              <div class="meta">
                <span class="date">date de dernière publication</span><em>le <?= $post['creation_date_fr'] ?></em>
              </div>
              <div class="news">
                <h3>
                  <?= htmlspecialchars($post['title']) ?>
                </h3>
                <p>
                  <?= nl2br(htmlspecialchars($post['content'])) ?>
                </p>
              </div>
            <!--<figure class="frame"><img src="style/images/basic.png" alt="" /></figure>-->
              <div class="divide20"></div>
              
           
            
            <!--<figure class="frame"> <a href="style/images/code.jpeg" class="fancybox-media" data-rel="portfolio">
              <div class="text-overlay">
                <div class="info">View Larger</div>
              </div>
              <img src="style/images/code.jpeg" alt="" /></a></figure>-->
            
            <!--<div class="meta tags"><a href="#">journal</a>, <a href="#">illustration</a>, <a href="#">design</a>, <a href="#">daily</a></div>
            <!-- /.tags 
            <div class="share"> <a href="#" class="btn share-facebook">Like</a> <a href="#" class="btn share-twitter">Tweet</a> <a href="#" class="btn share-googleplus">+1</a> <a href="#" class="btn share-pinterest">Pin It</a> </div>
            <!-- /.share --> 
            </div>
          <!-- /.post --> 
          </div>
        <!-- /.blog-posts -->
          <div class="divide20"></div>
          <div class="blog-posts">
            <div class="post box">
              <h3>Ajouter un commentaire</h3>
              <form action="index.php?action=addcomment&amp;id=<?= $post['id'] ?>" method="post">
                <div>
                  <label for="member_pseudo">Auteur</label><br />
                  <input type="text" id="member_pseudo" name="member_pseudo" />
                </div>
                <div>
                  <label for="content">Commentaire</label><br />
                  <textarea id="content" name="content"></textarea>
                </div>
                <div>
                  <input class="btn btn-default" type="submit" />
                </div>
              </form>
            </div>
          </div>
          <div class="divide20"></div>
          <div class="blog-posts" id="comments">
            <div class="post box">
              <h3>Commentaires</h3>
                <?php
                  while ($comment = $comments->fetch())
                {
                ?>
              <p>
                <strong><?= htmlspecialchars($comment['member_pseudo']) ?></strong> le <?= $comment['creation_date_fr'] ?>
              </p>
              <p>
                <?= nl2br(htmlspecialchars($comment['content'])) ?>
                <a href="index.php?action=modifyCommentPage&amp;id=<?= $comment['id'] ?>"> (Modifier)</a>
                <a href="index.php?action=deleteCommentPage&amp;id=<?= $comment['id'] ?>" data-toggle='confirmation' id="important_action"> (Supprimer)</a>
              </p>
                <?php
                }
                ?>
            </div>
          </div>

          <div class="divide20"></div>
        </div>
        <!-- /.content -->
        <aside class="col-md-4 col-sm-12 sidebar">
        
          <div class="sidebox box widget">
            <form class="searchform" method="get">
              <input type="text" id="s2" name="s" value="Rechercher" onfocus="this.value=''" onblur="this.value='Rechercher'"/>
            </form>
          </div>       
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
  </div>
<!-- /.body-wrapper --> 
  <?php include "view/frontend/includes/foot.php"; ?>
</body>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
