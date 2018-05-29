<?php

require "vendor/autoload.php";
// use \Philippe\Blog\Model\Entities\PostEntity;
// use \Philippe\Blog\Model\Entities\CommentEntity;
use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
// use \Philippe\Blog\Model\PostManager;
// use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Model\SessionManager;
use \Philippe\Blog\Model\SecurityManager;
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

/* ***************** PAGE CONNEXION **********************/
function loginPage()
{
    include 'view/frontend/pages/login.php';
}

/* ***************** CONNEXION ***************************/
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
/* ***************** DECONNEXION *************************/
function logout()
{
    $sessionManager = new SessionManager();
    $sessionManager->stopSession();
}