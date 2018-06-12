<?php

use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Core\Session;
use \Philippe\Blog\Model\SecurityManager;

/**
 * Function loginPage
 * 
 * @return [type]
 */
function loginPage()
{
    include 'view/frontend/pages/login.php';
}
/**
 * Function login
 * 
 * @param pseudo         $pseudo         pseudo
 * @param passe          $passe          password
 * @param ip             $ip             IP address
 * @param csrfLoginToken $csrfLoginToken token to avoid csrf
 * @param remember       $remember       remember session to reconnect
 * 
 * @return [type]
 */
function login($pseudo,$passe, $ip, $csrfLoginToken, $remember)
{
    $userManager = new UserManager();
    $session = new Session();
    $securityManager = new SecurityManager();

    $_SESSION['csrfLoginToken'] = $csrfLoginToken;  
    if (isset($_SESSION['csrfLoginToken']) AND isset($csrfLoginToken) AND !empty($_SESSION['csrfLoginToken']) AND !empty($csrfLoginToken)) {
        if ($_SESSION['csrfLoginToken'] == $csrfLoginToken) {
            if (!empty($pseudo) && !empty($passe)) {
                $user = $userManager->loginRequest($pseudo, $passe);
                $count = $securityManager->checkBruteForce($ip);
                if ($count < 3) {
                    if (password_verify($passe, $user->getPassword())) {
                        if ($user->getIsActive() == 1) {
                            
                            if (isset($remember)) {
                                setcookie('pseudo', $pseudo, time() + 60 * 60 * 24 * 7);
                                $userManager->userCookie($_COOKIE['pseudo']);
                            }
                            $session->launchSession($user);
                        } else {
                            $session->activateAccount();
                        }
                    } else {
                        sleep(1);
                        $securityManager->registerAttempt($ip);
                        $session->errorPassword2();
                    }
                } else {
                    $session->responsebruteForce();
                }
            } else {
                $session->emptyContents2();
            }
        } else {
            $session->loginCsrfError();
        }
    }
}
/**
 * Function logout
 * 
 * @return [type]
 */
function logout()
{
    $session = new Session();
    $session->stopSession();
}
/**
 * Function forgetPasswordPage
 * 
 * @return [type]
 */
function forgetPasswordPage()
{
    include 'view/frontend/pages/forgetPasswordPage.php';
}
/**
 * Function forgetPassword
 * 
 * @param email           $email           email
 * @param csrfForgetToken $csrfForgetToken token to avoid csrf
 * 
 * @return [type]
 */
function forgetPassword($email, $csrfForgetToken)
{
    $userManager = new UserManager();
    $session = new Session();  

    $_SESSION['forgetToken'] = $csrfForgetToken;  
    if (empty($email)) {
            $session->emptyMail();
    } else {
        if (isset($_SESSION['forgetToken']) AND isset($csrfForgetToken) AND !empty($_SESSION['forgetToken']) AND !empty($csrfForgetToken)) {
            if ($_SESSION['forgetToken'] == $csrfForgetToken) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $user = $userManager->forgetPasswordRequest($email);
                    if ($user === false) {
                        $session->errorForgetPassword();
                    } else {
                        $session->mailForgetPassword();
                    } 
                } else {
                    $session->nonMail();
                }
            } else {
                $session->forgetCsrfError();
            }
        }
    }
}
/**
 * Function changePasswordPage
 * 
 * @param userId     $userId     user's id
 * @param resetToken $resetToken token to reset the password
 * 
 * @return [type]
 */
function changePasswordPage($userId, $resetToken)
{
    $userManager = new UserManager();
    $session = new Session(); 
        
    if ((isset($_GET['id']) && $_GET['id'] > 0) && isset($_GET['token'])) {
        $user = $userManager->checkResetTokenRequest($userId, $resetToken);
        if ($user &&  $user['reset_token'] == $resetToken) {
            include 'view/frontend/pages/changePasswordPage.php';
        } else {
            $session->forgetTokenError();
        }
    } else {
        $session->tokenPassword();
    }
}
/**
 * Function changePassword
 * 
 * @param userId                  $userId                  the user's id
 * @param passe                   $passe                   password
 * @param csrfChangePasswordToken $csrfChangePasswordToken the token to avoid csrf
 * 
 * @return [type]
 */
function changePassword($userId, $passe, $csrfChangePasswordToken)
{ 
    $userManager = new UserManager();
    $session = new Session(); 
    
    $_SESSION['csrfChangePasswordToken'] = $csrfChangePasswordToken; 
    if (!empty($_POST['passe']) && $_POST['passe'] == $_POST['passe2']) {
        if (isset($_SESSION['csrfChangePasswordToken']) AND isset($csrfChangePasswordToken) AND !empty($_SESSION['csrfChangePasswordToken']) AND !empty($csrfChangePasswordToken)) {
            if ($_SESSION['csrfChangePasswordToken'] == $csrfChangePasswordToken) {
                $userManager->changePasswordRequest($userId, $passe);
                $session->changedPassword();
            } else {
                $session->changeCsrfError();
            }
        }
    } else {
        $session->emptyPassword();
    }
}