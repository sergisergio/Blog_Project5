<?php
/**
 * My own blog.
 *
 * Cookie
 *
 * PHP Version 7
 * 
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  GIT: $Id$ In development.
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Src\Core;

use \Philippe\Blog\Src\Model\UserManager;
use \Philippe\Blog\Src\Core\Session;
/**
 *  Class Cookie
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class Cookie
{

    private $_userManager;
    private $_session;

    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_userManager = new UserManager();
        $this->_session = new Session();
    }
    /**
     * Function reconnect
     * 
     * @return mixed
     */
    function reconnect()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_COOKIE['remember']) && !isset($_SESSION['pseudo']) ) {
            $remember_token = $_COOKIE['remember'];
            $parts = explode('==', $remember_token);
            $user_id = $parts[0];
            $this->_userManager->userCookie($user_id);
            if ($user) {
                $expected = $user_id . '==' . $remember_token . sha1($pseudo . 'philippe');
                if ($expected == $remember_token) {
                    session_start();
                    $this->_session->launchSession($user);
                    setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
                } else {
                    setcookie('remember', null, -1);
                }
            } else {
                setcookie('remember', null, -1);
            }
        }
    }
}