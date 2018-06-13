<?php
/**
 * My own blog.
 *
 * Cookie
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Core;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Core\Session;
/**
 * Function reconnect_from_cookie
 * 
 * @return mixed
 */
function reconnect_from_cookie()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_COOKIE['pseudo'], $_COOKIE['password']) && !isset($_SESSION['pseudo']) && !empty($_COOKIE['pseudo']) && !empty($_COOKIE['password'])) {
        $userManager = new UserManager();
        $session = new Session();
        $user = $userManager->userCookie($_COOKIE['pseudo']);
        if ($user) {
            $session->launchSession($user);
        } else {
            setcookie('remember', null, -1);
        }
    }
}