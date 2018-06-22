<?php
/**
 * My own blog.
 *
 * Session
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
/**
 *  Class Session
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
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