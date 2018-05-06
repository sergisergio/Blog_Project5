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

                                    <div class="sidebox box widget">
                                        <h4>Ressources</h4>
                                        
                                        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="60000">
                                          <!-- Indicators -->
                                          <!--<ol class="carousel-indicators">
                                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#myCarousel" data-slide-to="1"></li>
                                            <li data-target="#myCarousel" data-slide-to="2"></li>
                                          </ol>-->

                                          <!-- Wrapper for slides -->
                                          <div class="carousel-inner">
                                            <div class="item active">
                                              <img src="public/images/ressources/logoOC.png" class="img-responsive" alt="LogoOC">
                                            </div>

                                            <div class="item">
                                              <img src="public/images/ressources/grafikart.png" class="img-responsive" alt="Grafikart">
                                            </div>

                                            <div class="item">
                                              <img src="" class="img-responsive" alt="New York">
                                            </div>
                                          </div>

                                          <!-- Left and right controls -->
                                          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                            <span class="budicon-arrow-left" style="top: 40%;left: 5px;position: absolute;font-size: 1.5em;"></span>
                                            <span class="sr-only">Previous</span>
                                          </a>
                                          <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                            <span class="budicon-arrow-right" style="top: 40%;right: 5px;position: absolute;font-size: 1.5em;""></span>
                                            <span class="sr-only">Next</span>
                                          </a>
                                        </div>
                                        
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