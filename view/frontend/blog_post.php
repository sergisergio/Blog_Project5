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
            <div class="meta"><span class="date">date de dernière publication</span><em>le <?= $post['creation_date_fr'] ?></em></div>
            
            
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
        
        <!--<div class="about-author box">
          <div class="author-image frame"> <img alt="" src="style/images/art/author.jpg" /> </div>
          <div class="author-details">
            <h3>About the author</h3>
            <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh, ut fermentum massa justo sit amet risus. Maecenas faucibus mollis.</p>
            <ul class="social">
              <li><a href="#"><i class="icon-s-twitter"></i></a></li>
              <li><a href="#"><i class="icon-s-facebook"></i></a></li>
              <li><a href="#"><i class="icon-s-pinterest"></i></a></li>
              <li><a href="#"><i class="icon-s-dribbble"></i></a></li>
              <li><a href="#"><i class="icon-s-linkedin"></i></a></li>
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
        <!-- /.about-author -->
        
        <div class="divide20"></div>
        
        <!--<div id="comments" class="box">
          <h3>4 Comments</h3>
          <ol id="singlecomments" class="commentlist">
            <li>
              <div class="user frame"><img alt="" src="style/images/art/u1.jpg" class="avatar" /></div>
              <div class="message">
                <div class="info">
                  <h2><a href="#">Connor Gibson</a></h2>
                  <div class="meta">
                    <div class="date">January 14, 2010</div>
                    <a class="reply-link" href="#">Reply</a> </div>
                </div>
                <p>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Sed posuere consectetur est at lobortis. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Vestibulum id ligula porta felis euismod semper.</p>
              </div>
            </li>
            <li>
              <div class="user frame"><img alt="" src="style/images/art/u2.jpg" class="avatar" /></div>
              <div class="message">
                <div class="info">
                  <h2><a href="#">Nikolas Brooten</a></h2>
                  <div class="meta">
                    <div class="date">February 21, 2010</div>
                    <a class="reply-link" href="#">Reply</a> </div>
                </div>
                <p>Quisque tristique tincidunt metus non aliquam. Quisque ac risus sit amet quam sollicitudin vestibulum vitae malesuada libero. Mauris magna elit, suscipit non ornare et, blandit a tellus. Pellentesque dignissim ornare elit, quis mattis eros sodales ac.</p>
              </div>
              <ul class="children">
                <li class="bypostauthor">
                  <div class="user frame"><img alt="" src="style/images/art/u3.jpg" class="avatar" /></div>
                  <div class="message">
                    <div class="bypostauthor">
                      <div class="info">
                        <h2><a href="#">Pearce Frye</a></h2>
                        <div class="meta">
                          <div class="date">February 22, 2010</div>
                          <a class="reply-link" href="#">Reply</a> </div>
                      </div>
                      <p>Cras mattis consectetur purus sit amet fermentum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Etiam porta sem malesuada magna mollis euismod. Maecenas sed diam eget risus varius blandit non magna.</p>
                    </div>
                  </div>
                  <ul class="children">
                    <li>
                      <div class="user frame"><img alt="" src="style/images/art/u2.jpg" class="avatar" /></div>
                      <div class="message">
                        <div class="info">
                          <h2><a href="#">Nikolas Brooten</a></h2>
                          <div class="meta">
                            <div class="date">April 4, 2010</div>
                            <a class="reply-link" href="#">Reply</a> </div>
                        </div>
                        <p>Nullam id dolor id nibh ultricies vehicula ut id. Cras mattis consectetur purus sit amet fermentum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li>
              <div class="user frame"><img alt="" src="style/images/art/u4.jpg" class="avatar" /></div>
              <div class="message">
                <div class="info">
                  <h2><a href="#">Lou Bloxham</a></h2>
                  <div class="meta">
                    <div class="date">May 03, 2010</div>
                    <a class="reply-link" href="#">Reply</a> </div>
                </div>
                <p>Sed posuere consectetur est at lobortis. Vestibulum id ligula porta felis euismod semper. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
              </div>
            </li>
          </ol>
        </div>
        <!-- /#comments -->
        
        <div class="divide20"></div>
        
        <!--<div class="comment-form-wrapper box">
          <h3>Would you like to share your thoughts?</h3>
          <p>Your email address will not be published. Required fields are marked *</p>
          <form class="comment-form" name="form_name" action="#" method="post">
            <div class="name-field">
              <input type="text" name="first" title="Name*"/>
            </div>
            <div class="email-field">
              <input type="text" name="first" title="Email*" />
            </div>
            <div class="website-field">
              <input type="text" name="first" title="Website" />
            </div>
            <div class="message-field">
              <textarea name="textarea" id="textarea" rows="5" cols="30" title="Enter your comment here..."></textarea>
            </div>
            <input type="submit" value="Submit" name="submit" class="btn btn-submit" />
          </form>
        </div>
        <!-- /.comment-form-wrapper --> 

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

        <div class="blog-posts">
          <div class="post box">
                <h3>Commentaires</h3>

                <?php
        while ($comment = $comments->fetch())
        {
        ?>
            <p><strong><?= htmlspecialchars($comment['member_pseudo']) ?></strong> le <?= $comment['creation_date_fr'] ?></p>
            <p><?= nl2br(htmlspecialchars($comment['content'])) ?><a href="index.php?action=modifyCommentPage&amp;id=<?= $comment['id'] ?>"> (Modifier)</a></p>

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
