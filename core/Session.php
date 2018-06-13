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
namespace Philippe\Blog\Core;
class Session
{
    /**
     * Launch Session
     * 
     * @param int $user user
     * 
     * @return int
     */
    public function launchSession($user)
    {
        $_SESSION['pseudo'] = $user->getPseudo();
        $_SESSION['id'] = $user->getId();
        $_SESSION['prenom'] = $user->getFirstName();
        $_SESSION['nom'] = $user->getlastName();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['password'] = $user->getPassword();
        $_SESSION['autorisation'] = $user->getAuthorization1();
        $_SESSION['avatar'] = $user->getAvatar();
        $_SESSION['registration'] = $user->getRegistrationDate();
        $_SESSION['is_active'] = $user->getIsActive();
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