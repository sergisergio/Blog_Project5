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
function login($pseudo,$passe, $ip, $csrfLoginToken)
{
    $userManager = new UserManager();
    $session = new Session();
    $securityManager = new SecurityManager();

    if (isset($_SESSION['csrfLoginToken']) AND isset($csrfLoginToken) AND !empty($_SESSION['csrfLoginToken']) AND !empty($csrfLoginToken)) 
    {
        if ($_SESSION['csrfLoginToken'] == $csrfLoginToken) 
        {
            if(!empty($pseudo) && !empty($passe)) {
                $user = $userManager->loginRequest($pseudo, $passe);
                $count = $securityManager->checkBruteForce($ip);

                if ($count < 3) {
                    if(password_verify($passe, $user->getPassword())) {
                        if ($user->getIsActive() == 1) {
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
            echo "Erreur de vérification";
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
    $userManager = new \Philippe\Blog\Model\UserManager();
       

    if (empty($email)) {
            $_SESSION['flash']['danger'] = 'Veuillez renseigner un email !';
            forgetPasswordPage();
            exit();
    }
    else 
    {
        if (isset($_SESSION['forgetToken']) AND isset($csrfForgetToken) AND !empty($_SESSION['forgetToken']) AND !empty($csrfForgetToken)) 
        {
            if ($_SESSION['token'] == $csrfForgetToken) 
            {
                $user = $userManager->forgetPasswordRequest($email);
                if ($user === false) 
                {
                    $_SESSION['flash']['success'] = 'Une erreur est survenue !';
                    loginPage();
                    exit();
                }
                else 
                {
                    $_SESSION['flash']['success'] = 'Vous allez recevoir un email pour réinitialiser votre mot de passe !';
                    loginPage();
                    exit();
                } 
            }
            else
            {
                echo "Erreur de vérification";
            }
        }
    }
}
/* ***************** CHANGE PASSWORD PAGE ****************/
function changePasswordPage($userId, $resetToken)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
        
    if ((isset($_GET['id']) && $_GET['id'] > 0) && isset($_GET['token'])) {
        $user = $userManager->checkResetTokenRequest($userId, $resetToken);

        if ($user &&  $user['reset_token'] == $resetToken) {
            include 'view/frontend/pages/changePasswordPage.php';
        }
        else 
        {
            echo 'Ce token n est plus valide ! Veuillez réessayer !';
        }
    }
    else 
    {
        $_SESSION['flash']['danger'] = 'Aucun id ou token ne coresspond à cet email, veuillez réessayer !';
        forgetPasswordPage();
        exit();
    }
}
/* ***************** CHANGE PASSWORD *********************/
function changePassword($userId, $passe, $csrfToken)
{
    $userManager = new \Philippe\Blog\Model\UserManager();

    if(!empty($_POST['passe']) && $_POST['passe'] == $_POST['passe2']) 
    {
        if (isset($_SESSION['ChangePasswordToken']) AND isset($csrfChangePasswordToken) AND !empty($_SESSION['ChangePasswordToken']) AND !empty($csrfChangePasswordToken)) 
        {
            if ($_SESSION['ChangePasswordToken'] == $csrfChangePasswordToken) 
            {
                $userManager->changePasswordRequest($userId, $passe);
                $_SESSION['flash']['success'] = 'Le mot de passe a bien été réinitialisé !';
                loginPage();
                exit();
            }
            else
            {
                echo "Erreur de vérification";
            }
        }
    }
    else 
    {
        echo 'Veuillez entrer un mot de passe';
    }
}