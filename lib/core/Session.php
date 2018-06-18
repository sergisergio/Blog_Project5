<?php
/**
 * My own blog.
 *
 * Session
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Lib\Core;
class Session
{
    /**
     * Launch Session
     * 
     * @param string $user user
     * 
     * @return string
     */
    public function launchSession($user)
    {
        $_SESSION['pseudo'] = $user->getPseudo();
        $_SESSION['id'] = $user->getId();
        $_SESSION['prenom'] = $user->getFirst_name();
        $_SESSION['nom'] = $user->getLast_name();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['password'] = $user->getPassword();
        $_SESSION['autorisation'] = $user->getAuthorization();
        $_SESSION['avatar'] = $user->getAvatar();
        $_SESSION['registration'] = $user->getRegistration_date();
        $_SESSION['is_active'] = $user->getIs_active();
        $_SESSION['description'] = $user->getDescription();
        header('Location: index.php?action=blog');
        exit();
    }
    /**
     * Stop Session
     * 
     * @return mixed
     */
    public function stopSession()
    {
        session_start();
        setcookie('pseudo', null, -1);
        setcookie('password', null, -1);
        unset($_SESSION);
        session_destroy();
        header('Location: index.php?action=blog');
    }
}