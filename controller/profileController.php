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
use \Philippe\Blog\Lib\Entities\UserEntity;
use \Philippe\Blog\Lib\Model\UserManager;
use \Philippe\Blog\Lib\Model\CommentManager;
use \Philippe\Blog\Lib\Core\Session;

/**
 * Function profilePage
 * 
 * @param int $userId the user's id
 * 
 * @return mixed
 */
function profilePage($userId)
{
    $userManager = new UserManager();
    $post = $userManager->getUser($userId);
    include 'App/frontend/Modules/Blog/Profiles/Private/profile.php';
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
function modifyProfile($userId, $avatar, $first_name, $name, $email, $description, $csrfProfileToken)
{
    $userManager = new UserManager();
    $_SESSION['csrfProfileToken'] = $csrfProfileToken; 

    if (!empty($_POST['email'])) {
        if (isset($_SESSION['csrfProfileToken']) AND isset($csrfProfileToken) AND !empty($_SESSION['csrfProfileToken']) AND !empty($csrfProfileToken)) {
            if ($_SESSION['csrfProfileToken'] == $csrfProfileToken) {
                if (isset($_FILES['avatar']) AND $_FILES['avatar']['error'] == 0) {
                    if ($_FILES['avatar']['size'] <= 1000000) { 
                        $infosfichier = pathinfo($_FILES['avatar']['name']); 
                        $extension_upload = $infosfichier['extension']; 
                        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                        if (in_array($extension_upload, $extensions_autorisees)) {
                            move_uploaded_file($_FILES['avatar']['tmp_name'], 'public/images/avatar/' . basename($_FILES['avatar']['name'])); 
                            echo "L'envoi a bien été effectué !";
                        }
                    }
                }
                $modifiedProfile = $userManager->modifyProfileRequest($userId, $avatar, $first_name, $name, $email, $description);
                if ($modifiedProfile === false) {
                    $_SESSION['flash']['danger'] = 'Impossible de modifier le profil !';
                    profilePage($_SESSION['id']);
                } else {
                    $_SESSION['flash']['success'] = 'Modification effectuée !';
                    profilePage($_SESSION['id']);
                    unset($_SESSION['avatar']);
                    $_SESSION['avatar'] = $avatar;
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                profilePage($_SESSION['id']);
            }
        }
    } else {
        $_SESSION['flash']['danger'] = 'Tous les champs ne sont pas remplis !';
        profilePage($_SESSION['id']);
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
function deleteAccount($userId, $csrfDeleteAccountToken)
{
    $userManager = new UserManager();
    $session = new Session();
    
    $_SESSION['csrfDeleteAccountToken'] = $csrfDeleteAccountToken;  
    if (isset($userId)) {
        if (isset($_SESSION['csrfDeleteAccountToken']) AND isset($csrfDeleteAccountToken) AND !empty($_SESSION['csrfDeleteAccountToken']) AND !empty($csrfDeleteAccountToken)) {
            if ($_SESSION['csrfDeleteAccountToken'] == $csrfDeleteAccountToken) {
                $deleteAccount = $userManager->deleteAccountRequest($userId);
                $session->stopSession();
                if ($deleteAccount === false) {
                    $_SESSION['flash']['danger'] = 'Impossible de supprimer le profil !';
                    profilePage();
                } else {
                    home();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                profilePage($_SESSION['id']);
            }
        }
    } else {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet utilisateur !';
        profilePage($_SESSION['id']);
    }
}
/**
 * Function publicProfile
 * 
 * @param string $commentAuthor comment's author
 * 
 * @return mixed
 */
function publicProfile($commentAuthor)
{
    $commentManager = new CommentManager();
    $user = $commentManager->getUserByCommentRequest($commentAuthor);
    include 'App/frontend/Modules/Blog/Profiles/Public/publicProfile.php';
}