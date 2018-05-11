<section style="margin-bottom: 50px;">
  <div class="box">
    <div class="col-md-12">
      <?php if (isset($_SESSION['pseudo'])): ?>
        <p class="pull-center"><h2>Espace administrateur</h2></p>
        <p class="pull-right">
        <btn class="btn btn-default logoutbtn"> <a href="index.php?action=logout">Déconnexion</a> </btn>
        <?php if ($_SESSION['avatar'] != ''): ?> <img style="width: 10%;float: right;margin: 0 20px;" class="img-responsive img-circle" src="public/images/avatar/<?= $_SESSION['avatar']; ?>" />
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