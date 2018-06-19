<?php
if(!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ) {
    header('Location: index.php?action=noAdmin');
    exit();
}
?>
<?php $title = 'Gestion des commentaires'; ?>
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
                        <?php if ($_SESSION['avatar'] != '') : ?> <img style="width: 10%;float: right;margin: 0 20px;" class="img-responsive img-circle" src="public/images/avatar/<?php echo $_SESSION['avatar']; ?>" />
                        <?php else: ?> <img style="width: 5%;float: right;margin: 0 20px;" class="img-responsive img-circle" style="width: 5%;" src="public/images/avatar/avatardefaut.png" />
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
            
            <div class="post box">
                    
                    <h2 class="text-center">Gestion des commentaires</h2>
                    <div class="divide20"></div>
                    <p class="text-center">(Les commentaires déjà validés peuvent être supprimés directement sur le blog.)</p>
                    <div class="divide20"></div>
                    <h5 class="text-center">
                        <?php if($nbCount > 1) : ?>
                        Il y a <?php echo $nbCount; ?> commentaires à valider.
                        <?php elseif($nbCount == 1) : ?>
                        Il y a un commentaire à valider.
                        <?php else: ?>
                        Il n'y a aucun commentaire à valider.
                        <?php endif; ?>
                    </h5>
                    <div class="divide20"></div>
                    <?php require 'App/frontend/Modules/responseAlert/responseAlert.php'; ?>
            </div>
            <?php
            
            foreach ($submittedComment as $s)
            {
            ?>
            <div class="post box">
            <div class="row">
                <h3><?php echo htmlspecialchars($s->getPost_id()); ?></h3>
                <p>Commentaire de <?php echo htmlspecialchars($s->getAuthor()); ?> publié le <?php echo htmlspecialchars($s->getCreation_date()); ?></p>
                <p><?php echo htmlspecialchars($s->getContent()); ?></p>
            </div>
            <?php      
                    $csrfValidateCommentToken = md5(time()*rand(1, 1000));
            ?>
            <btn class="btn btn-default" style="float: right;">
                <a href="index.php?action=validateComment&amp;id=<?php echo $s->getId() ?>&amp;token=<?php echo $csrfValidateCommentToken ?>"  data-toggle='confirmation' id="important_action">Valider</a>
            </btn>
            <?php      
                    $csrfAdminDeleteCommentToken = md5(time()*rand(1, 1000));
            ?>
            <btn class="btn btn-default" style="float: right;">
                <a href="index.php?action=adminDeleteComment&amp;id=<?php echo $s->getId() ?>&amp;token=<?php echo $csrfAdminDeleteCommentToken ?>"  data-toggle='confirmation' id="important_action">Supprimer</a>
            </btn>
            </div>
            <?php
            } 
            
            ?></div>
            <div class="divide100"></div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require 'App/backend/templates/template.php'; ?>