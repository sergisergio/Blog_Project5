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
                                        <?php include "view/frontend/forms/form_search.php"; ?>
                                    </div>
                                    <!-- /.widget -->
                                    <div class="sidebox box widget">
                                        <h4>Derniers articles</h4>
                                        
                                        <?php
                                        while ($data = $posts1->fetch())
                                        {
                                        ?>
                                        <ul>
                                          <li style="list-style: none;">
                                        <a href="index.php?action=blogpost&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']); ?></a>
                                          </li>
                                        </ul>
                                        <?php  
                                          } 
                                            $posts1->closeCursor();
                                        ?>
                                        
                                    </div>
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