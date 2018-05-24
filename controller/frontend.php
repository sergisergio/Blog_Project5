<?php
/* ********************* RESUME *****************************
1 . PAGE D'ACCUEIL.
2 . PAGE DE CONNEXION.
3 . PAGE D'INSCRIPTION.
4 . INSCRIPTION.
5 . CONNEXION.
6 . DECONNEXION.
7 . CONFIRMATION INSCRIPTION.
8. PASSER USER EN ACTIF.
9. AFFICHER TOUS LES BLOG POSTS.
10. AFFICHER UN SEUL BLOG POST.
11. AJOUTER UN COMMENTAIRE.
12. AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE.
13. SUPPRIMER UN COMMENTAIRE.
14. MODIFIER UN COMMENTAIRE.
15. ERRORS.
16. PAGE NO ADMIN
17. CONTACT
******************** FIN RESUME ****************************/
//require_once('model/PostManager.php');
//require_once('model/CommentManager.php');
//require_once('model/UserManager.php');
require "vendor/autoload.php";
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CommentManager;

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
function addUser($pseudo, $email, $passe, $passe2){
    $userManager = new UserManager();
    if (!empty($pseudo) && !empty($email) && !empty($passe) && !empty($passe2)) {
        $user = $userManager->existPseudo($pseudo);
        $usermail = $userManager->existMail($email);
        if ($user) {
            $_SESSION['flash']['danger'] = 'Ce pseudo est déjà pris !';
            signupPage();
            exit();
        }
        elseif ($usermail) {
            $_SESSION['flash']['danger'] = 'Cet email est déjà utilisé !';
            signupPage();
            exit();
        }
        elseif(empty($pseudo) || !preg_match('/^[a-zA-Z0-9_]+$/', $pseudo)) {
            $_SESSION['flash']['danger'] = 'Votre pseudo n\'est pas valide (caractères alphanumériques et underscore permis... !';
            signupPage();
            exit();
        }
        elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash']['danger'] = 'Votre email n\'est pas valide !';
            signupPage();
            exit();
        }
        elseif (empty($passe) || $passe != $_POST['passe2']) {
            $_SESSION['flash']['danger'] = 'Vous devez entrer un mot de passe valide !';
            signupPage();
            exit();
        }
        else {
            $users = $userManager->addUserRequest($pseudo, $email, $passe);
                $_SESSION['flash']['success'] = 'Un mail de confirmation vous a été envoyé pour valider votre compte';
                loginPage();
                exit();
            if ($users === false) {
                $_SESSION['flash']['danger'] = 'Inscription impossible !';
                signupPage();
                exit();
            }
        } 
    }
    else {
        $_SESSION['flash']['danger'] = 'Vous devez remplir tous les champs !';
        signupPage();
        exit();
    }
}
/* ***************** 5 . CONNEXION ***************************/
function login($pseudo,$passe){
    $userManager = new UserManager();
    if(!empty($pseudo) && !empty($passe)) {
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
    else {
        $_SESSION['flash']['danger'] = 'Veuillez remplir tous les champs !';
        loginPage();
        exit();
    }
}
/* ***************** 6 . DECONNEXION *************************/
function logout(){
    unset($_SESSION);
    session_destroy();
    header('Location: index.php?action=blog');
}
/* ***************** 7 . CONFIRMATION INSCRIPTION ************/
function confirmRegistration($userId, $userToken){

    $userManager = new UserManager();
    $user = $userManager->getUser($userId);
    if (isset($_GET['id']) && isset($_GET['token'])) {
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
    else {
        $_SESSION['flash']['danger'] = 'Echec de l\'inscription ! Veuillez réessayer sinon contactez l\'administrateur';
        signupPage();
        exit();
    }  
}
/* ***************** 8 . PASSER USER EN ACTIF. ***************/
function setActiveUser($userId){

    $userManager = new UserManager();
    $activeUser = $userManager->setActiveRequest($userId);
}
/* ***************** 9 . TOUS LES BLOG POSTS *****************/
function listPosts(){
	$postManager = new PostManager();
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
/* **************** 10 . AFFICHER UN SEUL BLOG POST **********/
function listPost($postId){

	$postManager = new PostManager();
	$commentManager = new CommentManager();
    $userManager = new UserManager();
    $posts1 = $postManager->getPosts(0, 5);
    $post = $postManager->getPost($postId);
    if (isset($postId) && $postId > 0 && (!empty($post))) {
        
        $comments = $commentManager->getComments($postId);
        $user = $userManager->getUser($postId);
        $nbCount = $commentManager->countCommentRequest($postId);
        require('view/frontend/blog_post.php');
    }   
    else {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
        errors();
        exit();
    }
}
/* **************** 11 . AJOUTER UN COMMENTAIRE **************/
function addComment($postId, $author, $content){
	$commentManager = new CommentManager();

	if (isset($postId) && $postId > 0) {
        if (!empty($content)) {
            $affectedLines = $commentManager->postComment($postId, $author, $content);
            $_SESSION['flash']['success'] = 'Votre commentaire sera validé dans les plus brefs délais !';
            header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
            exit();
            if ($affectedLines === false) {
                echo '<div class="alert alert-danger">' . 'Vous devez être inscrit pour ajouter un commentaires' . '</div>';
            }
        }
        else {
            $_SESSION['flash']['danger'] = 'Le champ est vide !';
            header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
            exit();
        }
    }
    else {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
        errors();
        exit();
    }
}
/* **************** 12 . PAGE POUR MODIFIER UN COMMENTAIRE ***/
function modifyCommentPage($commentId){
    $postManager = new PostManager();
	$commentManager = new CommentManager();
    $userManager = new UserManager();
    $comment = $commentManager->getComment($commentId);
	$post = $postManager->getPost($comment['post_id']);
    $posts1 = $postManager->getPosts(0, 5);
    if (empty($comment) || $commentId <= 0 ){
        $_SESSION['flash']['danger'] = 'Cet identifiant ne correspond à aucun commentaire !';
        errors();
        exit();
    }
    elseif (isset($commentId) && $commentId > 0) {
       if (($_SESSION['pseudo'] != $comment['author']) && ($_SESSION['autorisation'] == 0)) {
            $_SESSION['flash']['danger'] = 'Vous pouvez seulement modifier vos propres commentaires !';
            errors();
            exit();
        }
        else {
            require('view/frontend/modifyView.php');
        }
    }
}
/* **************** 13 . SUPPRIMER UN COMMENTAIRE ************/
function deleteComment($commentId){

    $commentManager = new CommentManager();
    if ($success === false) {
        throw new Exception('Impossible de supprimer le commentaire');
    }
    elseif (isset($commentId) && $commentId > 0) {
        $comment = $commentManager->getComment($commentId);
        $success = $commentManager->deleteCommentRequest($commentId);
        header('Location: index.php?action=blogpost&id=' . $comment['post_id'] . '#comments');
    }
    elseif (empty($comment) || $commentId <= 0 ) {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce commentaire !';
        errors();
        exit();
    }
}
/* **************** 14 . MODIFIER UN COMMENTAIRE *************/
function modifyComment($commentId, $author, $content){
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($commentId);
    if (isset($commentId) && $commentId > 0) {
        if (!empty($content)) {
            $success = $commentManager->modifyCommentRequest($commentId, $author, $content);
            $_SESSION['flash']['success'] = 'Votre commentaire sera validé dans les plus brefs délais !';
            header('Location: index.php?action=blog');
            if ($success === false) {
                throw new Exception('Impossible de modifier le commentaire !');
            }
        }
        else {
            $_SESSION['flash']['danger'] = 'Le champ est vide !';
            header('Location: index.php?action=modifyCommentPage&id=' . $_GET['id']);
            exit();
        }
    }
    elseif (empty($comment) || $commentId <= 0 ) {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce commentaire !';
        errors();
        exit();
    }
}
/* **************** 15. ERRORS *******************************/
function errors(){
    require('view/frontend/errors.php');
}
/* *********** 16 . PAGE NO ADMIN ****************************/
function noAdmin(){
    require('view/backend/noadmin.php');
}
/* **************** 17 . CONTACT *****************************/
function contact(){

    include('model/SMTPClass.php');

    // Remove any un-safe values to prevent email injection
    function filter($value) {
        $pattern = array("/\n/", "/\r/", "/content-type:/i", "/to:/i", "/from:/i", "/cc:/i");
        $value = preg_replace($pattern, "", $value);
        return $value;
    }

    // Run server-side validation
    function sendEmail($subject, $content, $emailto, $emailfrom) {
        
        $from = $emailfrom;
        $response_sent = 'Merci. Votre message a bien été envoyé';
        $response_error = 'Erreur. Veuillez réessayer';
        $subject =  filter($subject);
        $url = "Origin Page: ".$_SERVER['HTTP_REFERER'];
        $ip = "IP Address: ".$_SERVER["REMOTE_ADDR"];
        $message = $content."\n$ip\r\n$url";
        
        // Validate return email & inform admin
        $emailto = filter($emailto);

        // Setup final message
        $body = wordwrap($message);
        
        if($use_smtp == '1'){
        
            $SmtpServer = 'SMTP SERVER';
            $SmtpPort = 'SMTP PORT';
            $SmtpUser = 'SMTP USER';
            $SmtpPass = 'SMTP PASSWORD';
            
            $to = $emailto;
            $SMTPMail = new SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body);
            $SMTPChat = $SMTPMail->SendMail();
            $response = $SMTPChat ? $response_sent : $response_error;
            
        } else {
            
            // Create header
            $headers = "From: $from\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=utf-8\r\n";
            $headers .= "Content-Transfer-Encoding: quoted-printable\r\n";
            
            // Send email
            $mail_sent = @mail($emailto, $subject, $body, $headers);
            $response = $mail_sent ? $response_sent : $response_error;
            
        }
        return $response;
    }

    $use_smtp = '0';
    $emailto = 'contact@philippetraon.com';

    // retrieve from parameters
    $emailfrom = isset($_POST["email"]) ? $_POST["email"] : "";
    $nocomment = isset($_POST["nocomment"]) ? $_POST["nocomment"] : "";
    $subject = 'Email from Philippe';
    $message = '';
    $response = '';
    $response_fail = 'Un problème est survenu.';
    
        // Honeypot captcha
        if($nocomment == '') {
        
            $params = $_POST;
            foreach ( $params as $key=>$value ){
            
                if(!($key == 'ip' || $key == 'emailsubject' || $key == 'url' || $key == 'emailto' || $key == 'nocomment' || $key == 'v_error' || $key == 'v_email')){
                
                    $key = ucwords(str_replace("-", " ", $key));
                    
                    if ( gettype( $value ) == "array" ){
                        $message .= "$key: \n";
                        foreach ( $value as $two_dim_value )
                        $message .= "...$two_dim_value<br>";
                    }else {
                        $message .= $value != '' ? "$key: $value\n" : '';
                    }
                }
            }
            
        $response = sendEmail($subject, $message, $emailto, $emailfrom);
            
        } else {
        
            $response = $response_fail;
        
        }

    echo $response;
    exit;
}