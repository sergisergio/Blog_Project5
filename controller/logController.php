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
    function login($pseudo,$passe, $ip)
    {
        $userManager = new UserManager();
        $session = new Session();
        $securityManager = new SecurityManager();
        if(!empty($pseudo) && !empty($passe)) {
            $user = $userManager->loginRequest($pseudo, $passe);
            $count = $securityManager->checkBruteForce($ip);

            if ($count < 3) {
                if(password_verify($passe, $user->getPassword())) {
                    if ($user->getIsActive() == 1) {
                        //lauchSession($user);
                        $_SESSION['pseudo'] = $user->getPseudo();
                        $_SESSION['id'] = $user->getId();
                        $_SESSION['prenom'] = $user->getFirstName();
                        $_SESSION['nom'] = $user->getLastName();
                        $_SESSION['email'] = $user->getEmail();
                        $_SESSION['password'] = $user->getPassword();
                        $_SESSION['autorisation'] = $user->getAuthorization1();
                        $_SESSION['avatar'] = $user->getAvatar();
                        $_SESSION['registration'] = $user->getRegistrationDate();
                        header('Location: index.php?action=blog');
                        exit();
                    }
                    else {
                        $session->activateAccount();
                    }
                }
                else {
                    sleep(1);
                    $security->registerAttempt($ip);
                    $session->errorPassword2();
                }
            }
            else {
                $session->responsebruteForce();
            }
        }
        else {
            $session->emptyContents2();
        }
    }
/* ***************** DISCONNECTION ***********************/
    function logout()
    {
        $session = new Session();
        $session->stopSession();
    }