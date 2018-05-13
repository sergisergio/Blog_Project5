<aside class="col-md-4 col-sm-12 sidebar">
  <div class="sidebox box widget">
    <?php include "view/frontend/forms/form_search.php"; ?>
  </div>
  <div class="sidebox box widget">
    <h4 class="text-center">Derniers articles</h4>
    <?php
      while ($data = $posts1->fetch())
      {
      ?>
      <ul>
        <li>
          <a href="index.php?action=blogpost&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']); ?></a>
        </li>
      </ul>
      <?php  
        } 
        $posts1->closeCursor();
      ?>
  </div>
  <div class="sidebox box widget">
    <h4 class="text-center">Ressources</h4>
    <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a data-toggle="collapse" class="panel-toggle" data-parent="#accordion" href="#collapseOne"> Openclassrooms</a> </h4> 
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body"> 
                              <ul>
                                
                                <li><a href="https://openclassrooms.com/courses/debutez-l-analyse-logicielle-avec-uml" target="_blank">Analyse logicielle avec UML</a></li>
                                <li><a href="https://openclassrooms.com/courses/faites-une-base-de-donnees-avec-uml" target="_blank">Base de données avec UML</a></li>
                                <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                                <li><a href="https://openclassrooms.com/courses/concevez-votre-site-web-avec-php-et-mysql" target="_blank">PHP / MySQL</a></li>
                                <li><a href="https://openclassrooms.com/courses/adoptez-une-architecture-mvc-en-php" target="_blank">Architecture MVC</a></li>
                                <li><a href="https://openclassrooms.com/courses/programmez-en-oriente-objet-en-php" target="_blank">PHP orienté objet</a></li>
                                <li><a href="https://openclassrooms.com/courses/administrez-vos-bases-de-donnees-avec-mysql" target="_blank">MySQL</a></li>
                                <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                                <li><a href="https://openclassrooms.com/courses/gerer-son-code-avec-git-et-github" target="_blank">Git et Github</a></li>
                                <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                                <li><a href="https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony" target="_blank">Symfony</a></li>
                                <li><a href="https://openclassrooms.com/courses/construisez-une-api-rest-avec-symfony" target="_blank">API REST avec Symfony</a></li>
                                <li><a href="https://openclassrooms.com/courses/testez-et-suivez-l-etat-de-votre-application-php" target="_blank">Tester une application PHP</a></li>
                                <li><a href="https://openclassrooms.com/courses/testez-fonctionnellement-votre-application-symfony" target="_blank">Tester une application Symfony</a></li>
                              </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a data-toggle="collapse" class="panel-toggle" data-parent="#accordion" href="#collapseTwo"> PHP</a> </h4> 
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body"> 
                               <ul>
                                <li><a href="http://php.net/manual/en/" target="_blank">Doc PHP</a></li>
                                <li><a href="https://insight.sensiolabs.com" target="_blank">SensioLabsInsight</a></li>
                                <li><a href="https://www.codacy.com" target="_blank">Codacy</a></li>
                                <li><a href="https://www.php-fig.org/psr/" target="_blank">PSR</a></li>
                                <li><a href="https://www.grafikart.fr/formations/programmation-objet-php" target="_blank">Grafikart POO</a></li>
                                
                              </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a data-toggle="collapse" class="panel-toggle active" data-parent="#accordion" href="#collapseThree"> MySQL</a> </h4> 
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body"> 
                                <ul>
                                <li><a href="https://dev.mysql.com/doc/" target="_blank">Doc MySQL</a></li>
                                <li><a href="https://www.mysql.com/fr/products/workbench/" target="_blank">MySQL Workbench</a></li>
                              </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a data-toggle="collapse" class="panel-toggle" data-parent="#accordion" href="#collapseFour">Outils</a> </h4> 
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse">
                            <div class="panel-body">
                              <ul>
                                <li><a href="https://filezilla-project.org" target="_blank">Filezilla</a></li>
                                <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                                <li><a href="http://brackets.io" target="_blank">Brackets</a></li>
                                <li><a href="https://www.sublimetext.com" target="_blank">Sublime Text</a></li>
                                <li><a href="https://www.jetbrains.com/phpstorm/" target="_blank">PhpStorm</a></li>
                                <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                                <li><a href="http://www.wampserver.com" target="_blank">WAMP</a></li>
                                <li><a href="https://www.mamp.info/en/" target="_blank">MAMP</a></li>
                                <li><a href="https://doc.ubuntu-fr.org/lamp" target="_blank">LAMP</a></li>
                                <li><a href="https://www.apachefriends.org/fr/index.html" target="_blank">XAMPP</a></li>
                                <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                                <li><a href="https://fr.wordpress.org" target="_blank">Wordpress.org</a></li>
                                <li><a href="https://codex.wordpress.org" target="_blank">Codex Wordpress</a></li>
                                <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                                <li><a href="https://www.draw.io" target="_blank">Draw.io</a></li>
                                <li><a href="https://eclipse.org/papyrus/" target="_blank">Papyrus</a></li>
                                <li><a href="http://software.sqlpower.ca/page/architect" target="_blank">SQL POWER ARCHITECT</a></li>
                                <li><a href="https://www.postgresql.org" target="_blank">PostgreSQL</a></li>
                                <li><a href="https://eggerapps.at/postico/" target="_blank">Postico</a></li>
                                <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                                <li><a href="https://getcomposer.org" target="_blank">Composer</a></li>
                                <li><a href="https://twig.symfony.com" target="_blank">Twig</a></li>
                                
                              </ul>
                            </div>
                        </div>
                    </div>
                </div>
  </div>
  <?php if(isset($_SESSION['pseudo'])): ?>
  <div class="sidebox box widget" id="colortheme">

    <?php if(isset($_SESSION['flash'])): ?>
        <?php foreach($_SESSION['flash'] as $type => $message): ?>
            <div class="text-center alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
    
    <h4 class="text-center">Change ton look <?= $_SESSION['pseudo'] ?> !</h4>
    
        <a href="index.php?action=changeColorAqua"><i class="budicon-brush" style="color: #4db0c6;"></i></a>
        <a href="index.php?action=changeColorBlue"><i class="budicon-brush" style="color: #7498bc;"></i></a>
        <a href="index.php?action=changeColorGray"><i class="budicon-brush" style="color: #c2c2c2;"></i></a>
        <a href="index.php?action=changeColorGreen"><i class="budicon-brush" style="color: #9cbc68;"></i></a>
        <a href="index.php?action=changeColorOrange"><i class="budicon-brush" style="color: #e18e4a;"></i></a>
        <a href="index.php?action=changeColorPink"><i class="budicon-brush" style="color: #b0688c;"></i></a>
        <a href="index.php?action=changeColorRed"><i class="budicon-brush" style="color: #d85b5b;"></i></a>
        <a href="index.php?action=changeColorYellow"><i class="budicon-brush" style="color: #d1cd56;"></i></a>
    </div>
    <?php endif; ?>
  
</aside>