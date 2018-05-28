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
use \Philippe\Blog\Model\SessionManager;
use \Philippe\Blog\Model\SecurityManager;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* ***************** 1 . PAGE D'ACCUEIL **********************/
function home()
{
    include 'view/frontend/index.php';
}
/* ***************** 2 . PAGE CONNEXION **********************/
function loginPage()
{
    include 'view/frontend/pages/login.php';
}
/* ***************** 3 . PAGE INSCRIPTION ********************/
function signupPage()
{
    include 'view/frontend/pages/signup.php';
}
/* ****************  4 . INSCRIPTION *************************/
function addUser($pseudo, $email, $passe, $passe2)
{
    $userManager = new UserManager();
    $sessionManager = new SessionManager();
    if (!empty($pseudo) && !empty($email) && !empty($passe) && !empty($passe2)) {
        $user = $userManager->existPseudo($pseudo);
        $usermail = $userManager->existMail($email);
        if ($user) {
            $sessionManager->errorPseudo1();
        }
        elseif ($usermail) {
            $sessionManager->errorEmail1();
        }
        elseif(empty($pseudo) || !preg_match('/^[a-zA-Z0-9_]+$/', $pseudo)) {
            $sessionManager->errorPseudo2();
        }
        elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sessionManager->errorEmail2();
        }
        elseif (empty($passe) || $passe != $_POST['passe2']) {
            $sessionManager->errorPassword();
        }
        else {
            $users = $userManager->addUserRequest($pseudo, $email, $passe);
            /* test mail local */
            //mail($email, 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://localhost:8888/Blog_Project5/index.php?action=confirmRegistration&id=$user_id&token=$token");
            /* test mail online */
            

                /*$mail = new PHPMailer(true);                             
                try {
                    $mail->setFrom('contact@philippetraon.com', 'Philippe Traon');
                    $mail->addAddress($email, $pseudo);
                    $mail->addReplyTo('contact@philippetraon.com', 'Information');
                    $mail->isHTML(true);                                  
                    $mail->Subject = 'Message';
                    $mail->Body = '<b>Blog de Philippe Traon : </b>' . '<br />' . 'Afin de valider votre compte, merci de cliquer sur ce lien : ' . '<br />' . 
                    //'<a href="http://www.projet5.philippetraon.com/index.php?action=confirmRegistration&id='.$user_id.'&token='.$token.'>'.'Lien de confirmation</a>';
                    '<a href="http://www.projet5.philippetraon.com/index.php?action=confirmRegistration&id='.$user_id.'&token='.$token.'">'.'Lien de confirmation</a>';
                    //$mail->AltBody = 'Message non-HTML : '.$message;
                    $mail->send();
                    // echo 'Le message a bien été envoyé';
                } 
                catch (Exception $e) {
                echo 'Un problème est survenu ! Le message n\'a pas pu être envoyé : ', $mail->ErrorInfo;
                }*/
            

            $sessionManager->registerSuccess();
            if ($users === false) {
                $sessionManager->badRequest();
            }
        } 
    }
    else {
        $sessionManager->emptyContents();
    }
}
/* ***************** 5 . CONNEXION ***************************/
function login($pseudo,$passe, $ip)
{
    $userManager = new UserManager();
    $sessionManager = new SessionManager();
    $securityManager = new SecurityManager();
    if(!empty($pseudo) && !empty($passe)) {
        $user = $userManager->loginRequest($pseudo, $passe);
        $count = $securityManager->checkBruteForce($ip);

        if ($count < 3) {
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
                    $sessionManager->activateAccount();
                }
            }
            else {
                sleep(1);
                $securityManager->registerAttempt($ip);
                $sessionManager->errorPassword2();
            }
        }
        else {
            $_SESSION['flash']['danger'] = '4 tentatives ont été effectuées : veuillez contacter l\'administrateur pour vous reconnecter !';
            errors();
            exit();
        }
    }
    else {
        $sessionManager->emptyContents2();
    }
}
/* ***************** 6 . DECONNEXION *************************/
function logout()
{
    $sessionManager = new SessionManager();
    $sessionManager->stopSession();
}
/* ***************** 7 . CONFIRMATION INSCRIPTION ************/
function confirmRegistration($userId, $userToken)
{

    $userManager = new UserManager();
    $user = $userManager->getUser($userId);
    if (isset($_GET['id']) && isset($_GET['token'])) {
        if ($user &&  $user['confirmation_token'] == $userToken) {
            $userManager->setActiveRequest($userId);
            $_SESSION['flash']['success'] = 'Votre inscription a bien été prise en compte ! Vous pouvez vous connecter !';
            loginPage();
            exit();
            /*$mail = new PHPMailer(true);                             
                try {
                    $mail->setFrom('contact@philippetraon.com', 'Philippe Traon');
                    $mail->addAddress($user['email'], $user['pseudo']);
                    $mail->addReplyTo('contact@philippetraon.com', 'Information');
                    $mail->isHTML(true);                                  
                    $mail->Subject = 'Bienvenue !';
                    $mail->Body = '<b>Votre inscription a bien été prise en compte ! Bienvenue sur le blog !  </b>' . '<a href="http://projet5.philippetraon.com">http://projet5.philippetraon.com</a>';
                    //$mail->AltBody = 'Message non-HTML : '.$message;
                    $mail->send();
                    // echo 'Le message a bien été envoyé';
                } 
                catch (Exception $e) {
                echo 'Un problème est survenu ! Le message n\'a pas pu être envoyé : ', $mail->ErrorInfo;
                }*/
        }
        else {
            $sessionManager->errorToken();
        } 
    }
    else {
        $sessionManager->registerFailure();
    }  
}
/* ***************** 8 . PASSER USER EN ACTIF. ***************/
function setActiveUser($userId)
{

    $userManager = new UserManager();
    $activeUser = $userManager->setActiveRequest($userId);
}
/* ***************** 9 . TOUS LES BLOG POSTS *****************/
function listPosts()
{
    
    $postManager = new PostManager();
    $postsTotal = $postManager->countPosts();
    $postsPerPage = 5;
    $totalPages = ceil($postsTotal / $postsPerPage);

    if(isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page'] > 0 ) AND ($_GET['page'] <= $totalPages)) {
        $_GET['page'] = intval($_GET['page']);
        $currentPage = $_GET['page'];
    }
    else {
        $currentPage = 1;
    }
    $start = ($currentPage-1)*$postsPerPage;
    $posts = $postManager->getPosts($start, $postsPerPage);
    $posts1 = $postManager->getPosts(0, 5);

    include 'view/frontend/pages/blog.php';
}
/* **************** 10 . AFFICHER UN SEUL BLOG POST **********/
function listPost($postId)
{

    $postManager = new PostManager();
    $commentManager = new CommentManager();
    
    $userManager = new UserManager();
    $sessionManager = new SessionManager();
    $posts1 = $postManager->getPosts(0, 5);
    $post = $postManager->getPost($postId);
    if (isset($postId) && $postId > 0 && (!empty($post))) {
        
        $comments = $commentManager->getComments($postId);
        $user = $userManager->getUser($postId);
        $nbCount = $commentManager->countCommentRequest($postId);
        include 'view/frontend/pages/blog_post.php';
    }   
    else {
        $sessionManager->noIdPost();
    }
}
/* **************** 11 . AJOUTER UN COMMENTAIRE **************/
function addComment($postId, $author, $content)
{
    $commentManager = new CommentManager();
    $sessionManager = new SessionManager();

    if (isset($postId) && $postId > 0) {
        if (!empty($content)) {
            $affectedLines = $commentManager->postComment($postId, $author, $content);
            $sessionManager->addedComment();
            header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
            exit();
            if ($affectedLines === false) {
                $sessionManager->needsRegister();
                header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
                exit();
            }
        }
        else {
            $sessionManager->emptyContent();
            header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
            exit();
        }
    }
    else {
        $sessionManager->noIdPost();
    }
}
/* **************** 12 . PAGE POUR MODIFIER UN COMMENTAIRE ***/
function modifyCommentPage($commentId)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $userManager = new UserManager();
    $sessionManager = new SessionManager();
    $comment = $commentManager->getComment($commentId);
    $post = $postManager->getPost($comment['post_id']);
    $posts1 = $postManager->getPosts(0, 5);
    if (empty($comment) || $commentId <= 0 ) {
        $sessionManager->noIdComment();
    }
    elseif (isset($commentId) && $commentId > 0) {
        if (($_SESSION['pseudo'] != $comment['author']) && ($_SESSION['autorisation'] == 0)) {
            $sessionManager->noRightsComments();
        }
        else {
            include 'view/frontend/pages/modifyCommentPage.php';
        }
    }
}
/* **************** 13 . SUPPRIMER UN COMMENTAIRE ************/
function deleteComment($commentId)
{

    $commentManager = new CommentManager();
    $sessionManager = new SessionManager();
    if ($success === false) {
        throw new Exception('Impossible de supprimer le commentaire');
    }
    elseif (isset($commentId) && $commentId > 0) {
        $comment = $commentManager->getComment($commentId);
        $success = $commentManager->deleteCommentRequest($commentId);
        header('Location: index.php?action=blogpost&id=' . $comment['post_id'] . '#comments');
    }
    elseif (empty($comment) || $commentId <= 0 ) {
        $sessionManager->noIdComment();
    }
}
/* **************** 14 . MODIFIER UN COMMENTAIRE *************/
function modifyComment($commentId, $author, $content)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($commentId);
    $sessionManager = new SessionManager();
    if (isset($commentId) && $commentId > 0) {
        if (!empty($content)) {
            $success = $commentManager->modifyCommentRequest($commentId, $author, $content);
            $sessionManager->addedComment();
            header('Location: index.php?action=blog');
            if ($success === false) {
                throw new Exception('Impossible de modifier le commentaire !');
            }
        }
        else {
            $sessionManager->emptyContent();
            header('Location: index.php?action=modifyCommentPage&id=' . $_GET['id']);
            exit();
        }
    }
    elseif (empty($comment) || $commentId <= 0 ) {
        $sessionManager->noIdComment();
    }
}
/* **************** 15. ERRORS *******************************/
function errors()
{
    include 'view/frontend/pages/errors.php';
}
/* *********** 16 . PAGE NO ADMIN ****************************/
function noAdmin()
{
    include 'view/frontend/pages/noadmin.php';
}
/* **************** 17 . CONTACT *****************************/
function contact($name, $email, $subject, $message)
{
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
         $mail = new PHPMailer(true);                             
        try {
            $mail->setFrom($email, 'Mailer');
            $mail->addAddress('contact@philippetraon.com', 'Philippe Traon');
            $mail->addReplyTo($email, 'Information');
            $ip = $_SERVER["REMOTE_ADDR"];
            $mail->isHTML(true);                                  
            $mail->Subject = 'Message';
            $mail->Body    = '<b>Auteur : </b>' . $name . '<br />' . '<b>IP : </b>' . $ip . '<br />' . '<b>Message : </b>' . $message;
            $mail->AltBody = 'Message non-HTML : '.$message;
            $mail->send();
            echo 'Le message a bien été envoyé';
        } 
        catch (Exception $e) {
        echo 'Un problème est survenu ! Le message n\'a pas pu être envoyé : ', $mail->ErrorInfo;
        }
    }
}
/* *********** 18 . SEARCH ****************************/
function search($search)
{
    if (isset($search) && $search != NULL) {
        $postManager = new PostManager();
        $posts1 = $postManager->getPosts(0, 5);
        $countSearchResults = $postManager->countSearchRequest($search);
        $nbResults = $countSearchResults->rowCount();
        $results = $postManager->searchRequest($search);
        require('view/frontend/pages/searchresults.php');
    }
}