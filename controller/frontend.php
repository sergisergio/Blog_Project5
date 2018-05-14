<?php

/* ********************* RESUME *****************************

1 . PAGE D'ACCUEIL.
2 . PAGE DE CONNEXION.
3 . PAGE D'INSCRIPTION.
4 . INSCRIPTION.
5 . CONNEXION.
6 . DECONNEXION.
7 . DOUBLON PSEUDO.
8. DOUBLON EMAIL.
9. CONFIRMATION INSCRIPTION.
10. PASSER USER EN ACTIF.
11. AFFICHER TOUS LES BLOG POSTS.
12. AFFICHER UN SEUL BLOG POST.
13. AJOUTER UN COMMENTAIRE.
14. AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE.
15. SUPPRIMER UN COMMENTAIRE.
16. MODIFIER UN COMMENTAIRE.
17. AFFICHER LA PAGE MOT DE PASSE OUBLIE.
18. AFFICHER LA PAGE DE MODIFICATION DU MOT DE PASSE 1.
19. AFFICHER LA PAGE DE MODIFICATION DU MOT DE PASSE 2.
20. MODIFIER LE MOT DE PASSE.
21. ERRORS.

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

/* ****************  4 . INSCRIPTION *************************/

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

/* ***************** 5 . CONNEXION ***************************/

function login($pseudo,$passe){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->loginRequest($pseudo,$passe);
    
    if(password_verify($passe, $user['password'])) {
        if ($user['is_active'] == 1) {
            
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['prenom'] = $user['first_name'];
        $_SESSION['nom'] = $user['last_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['autorisation'] = $user['authorization'];
        $_SESSION['avatar'] = $user['avatar'];
        $_SESSION['registration'] = $user['registration_date_fr'];
        $_SESSION['description'] = $user['description'];
        $_SESSION['color'] = $user['color'];
        // echo '<div class="alert alert-success">' . 'Bienvenue ' . $_SESSION['pseudo'] . ' : Vous êtes à présent connecté' . '</div>' . '<br />';
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

/* ***************** 6 . DECONNEXION *************************/

function logout(){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $users = $userManager->logoutRequest();
    echo '<div class="alert alert-success">' . ' A bientôt !' . '</div>' . '<br />';
}

/* ***************** 7 . DOUBLON PSEUDO **********************/

function checkExistPseudo($pseudo){

    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->existPseudo($pseudo);
    if ($user) {
        $_SESSION['flash']['danger'] = 'Ce pseudo est déjà pris !';
        signupPage();
        exit();
    }
}

/* **************** 8 . DOUBLON MAIL ************************/

function checkExistMail($email){

    $userManager = new \Philippe\Blog\Model\UserManager();
    $usermail = $userManager->existMail($email);
    if ($usermail) {
        $_SESSION['flash']['danger'] = 'Cet email est déjà utilisé !';
        signupPage();
        exit();
    }
}

/* **************** 9 . CONFIRMATION INSCRIPTION ************/

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

/* **************** 10 . PASSER USER EN ACTIF. ***************/

function setActiveUser($userId){

    $userManager = new \Philippe\Blog\Model\UserManager();
    $activeUser = $userManager->setActiveRequest($userId);
}

/* **************** 11 . TOUS LES BLOG POSTS *****************/

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

/* **************** 12 . AFFICHER UN SEUL BLOG POST **********/

function listPost(){

	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();
    $userManager = new \Philippe\Blog\Model\UserManager();

    $posts1 = $postManager->getPosts(0, 5);
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    $user = $userManager->getUser($_GET['id']);
    $nbCount = $commentManager->countCommentRequest($_GET['id']);
    
    require('view/frontend/blog_post.php');
}

/* **************** 13 . AJOUTER UN COMMENTAIRE **************/

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

/* **************** 14 . PAGE POUR MODIFIER UN COMMENTAIRE ***/

function modifyCommentPage($commentId){

	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();

	$comment = $commentManager->getComment($commentId);
	$post = $postManager->getPost($comment['post_id']);

	require('view/frontend/modifyView.php');
}

/* **************** 15 . SUPPRIMER UN COMMENTAIRE ************/

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

/* **************** 16 . MODIFIER UN COMMENTAIRE *************/

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

/* **************** 17 . PAGE MOT DE PASSE OUBLIE ************/

function forgetPasswordPage(){

    require('view/frontend/forget.php');
}

/* **************** 18 . PAGE MODIFICATION MOT DE PASSE 1 ****/

function forgetPassword($email){
    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->forgetPasswordRequest($email);

    if ($user === false) {
        $_SESSION['flash']['success'] = 'Une erreur est survenue !';
        loginPage();
        exit();
    }
    else {
        $_SESSION['flash']['success'] = 'Vous allez recevoir un email pour réinitialiser votre mot de passe !';
        loginPage();
        exit();
    } 
}
/* **************** 19. PAGE  DE MODIF MOT DE PASSE 2 ********/

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

/* **************** 20. MODIFIER MOT DE PASSE ****************/

function changePassword($userId, $passe){

    $userManager = new \Philippe\Blog\Model\UserManager();

    if(!empty($_POST['passe']) && $_POST['passe'] == $_POST['passe2']){
        $userManager->changePasswordRequest($userId, $passe);
            $_SESSION['flash']['success'] = 'Le mot de passe a bien été réinitialisé !';
            loginPage();
            exit();
    }
    else {
        echo 'Veuillez entrer un mot de passe';
    }
}

/* **************** 21. ERRORS ******************************/

function errors(){

    require('view/frontend/errors.php');
}