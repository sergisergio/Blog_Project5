<?php
/**
 * My own blog.
 *
 * Profile Controller
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Src\Controller;

use \Philippe\Blog\Src\Entities\UserEntity;
use \Philippe\Blog\Src\Model\UserManager;
use \Philippe\Blog\Src\Model\PostManager;
use \Philippe\Blog\Src\Model\CategoryManager;
use \Philippe\Blog\Src\Model\CommentManager;
use \Philippe\Blog\Src\Core\Session;

class ProfileController
{
    private $_postmanager;
    private $_userManager;
    private $_categoryManager;
    private $_commentManager;
    private $_defaultController;
    private $_session;

    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_postManager = new PostManager();
        $this->_userManager = new UserManager();
        $this->_categoryManager = new CategoryManager();
        $this->_commentManager = new CommentManager();
        $this->_defaultController = new DefaultController();
        $this->_session = new Session();
    }
    /**
     * Function profilePage
     * 
     * @param int $userId the user's id
     * 
     * @return mixed
     */
    public function profilePage($userId)
    {
        $accessAdminToken = md5(time()*rand(1, 1000));
        $post = $this->_userManager->getUser($userId);
        $csrfProfileToken = md5(time()*rand(1, 1000)); 
        $csrfDeleteAccountToken = md5(time()*rand(1, 1000));
        include 'views/frontend/modules/blog/profiles/private/profile.php';
    }
    /**
     * Function modifyProfile
     * 
     * @param int    $userId           the user's id
     * @param string $avatar           avatar
     * @param string $first_name       first_name
     * @param string $name             name
     * @param string $email            email
     * @param string $description      description
     * @param string $csrfProfileToken token to avoid csrf
     * 
     * @return mixed
     */
    public function modifyProfile($userId, $avatar, $first_name, $name, $email, $description, $csrfProfileToken)
    {
        $_SESSION['csrfProfileToken'] = $csrfProfileToken;
        if (!empty($_POST['email'])) {
            $usermail = $this->_userManager->existMail($email);
            if ($usermail && $email !== $_SESSION['email'])
            {
                $_SESSION['flash']['danger'] = 'Cette adresse email est déjà utilisée !';
                ProfileController::profilePage($_SESSION['id']);
            }
            if (isset($_SESSION['csrfProfileToken']) AND isset($csrfProfileToken) AND !empty($_SESSION['csrfProfileToken']) AND !empty($csrfProfileToken)) {
                if ($_SESSION['csrfProfileToken'] == $csrfProfileToken) {
                    if (isset($_FILES['avatar']) AND $_FILES['avatar']['error'] == 0) {
                        if ($_FILES['avatar']['size'] <= 1000000) { 
                            $infosfichier = pathinfo($_FILES['avatar']['name']); 
                            $extension_upload = $infosfichier['extension']; 
                            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                            if (in_array($extension_upload, $extensions_autorisees)) {
                                move_uploaded_file($_FILES['avatar']['tmp_name'], 'public/images/avatar/' . basename($_FILES['avatar']['name']));
                            }
                        }
                    }
                    $modifiedProfile = $this->_userManager->modifyProfileRequest($userId, $avatar, $first_name, $name, $email, $description);
                    if ($modifiedProfile === false) {
                        $_SESSION['flash']['danger'] = 'Impossible de modifier le profil !';
                        ProfileController::profilePage($_SESSION['id']);
                    } else {
                        unset($_SESSION['avatar']);
                        $_SESSION['avatar'] = $avatar;
                        $_SESSION['flash']['success'] = 'Modification effectuée !';
                        ProfileController::profilePage($_SESSION['id']);
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                    ProfileController::profilePage($_SESSION['id']);
                }
            }
        } else {
            $_SESSION['flash']['danger'] = 'Tous les champs ne sont pas remplis !';
            ProfileController::profilePage($_SESSION['id']);
        }
    }
    /**
     * Function deleteAccount
     * 
     * @param int    $userId                 the user's id
     * @param string $csrfDeleteAccountToken the token to avoid csrf
     * 
     * @return mixed
     */
    public function deleteAccount($userId, $csrfDeleteAccountToken)
    {
        $_SESSION['csrfDeleteAccountToken'] = $csrfDeleteAccountToken;  
        if (isset($userId)) {
            if (isset($_SESSION['csrfDeleteAccountToken']) AND isset($csrfDeleteAccountToken) AND !empty($_SESSION['csrfDeleteAccountToken']) AND !empty($csrfDeleteAccountToken)) {
                if ($_SESSION['csrfDeleteAccountToken'] == $csrfDeleteAccountToken) {
                    $deleteAccount = $this->_userManager->deleteAccountRequest($userId);
                    $this->_session->stopSession();
                    if ($deleteAccount === false) {
                        $_SESSION['flash']['danger'] = 'Impossible de supprimer le profil !';
                        ProfileController::profilePage();
                    } else {
                        $this->_defaultController->home();
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                    ProfileController::profilePage($_SESSION['id']);
                }
            }
        } else {
            $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet utilisateur !';
            ProfileController::profilePage($_SESSION['id']);
        }
    }
    /**
     * Function publicProfile
     * 
     * @param string $commentAuthor comment's author
     * 
     * @return mixed
     */
    public function publicProfile($commentAuthor)
    {
        if (isset($commentAuthor)) {
            $accessAdminToken = md5(time()*rand(1, 1000));
            $user = $this->_commentManager->getUserByCommentRequest($commentAuthor);
            include 'views/frontend/modules/blog/profiles/public/publicProfile.php';
        }
    }
}