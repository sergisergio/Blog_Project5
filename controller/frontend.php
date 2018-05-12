<?php

/* ********************* RESUME *****************************

1 . PAGE D'ACCUEIL.
2 . PAGE DE CONNEXION.
3 . PAGE D'INSCRIPTION.
4 . PAGE DE PROFIL.
5 . INSCRIPTION.
6 . CONNEXION.
7 . SE SOUVENIR DE MOI.
8 . DECONNEXION.
9 . DOUBLON PSEUDO.
10. DOUBLON EMAIL.
11. CONFIRMATION INSCRIPTION.
12. PASSER USER EN ACTIF.
13. AFFICHER TOUS LES BLOG POSTS.
14. AFFICHER UN SEUL BLOG POST.
15. AJOUTER UN COMMENTAIRE.
16. AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE.
17. SUPPRIMER UN COMMENTAIRE.
18. MODIFIER UN COMMENTAIRE.
19. AFFICHER LA PAGE MOT DE PASSE OUBLIE.
20. AFFICHER LA PAGE DE MODIFICATION DU MOT DE PASSE 1.
21. AFFICHER LA PAGE DE MODIFICATION DU MOT DE PASSE 2.
22. MODIFIER LE MOT DE PASSE.
23. SUPPRIMER MON COMPTE.
24. ERRORS.

******************** FIN RESUME ****************************/

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

/* ***************** 1 . PAGE D'ACCUEIL **********************/

function home(){

    require('view/frontend/home.php');
}

/* ***************** 2 . PAGE CONNEXION **********************/

function loginPage(){

	require('view/frontend/login.php');
}

/* ***************** 3 . PAGE INSCRIPTION ********************/

function signupPage(){
    
	require('view/frontend/signup.php');
}

/* ***************** 4 . PAGE PROFIL *************************/

function profilePage(){
    
    require('view/frontend/profile.php');
}

/* ****************  5 . INSCRIPTION *************************/

function addUser($pseudo, $email, $passe){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $users = $userManager->addUserRequest($pseudo, $email, $passe);
     if ($users === false) {
        $_SESSION['flash']['danger'] = 'Inscription impossible !';
        signupPage();
        exit();
    } 
    else {
        $_SESSION['flash']['success'] = 'Un mail de confirmation vous a été envoyé pour valider votre compte';
        loginPage();
        exit();
    } 
}

/* ***************** 6 . CONNEXION ***************************/

