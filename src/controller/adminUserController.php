<?php 
/**
 * My own blog.
 *
 * Administrator User Controller
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
namespace Philippe\Blog\Src\Controller;

use \Philippe\Blog\Src\Controller\ErrorsController;
use \Philippe\Blog\Src\Model\UserManager;
/**
 *  Class AdminUserController
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class AdminUserController
{
    private $_errorsController;
    private $_userManager;
    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_errorsController = new ErrorsController();
        $this->_userManager = new UserManager();
    }
	
    /**
     * Show the user management's part
     * 
     * @return mixed
     */
    public function manageUsers()
    {
        if (!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ) {
            $this->_errorsController->noAdmin();
        } else {
            $csrfCancelAdminRightsToken = md5(time()*rand(1, 1000));
            $csrfGiveAdminRightsToken = md5(time()*rand(1, 1000));
            $csrfDeleteUserToken = md5(time()*rand(1, 1000));
            $users = $this->_userManager->getUsers();
            include 'views/backend/modules/users/user_mgmt.php';
        }
    }
    /**
     * Give admin Rights to a user
     * 
     * @param int    $userId                   the user's id
     * @param string $csrfGiveAdminRightsToken the token to try to avoid csrf
     * 
     * @return mixed
     */
    public function giveAdminRights($userId, $csrfGiveAdminRightsToken)
    {
        $_SESSION['csrfGiveAdminRightsToken'] = $csrfGiveAdminRightsToken;
        if (isset($_SESSION['csrfGiveAdminRightsToken']) AND isset($csrfGiveAdminRightsToken) AND !empty($_SESSION['csrfGiveAdminRightsToken']) AND !empty($csrfGiveAdminRightsToken)
        ) {
            if ($_SESSION['csrfGiveAdminRightsToken'] == $csrfGiveAdminRightsToken) {
                if (isset($userId) && $userId > 0) {
                    $adminRights = $this->_userManager->giveAdminRightsRequest($userId);

                    if ($adminRights === false) {
                        throw new Exception('Impossible de donner les droits admin');
                    } else {
                        AdminUserController::manageUsers();
                    }
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminUserController::manageUsers();
            }
        }
    }
    /**
     * Cancel admin Rights to a user
     * 
     * @param int    $userId                     the user's id
     * @param string $csrfCancelAdminRightsToken the token to try to avoid csrf
     * 
     * @return mixed
     */
    public function stopAdminRights($userId, $csrfCancelAdminRightsToken)
    {
        $_SESSION['csrfCancelAdminRightsToken'] = $csrfCancelAdminRightsToken;
        if (isset($_SESSION['csrfCancelAdminRightsToken']) AND isset($csrfCancelAdminRightsToken) AND !empty($_SESSION['csrfCancelAdminRightsToken']) AND !empty($csrfCancelAdminRightsToken)
        ) {
            if ($_SESSION['csrfCancelAdminRightsToken'] == $csrfCancelAdminRightsToken) {
                if (isset($userId) && $userId > 0) {
                    $adminRights = $this->_userManager->stopAdminRightsRequest($userId);

                    if ($adminRights === false) {
                        throw new Exception('Impossible de retirer les droits admin');
                    } else {
                        AdminUserController::manageUsers();
                    }
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminUserController::manageUsers();
            }
        }
    }
    /**
     * Delete a user
     * 
     * @param int    $userId              the user's id
     * @param string $csrfDeleteUserToken the token to try to avoid csrf.
     * 
     * @return mixed
     */
    public function deleteUser($userId, $csrfDeleteUserToken)
    {
        $_SESSION['csrfDeleteUserToken'] = $csrfDeleteUserToken;
        if (isset($_SESSION['csrfDeleteUserToken']) AND isset($csrfDeleteUserToken) AND !empty($_SESSION['csrfDeleteUserToken']) AND !empty($csrfDeleteUserToken)
        ) {
            if ($_SESSION['csrfDeleteUserToken'] == $csrfDeleteUserToken) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $affectedUser = $this->_userManager->deleteUserRequest($userId);

                    if ($affectedUser === false) {
                        throw new Exception('Impossible de supprimer ce membre');
                    } else {
                        AdminUserController::manageUsers();
                    }
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminUserController::manageUsers();
            }
        }
    }   
}