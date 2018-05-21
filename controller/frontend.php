<?php

/* ********************* RESUME *****************************

1 . PAGE D'ACCUEIL.
2 . PAGE DE CONNEXION.
3 . PAGE D'INSCRIPTION.
4 . INSCRIPTION.
5 . CONNEXION.
6 . DECONNEXION.
7 . DOUBLON PSEUDO.
8 . DOUBLON EMAIL.
9 . CONFIRMATION INSCRIPTION.
10. PASSER USER EN ACTIF.
11. AFFICHER TOUS LES BLOG POSTS.
12. AFFICHER UN SEUL BLOG POST.
13. AJOUTER UN COMMENTAIRE.
14. AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE.
15. SUPPRIMER UN COMMENTAIRE.
16. MODIFIER UN COMMENTAIRE.
17. ERRORS.
18. CONTACT

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
    if (empty($post)) {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
        errors();
        exit();
    }
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
    $posts1 = $postManager->getPosts(0, 5);

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

/* **************** 17. ERRORS ******************************/

function errors(){

    require('view/frontend/errors.php');
}

/* **************** 18 . CONTACT ******************************/

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