<?php

use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Core\Session;
use \Philippe\Blog\Model\SecurityManager;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Function signupPage
 * 
 * @return [type]
 */
function signupPage()
{
    include 'view/frontend/pages/signup.php';
}
/**
 * Function addUser
 * 
 * @param pseudo          $pseudo          pseudo
 * @param email           $email           email
 * @param passe           $passe           password1
 * @param passe2          $passe2          password2
 * @param csrfSignupToken $csrfSignupToken the token to try to avoid csrf
 *
 * @return [type]
 */
function addUser($pseudo, $email, $passe, $passe2, $csrfSignupToken)
{
    $userManager = new UserManager();
    $session = new Session();
    $_SESSION['csrfSignupToken'] = $csrfSignupToken; 
    if (!empty($pseudo) && !empty($email) && !empty($passe) && !empty($passe2)) {
        $user = $userManager->existPseudo($pseudo);
        $usermail = $userManager->existMail($email);
        if ($user) {
            $_SESSION['flash']['danger'] = 'Ce pseudo est déjà pris !';
            signupPage();
        } elseif ($usermail) {
            $_SESSION['flash']['danger'] = 'Cet email est déjà utilisé !';
            signupPage();
        } elseif(empty($pseudo) || !preg_match('/^[a-zA-Z0-9_@#&é§è!çà^¨$*`£ù%=+:\;.,?°<>]+$/', $pseudo)) {
            $_SESSION['flash']['danger'] = 'Votre pseudo n\'est pas valide (caractères alphanumériques et underscore permis... !';
            signupPage();
        } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash']['danger'] = 'Votre email n\'est pas valide !';
            signupPage();
        } elseif (empty($passe) || $passe != $_POST['passe2']) {
            $_SESSION['flash']['danger'] = 'Vous devez entrer un mot de passe valide !';
            signupPage();
        } elseif (strlen($passe) < 6 || strlen($passe) > 50) {
            $_SESSION['flash']['danger'] = 'Votre mot de passe doit faire entre 6 et 50 caractères !';
            signupPage();
        } else {
            if (isset($_SESSION['csrfSignupToken']) AND isset($csrfSignupToken) AND !empty($_SESSION['csrfSignupToken']) AND !empty($csrfSignupToken)) {
                if ($_SESSION['csrfSignupToken'] == $csrfSignupToken) {
                    $users = $userManager->addUserRequest($pseudo, $email, $passe);
                    if ($users === false) {
                        $_SESSION['flash']['danger'] = 'Inscription impossible !';
                        signupPage();
                    } else {   
                        //$user_id = $users->getId();
                        //$token = $users->getConfirmationToken();
                        //mail($email, 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://localhost:8888/Blog_Project5/index.php?action=confirmRegistration&id=$user_id&token=$token");
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
                        $_SESSION['flash']['success'] = 'Un mail de confirmation vous a été envoyé pour valider votre compte';
                        loginPage();
                    }    
                    /* test mail local */
                    //mail($email, 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://localhost:8888/Blog_Project5/index.php?action=confirmRegistration&id=$user_id&token=$token");
                    /* test mail online */
                } else {
                    $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                    loginPage();
                }
            }
        }                
    } else {
        $_SESSION['flash']['danger'] = 'Vous devez remplir tous les champs !';
        signupPage();
    }
}
/**
 * Function confirmRegistration
 * 
 * @param userId    $userId    the user's id
 * @param userToken $userToken the token to confirm the registration
 * 
 * @return [type]
 */
function confirmRegistration($userId, $userToken)
{
    $userManager = new UserManager();
    $user = $userManager->getUser($userId);
    $session = new Session();
    if (isset($_GET['id']) && isset($_GET['token'])) {
        if ($user &&  $user->getConfirmationToken() == $userToken) {
            $userManager->setActiveRequest($userId);
            $_SESSION['flash']['success'] = 'Votre inscription a bien été prise en compte ! Vous pouvez vous connecter !';
            loginPage();
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
        } else {
            $_SESSION['flash']['danger'] = 'Ce token n est plus valide ! Veuillez réessayer ! !';
            signupPage();
        } 
    } else {
        $_SESSION['flash']['danger'] = 'Echec de l\'inscription ! Veuillez réessayer sinon contactez l\'administrateur';
        signupPage();
    }  
}
/**
 * Function setActiveUser
 * 
 * @param userId $userId the user's id
 *
 * @return [type]
 */
function setActiveUser($userId)
{
    $userManager = new UserManager();
    $activeUser = $userManager->setActiveRequest($userId);
}
