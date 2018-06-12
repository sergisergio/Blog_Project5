<?php
namespace Philippe\Blog\Core;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Core\Session;
/**
 * Function reconnect_from_cookie
 * 
 * @return [type]
 */
function reconnect_from_cookie()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_COOKIE['pseudo'], $_COOKIE['password']) && !isset($_SESSION['pseudo']) && !empty($_COOKIE['pseudo']) && !empty($_COOKIE['password'])) {
        $userManager = new UserManager();
        $session = new Session();
        $user = $userManager->userCookie($_COOKIE['pseudo'], $_COOKIE['password']);
        if ($user) {
            $session->launchSession($user);
        } else {
            setcookie('remember', null, -1);
        }
    }
}