function login($pseudo,$passe){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->loginRequest($pseudo,$passe);
    
    if(password_verify($_POST['passe'], $user['password'])) {
        if ($user['is_active'] == 1) {
            
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['prenom'] = $user['first_name'];
        $_SESSION['nom'] = $user['last_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['autorisation'] = $user['authorization'];
        $_SESSION['avatar'] = $user['avatar'];
        $_SESSION['registration_date'] = $user['registration_date'];
        echo '<div class="alert alert-success">' . 'Bienvenue ' . $_SESSION['pseudo'] . ' : Vous êtes à présent connecté' . '</div>' . '<br />';
        header('Location: index.php?action=blog');
        exit();
        }
        else {
            $_SESSION['flash']['danger'] = 'Vous devez activer votre compte via le lien de confirmation dans le mail envoyé !';
            loginPage();
            exit();
        }
    }
    else {
        $_SESSION['flash']['danger'] = 'Mauvais identifiant ou mot de passe !';
        loginPage();
        exit();
    }
}

/* ***************** 7 . SE SOUVENIR DE MOI ******************/

function remember($rememberToken){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $userId = $_SESSION['id'];
    $req = $userManager->rememberRequest($userId, $rememberToken);
}

/* ***************** 8 . DECONNEXION *************************/

function logout(){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $users = $userManager->logoutRequest();
    echo '<div class="alert alert-success">' . ' A bientôt !' . '</div>' . '<br />';
}

/* ***************** 9 . DOUBLON PSEUDO **********************/

function checkExistPseudo($pseudo){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->existPseudo($pseudo);

     if ($user) {
        $_SESSION['flash']['danger'] = 'Ce pseudo est déjà pris !';
        signupPage();
        exit();
    }
}

/* **************** 10 . DOUBLON MAIL ************************/

function checkExistMail($email){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $usermail = $userManager->existMail($email);

     if ($usermail) {
        $_SESSION['flash']['danger'] = 'Cet email est déjà utilisé !';
        signupPage();
        exit();
    }
}

/* **************** 11 . CONFIRMATION INSCRIPTION ************/

function confirmRegistration($userId, $userToken){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->getUser($userId);
     
    if ($user &&  $user['confirmation_token'] == $userToken) {
        
        $userManager->setActiveRequest($userId);
        $_SESSION['flash']['success'] = 'Votre inscription a bien été prise en compte ! Vous pouvez vous connecter !';
        loginPage();
        exit();
    }
    else {
        $_SESSION['flash']['success'] = 'Ce token n est plus valide ! Veuillez réessayer ! !';
        signupPage();
        exit();
    }   
}

/* **************** 12 . PASSER USER EN ACTIF. ***************/

function setActiveUser($userId){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $activeUser = $userManager->setActiveRequest($userId);
}

/* **************** 13 . TOUS LES BLOG POSTS *****************/

function listPosts(){
	$postManager = new \Philippe\Blog\Model\PostManager();
    $postsTotal = $postManager->countPosts();
    $postsPerPage = 5;
    $totalPages = ceil($postsTotal / $postsPerPage);

    if(isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page'] > 0 ) AND ($_GET['page'] <= $totalPages)){
        $_GET['page'] = intval($_GET['page']);
        $currentPage = $_GET['page'];
    }
    else {
        $currentPage = 1;
    }
    $start = ($currentPage-1)*$postsPerPage;
    $posts = $postManager->getPosts($start, $postsPerPage);
    $posts1 = $postManager->getPosts(0, 5);

    require('view/frontend/blog.php');
}

/* **************** 14 . AFFICHER UN SEUL BLOG POST **********/

function listPost(){
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();
    $userManager = new \Philippe\Blog\Model\UserManager();

    $posts1 = $postManager->getPosts(0, 5);
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    $user = $userManager->getUser($_GET['id']);
    $count = $commentManager->countCommentRequest($_GET['id']);
    
    require('view/frontend/blog_post.php');
}

/* **************** 15 . AJOUTER UN COMMENTAIRE **************/

function addComment($postId, $author, $content){
	$commentManager = new \Philippe\Blog\Model\CommentManager();
	$affectedLines = $commentManager->postComment($postId, $author, $content);

	if ($affectedLines === false) {
        echo '<div class="alert alert-danger">' . 'Vous devez être inscrit pour ajouter un commentaires' . '</div>';
    }
    else {
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
    }
}

/* **************** 16 . PAGE POUR MODIFIER UN COMMENTAIRE ***/

function modifyCommentPage($commentId){
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();

	$comment = $commentManager->getComment($commentId);
	$post = $postManager->getPost($comment['post_id']);

	require('view/frontend/modifyView.php');
}

/* **************** 17 . SUPPRIMER UN COMMENTAIRE ************/
function deleteComment($commentId){
    $commentManager = new \Philippe\Blog\Model\CommentManager();
    $comment = $commentManager->getComment($commentId);
    $success = $commentManager->deleteCommentRequest($commentId);
    
    if ($success === false) {
        throw new Exception('Impossible de supprimer le commentaire');
    }
    else {
        header('Location: index.php?action=blogpost&id=' . $comment['post_id'] . '#comments');
    }
}

/* **************** 18 . MODIFIER UN COMMENTAIRE *************/

function modifyComment($commentId, $author, $content){
    $commentManager = new \Philippe\Blog\Model\CommentManager();
    $success = $commentManager->modifyCommentRequest($commentId, $author, $content);
    $comment = $commentManager->getComment($commentId);

    if ($success === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=blogpost&id=' . $comment['post_id'] . '#comments');
    }
}

/* **************** 19 . PAGE MOT DE PASSE OUBLIE ************/

function forgetPasswordPage(){

    require('view/frontend/forget.php');
}

/* **************** 20 . PAGE MODIFICATION MOT DE PASSE 1 ****/

function forgetPassword($email){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->forgetPasswordRequest($email);

    if ($user === false) {
        echo '<div class="alert alert-danger">' . 'Une erreur est survenue !' . '</div>' . '<br />';
    }
    else {
        echo '<div class="alert alert-success">' . 'Un email  vous a été envoyé pour changer votre mot de passe !' . '</div>' . '<br />';
    } 
}
/* **************** 21. PAGE  DE MODIF MOT DE PASSE 2 ********/

function changePasswordPage($userId, $resetToken){

    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->checkResetTokenRequest($userId);
    if ($user &&  $user['reset_token'] == $resetToken) {
    require('view/frontend/changePassword.php');
    }
    else {
        echo 'Ce token n est plus valide ! Veuillez réessayer !';
    }
}

/* **************** 22. MODIFIER MOT DE PASSE ****************/

function changePassword($userId, $passe){

    $userManager = new \Philippe\Blog\Model\UserManager();

    if(!empty($_POST['passe']) && $_POST['passe'] == $_POST['passe2']){
        $userManager->changePasswordRequest($userId, $passe);
            echo '<div class="alert alert-success">' . 'Le mot de passe a bien été réinitialisé !' . '</div>' . '<br />';
    }
    else {
        echo 'Veuillez entrer un mot de passe';
    }
}

/* **************** 23. SUPPRIMER MON COMPTE *****************/

function deleteAccount($userId){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $deleteAccount = $userManager->deleteAccountRequest($userId);
}

/* **************** 24. ERRORS ******************************/

function errors(){

    require('view/frontend/errors.php');
}