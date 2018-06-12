<?php

use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Core\Session;
use \Philippe\Blog\Model\SecurityManager;

/* ***************** CONNECTION PAGE *********************/
function loginPage()
{
    include 'view/frontend/pages/login.php';
}
/* ***************** CONNEXION ***************************/
function login($pseudo,$passe, $ip, $csrfLoginToken, $remember)
{
    $userManager = new UserManager();
    $session = new Session();
    $securityManager = new SecurityManager();

    $_SESSION['csrfLoginToken'] = $csrfLoginToken;  
    if (isset($_SESSION['csrfLoginToken']) AND isset($csrfLoginToken) AND !empty($_SESSION['csrfLoginToken']) AND !empty($csrfLoginToken)) {
        if ($_SESSION['csrfLoginToken'] == $csrfLoginToken) {
            if(!empty($pseudo) && !empty($passe)) {
                $user = $userManager->loginRequest($pseudo, $passe);
                $count = $securityManager->checkBruteForce($ip);

                if ($count < 3) {
                    if(password_verify($passe, $user->getPassword())) {
                        if ($user->getIsActive() == 1) {
                            
                            if(isset($remember)) {
                                /*function str_random($length)
                                {
                                    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
                                    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length); 
                                }
                                $remember_token = str_random(250);
                                    
                                $addCookie = $userManager->addCookie($pseudo, $remember_token);
                                setcookie('remember', $_SESSION['id'] . '==' . $remember_token . sha1($_SESSION['id'] . 'philippetraon'), time() + 60 * 60 * 24 * 7);*/
                                setcookie('pseudo', $pseudo, time() + 60 * 60 * 24 * 7);
                                //setcookie('password', sha1($passe), time() + 60 * 60 * 24 * 7);
                                $userManager->userCookie($_COOKIE['pseudo']);
                            }
                            $session->launchSession($user);
                        }
                        else 
                        {
                            $session->activateAccount();
                        }
                    }
                    else 
                    {
                        sleep(1);
                        $securityManager->registerAttempt($ip);
                        $session->errorPassword2();

                    }
                }
                else 
                {
                    $session->responsebruteForce();
                }
            }
            else 
            {
                $session->emptyContents2();
            }
        }
        else
        {
            $session->loginCsrfError();
        }
    }
}
/* ***************** DISCONNECTION ***********************/
function logout()
{
    $session = new Session();
    $session->stopSession();
}
/* ***************** FORGET PASSWORD PAGE ****************/
function forgetPasswordPage()
{
    include 'view/frontend/pages/forgetPasswordPage.php';
}
/* ***************** FORGET PASSWORD MAIL ****************/
function forgetPassword($email, $csrfForgetToken)
{
    $userManager = new UserManager();
    $session = new Session();  

    $_SESSION['forgetToken'] = $csrfForgetToken;  
    if (empty($email)) {
            $session->emptyMail();
    }
    else 
    {
        if (isset($_SESSION['forgetToken']) AND isset($csrfForgetToken) AND !empty($_SESSION['forgetToken']) AND !empty($csrfForgetToken)) {
            if ($_SESSION['forgetToken'] == $csrfForgetToken) {
                if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $user = $userManager->forgetPasswordRequest($email);
                    if ($user === false) {
                        $session->errorForgetPassword();
                    }
                    else 
                    {
                        $session->mailForgetPassword();
                    } 
                }

                else 
                {
                    $session->nonMail();
                }
            }
            else
            {
                $session->forgetCsrfError();
            }
        }
    }
}
/* ***************** CHANGE PASSWORD PAGE ****************/
function changePasswordPage($userId, $resetToken)
{
    $userManager = new UserManager();
    $session = new Session(); 
        
    if ((isset($_GET['id']) && $_GET['id'] > 0) && isset($_GET['token'])) {
        $user = $userManager->checkResetTokenRequest($userId, $resetToken);

        if ($user &&  $user['reset_token'] == $resetToken) {
            include 'view/frontend/pages/changePasswordPage.php';
        }
        else 
        {
            $session->forgetTokenError();
        }
    }
    else 
    {
        $session->tokenPassword();
    }
}
/* ***************** CHANGE PASSWORD *********************/
function changePassword($userId, $passe, $csrfChangePasswordToken)
{
    $userManager = new UserManager();
    $session = new Session(); 
    
    $_SESSION['csrfChangePasswordToken'] = $csrfChangePasswordToken; 
    if(!empty($_POST['passe']) && $_POST['passe'] == $_POST['passe2']) {
        if (isset($_SESSION['csrfChangePasswordToken']) AND isset($csrfChangePasswordToken) AND !empty($_SESSION['csrfChangePasswordToken']) AND !empty($csrfChangePasswordToken)) {
            if ($_SESSION['csrfChangePasswordToken'] == $csrfChangePasswordToken) {
                $userManager->changePasswordRequest($userId, $passe);
                $session->changedPassword();
            }
            else
            {
                $session->changeCsrfError();
            }
        }
    }
    else 
    {
        $session->emptyPassword();
    }
}