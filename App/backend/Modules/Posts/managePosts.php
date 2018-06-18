<?php
if(!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ) {
    header('Location: index.php?action=noAdmin');
    exit();
}
?>
<?php $title = 'Gestion des articles'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
            <?php require "App/frontend/Modules/Nav/nav.php"; ?>
            <div class="container">
                <section style="margin-bottom: 50px;">
                  <div class="box">
                    <div class="col-md-12">
                      <?php if (isset($_SESSION['pseudo'])) : ?>
                        <p class="pull-center"><h2>Espace administrateur</h2></p>
                        <p class="pull-right">
                        <btn class="btn btn-default logoutbtn"> <a href="index.php?action=logout">Déconnexion</a> </btn>
                        <?php if ($_SESSION['avatar'] != '') : ?> <img style="width: 10%;float: right;margin: 0 20px;" class="img-responsive img-circle" src="Web/images/avatar/<?php echo $_SESSION['avatar']; ?>" />
                        <?php else: ?> <img style="width: 5%;float: right;margin: 0 20px;" class="img-responsive img-circle" style="width: 5%;" src="Web/images/avatar/avatardefaut.png" />
                        <?php endif; ?>
                        </p>
                        <?php else: ?> 
                        <p class="pull-right"><btn class="btn btn-default"> <a href="index.php?action=loginPage">Connexion</a></btn></p>
                        <p class="pull-right"><btn class="btn btn-default"> <a href="index.php?action=signupPage">Inscription</a> </btn>&nbsp;&nbsp; </p>
                        <?php endif; ?>
                    </div>
                    <p></p>
                    <div class="divide30"></div>
                    <ul class="nav nav-tabs menuadmin">
                      <li class="nav-item">
                        <a class="nav-link active" href="index.php?action=manage_posts">Gestion articles</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?action=manage_comments">Gestion commentaires</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?action=manage_users">Gestion membres</a>
                      </li>
                    </ul>
                  </div>
                </section>
                <h2 class="text-center">Gestion des articles</h2>
                <div class="divide20"></div>
                <div class="post box">
                    <h2>Ajouter un article</h2>
                    <?php require 'App/frontend/Modules/ResponseAlert/responseAlert.php'; ?> 
                    <?php require "App/backend/Modules/Posts/form_addpost.php"; ?>
                </div>
                <div class="divide20"></div>
                <h2 class="text-center">Ajouter une catégorie</h2>
                <div class="divide20"></div>
                <div class="post box">
                <?php require "App/backend/Modules/Posts/form_addcategory.php"; ?>
                </div>
                <div class="divide20"></div>
                <h2 class="text-center">Modifier/Supprimer un article</h2>
                <div class="divide20"></div>
                <?php
                foreach ($posts as $p)
                {
                ?>
                <div class="post box" id="viewposts">
                <div class="row">
                <h2 class="post-title">
                    <a href="index.php?action=blogpost&amp;id=<?php echo $p->getId() ?>" target="_blank"><?php echo htmlspecialchars($p->getTitle()); ?></a>
                </h2>
                <?php if ($p->getFile_extension() != '') : ?>
                        <img src="Web/images/posts/<?php echo $p->getFile_extension(); ?>" class="img-responsive" style="width: 10%;" />
                        <?php else: ?>
                        <img src="Web/images/posts/default.jpg" class="img-responsive" style="width: 10%;" />
                        <?php endif; ?>
                <?php      
                    $csrfDeletePostToken = md5(time()*rand(1, 1000));
                ?>
                    <a  class="btn btn-default" style="float: right;" href="index.php?action=deletePost&amp;id=<?php echo $p->getId() ?>&amp;token=<?php echo $csrfDeletePostToken ?>" data-toggle='confirmation' id="important_action">Supprimer</a>
                    <a  class="btn btn-default" style="float: right;" href="index.php?action=modifyPostPage&amp;id=<?php echo $p->getId() ?>">Modifier</a>
                </div>
                </div>
                <?php
                } 
                    
                ?>
                <div class="pagination box">
                <ul>
                    <li><?php echo '<a class="btn" href="index.php?action=manage_posts&page='. ($currentPage - 1) . '#viewposts' . '">'.'Précédent'.'</a> '; ?></li>
                        <?php
                        for($i=1;$i<=$totalPages;$i++){
                            if($i == $currentPage) {
                                echo '<li><a class="btn active" href="index.php?action=manage_posts&page='.$i. '#viewposts' . '">'.$i.'</a></li> ';
                            }
                            else {
                                echo '<li><a class="btn" href="index.php?action=manage_posts&page='.$i. '#viewposts' . '">'.$i.'</a></li> ';
                            }
                        }
                        ?>
                    <li><?php echo '<a class="btn" href="index.php?action=manage_posts&page='. ($currentPage + 1) . '#viewposts' . '">'.'Suivant'.'</a> '; ?></li>
                </ul>
            </div>
            </div>
                <div class="divide100"></div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php require 'App/backend/templates/template.php'; ?>