<aside class="col-md-4 col-sm-12 sidebar">
    <div class="sidebox box widget">
        <?php require "view/frontend/forms/form_search.php"; ?>
    </div>
    <div class="sidebox box widget">
        <h4 class="text-center">Derniers articles</h4>
        <?php
        foreach ($postsAside as $p) 
        {
        ?>
        <ul>
            <li>
                <a href="index.php?action=blogpost&amp;id=<?php echo $p->getId() ?>"><?php echo htmlspecialchars($p->getTitle()); ?></a>
            </li>
        </ul>
        <?php  
        } 
        ?>
    </div>
    <div class="sidebox box widget">
        <h4 class="text-center">catégories</h4>
            <?php
            foreach ($categories as $c) 
            {
            ?>
            <ul>
                <li>
                    <a href="index.php?action=categoryresults&amp;id=<?php echo $c->getCategoryId() ?>"><?php echo htmlspecialchars($c->getCategory()); ?></a>
                </li>
            </ul>
            <?php  
            } 
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
                        </ul>
                        <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                        <ul>
                            <li><a href="https://openclassrooms.com/courses/concevez-votre-site-web-avec-php-et-mysql" target="_blank">PHP / MySQL</a></li>
                            <li><a href="https://openclassrooms.com/courses/adoptez-une-architecture-mvc-en-php" target="_blank">Architecture MVC</a></li>
                            <li><a href="https://openclassrooms.com/courses/programmez-en-oriente-objet-en-php" target="_blank">PHP orienté objet</a></li>
                            <li><a href="https://openclassrooms.com/courses/administrez-vos-bases-de-donnees-avec-mysql" target="_blank">MySQL</a></li>
                        </ul>
                        <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                        <ul>
                            <li><a href="https://openclassrooms.com/courses/gerer-son-code-avec-git-et-github" target="_blank">Git et Github</a></li>
                        </ul>
                        <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                        <ul>
                            <li><a href="https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony" target="_blank">Symfony</a></li>
                            <li><a href="https://openclassrooms.com/courses/construisez-une-api-rest-avec-symfony" target="_blank">API REST avec Symfony</a></li>
                            <li><a href="https://openclassrooms.com/courses/testez-et-suivez-l-etat-de-votre-application-php" target="_blank">Tester une application PHP</a></li>
                            <li><a href="https://openclassrooms.com/courses/testez-fonctionnellement-votre-application-symfony" target="_blank">Tester une application Symfony</a></li>
                        </ul>
                        <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                        <ul>
                            <li><a href="https://openclassrooms.com/courses/les-espaces-de-noms-en-php" target="_blank">Namespaces</a></li>
                            <li><a href="https://openclassrooms.com/courses/php-utiliser-un-debogueur-pour-php-xdebug" target="_blank">Xdebug</a></li>
                            <li><a href="https://openclassrooms.com/courses/realiser-un-moteur-de-recherche-pour-son-site" target="_blank">Moteur de recherche</a></li>
                            <li><a href="https://openclassrooms.com/courses/creer-son-forum-de-toutes-pieces/avant-tout-2" target="_blank">MCréer son forum</a></li>
                            <li><a href="https://openclassrooms.com/courses/pdo-comprendre-et-corriger-les-erreurs-les-plus-frequentes" target="_blank">PDO</a></li>
                            <li><a href="https://openclassrooms.com/courses/register-globals-et-ecrasement-de-donnees" target="_blank">Register globals</a></li>
                            <li><a href="https://openclassrooms.com/courses/le-htaccess-et-ses-fonctionnalites" target="_blank">htaccess</a></li>
                            <li><a href="https://openclassrooms.com/courses/la-tamporisation-de-sortie-en-php" target="_blank">tamporisation de sortie</a></li>
                            <li><a href="https://openclassrooms.com/courses/upload-de-fichiers-par-formulaire" target="_blank">Upload de fichiers</a></li>
                            <li><a href="https://openclassrooms.com/courses/gerer-les-dates-en-php" target="_blank">gérer les dates</a></li>
                            <li><a href="https://openclassrooms.com/courses/e-mail-envoyer-un-e-mail-en-php" target="_blank">Envoyer un e-mail en PHP</a></li>
                            <li><a href="https://openclassrooms.com/courses/les-filtres-en-php-pour-valider-les-donnees-utilisateur" target="_blank">Les filtres en PHP</a></li>
                            <li><a href="https://openclassrooms.com/courses/protegez-vous-efficacement-contre-les-failles-web/la-csrf" target="_blank">Failles de sécurité</a></li>
                            <li><a href="https://openclassrooms.com/courses/adopter-un-style-de-programmation-clair-avec-le-modele-mvc" target="_blank">Modèle MVC</a></li>
                            <li><a href="https://openclassrooms.com/courses/votre-site-php-presque-complet-architecture-mvc-et-bonnes-pratiques/avant-propos-comment-fonctionne-ce-tutoriel" target="_blank">Architecture MVC</a></li>
                        </ul>
                        <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                        <ul>
                            <li><a href="https://openclassrooms.com/courses/premiers-pas-avec-le-framework-php-silex" target="_blank">Silex: premiers pas</a></li>
                            <li><a href="https://openclassrooms.com/courses/evoluez-vers-une-architecture-php-professionnelle" target="_blank">Architecture pro avec Silex</a></li>
                            <li><a href="https://openclassrooms.com/courses/atomik-framework-un-framework-php-simple-et-leger" target="_blank">Atomik framework</a></li>
                        </ul>
                        <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                        <ul>
                            <li><a href="https://openclassrooms.com/courses/decouvrez-le-framework-php-laravel-1/presentation-generale-14" target="_blank">Laravel</a></li>
                            <li><a href="https://openclassrooms.com/courses/upload-de-fichiers-par-formulaire" target="_blank">PHP : Upload de fichiers</a></li>
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
                            <li><a href="http://fr2.php.net/ini.core" target="_blank">PHP.ini</a></li>
                            <li><a href="http://fr2.php.net/ini.core" target="_blank">https://phpunit.de</a></li>
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
                            <li><a href="https://openclassrooms.com/courses/mysql-et-les-donnees-temporelles" target="_blank">Les dates</a></li>
                            <li><a href="https://openclassrooms.com/courses/les-moteurs-de-stockage-de-mysql-2" target="_blank">Les moteurs de stockage de MySQL</a></li>
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
                            </ul>
                            <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                            <ul>
                                <li><a href="http://brackets.io" target="_blank">Brackets</a></li>
                                <li><a href="https://www.sublimetext.com" target="_blank">Sublime Text</a></li>
                                <li><a href="https://www.jetbrains.com/phpstorm/" target="_blank">PhpStorm</a></li>
                            </ul>
                            <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                            <ul>
                                <li><a href="http://www.wampserver.com" target="_blank">WAMP</a></li>
                                <li><a href="https://www.mamp.info/en/" target="_blank">MAMP</a></li>
                                <li><a href="https://doc.ubuntu-fr.org/lamp" target="_blank">LAMP</a></li>
                                <li><a href="https://www.apachefriends.org/fr/index.html" target="_blank">XAMPP</a></li>
                            </ul>
                            <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                            <ul>
                                <li><a href="https://fr.wordpress.org" target="_blank">Wordpress.org</a></li>
                                <li><a href="https://codex.wordpress.org" target="_blank">Codex Wordpress</a></li>
                            </ul>
                            <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                            <ul>
                                <li><a href="https://www.draw.io" target="_blank">Draw.io</a></li>
                                <li><a href="https://eclipse.org/papyrus/" target="_blank">Papyrus</a></li>
                                <li><a href="http://software.sqlpower.ca/page/architect" target="_blank">SQL POWER ARCHITECT</a></li>
                                <li><a href="https://www.postgresql.org" target="_blank">PostgreSQL</a></li>
                                <li><a href="https://eggerapps.at/postico/" target="_blank">Postico</a></li>
                            </ul>
                            <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                            <ul>
                                <li><a href="https://getcomposer.org" target="_blank">Composer</a></li>
                                <li><a href="https://twig.symfony.com" target="_blank">Twig</a></li>
                            </ul>
                            <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                            <ul>
                                <li><a href="https://silex.symfony.com/" target="_blank">Silex</a></li>
                                <li><a href="https://silex.symfony.com/doc/2.0/" target="_blank">Silex Documentation</a></li>
                            </ul>
                            <hr style="padding-bottom: 0px; margin-bottom: 20px;">
                            <ul>
                                <li><a href="https://cakephp.org/" target="_blank">CakePHP</a></li>
                                <li><a href="https://framework.zend.com/" target="_blank">Zend</a></li>
                                <li><a href="https://symfony.com/legacy" target="_blank">Symfony</a></li>
                                <li><a href="https://codeigniter.com/" target="_blank">CodeIgniter</a></li>
                            </ul>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</aside>