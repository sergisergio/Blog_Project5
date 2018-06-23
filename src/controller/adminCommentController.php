<?php 
/**
 * My own blog.
 *
 * Administrator Comment Controller
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

use \Philippe\Blog\Src\Model\CommentManager;
use \Philippe\Blog\Src\Controller\ErrorsController;
/**
 *  Class AdminCommentController
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class AdminCommentController
{
	private $_commentManager;
    private $_errorsController;
    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_commentManager = new CommentManager();
        $this->_errorsController = new ErrorsController();
    }
	/**
     * Show the comment management's part
     * 
     * @return mixed
     */
    public function manageComments()
    {
        if (!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ) {
            $this->_errorsController->noAdmin();
        } else {
            $csrfValidateCommentToken = md5(time()*rand(1, 1000));
            $csrfAdminDeleteCommentToken = md5(time()*rand(1, 1000));
            $nbCount = $this->_commentManager->countCommentBackRequest();
            $submittedComment = $this->_commentManager->submittedCommentRequest();
            include 'views/backend/modules/comments/manageComments.php';
        }
    }
    /**
     * Validate a comment
     * 
     * @param int    $commentId                the comment's id
     * @param string $csrfValidateCommentToken the token to try to avoid csrf
     * 
     * @return mixed
     */
    public function validateComment($commentId, $csrfValidateCommentToken)
    {
        $validated = $this->_commentManager->validateCommentRequest($commentId);
        $_SESSION['csrfValidateCommentToken'] = $csrfValidateCommentToken;
        if (isset($_SESSION['csrfValidateCommentToken']) AND isset($csrfValidateCommentToken) AND !empty($_SESSION['csrfValidateCommentToken']) AND !empty($csrfValidateCommentToken)) {
            if ($_SESSION['csrfValidateCommentToken'] == $csrfValidateCommentToken) {
                if (isset($commentId) && $commentId > 0) {
                    if ($validated === false) {
                        $_SESSION['flash']['danger'] = 'Impossible de valider le commentaire';
                        AdminCommentController::manageComments();
                    } else {
                        $_SESSION['flash']['success'] = 'Le commentaire a bien été validé !';
                        AdminCommentController::manageComments();
                    }
                } elseif ($commentId <= 0) {
                    $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce commentaire !';
                    AdminCommentController::manageComments();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminCommentController::manageComments();
            }
        }
    }
    /**
     * Delete a comment
     * 
     * @param int    $commentId                   the comment's id
     * @param string $csrfAdminDeleteCommentToken the token to try to avoid csrf
     * 
     * @return mixed
     */
    public function adminDeleteComment($commentId, $csrfAdminDeleteCommentToken)
    {
        $this->_commentManager->getComment($commentId);
        $_SESSION['csrfAdminDeleteCommentToken'] = $csrfAdminDeleteCommentToken;
        if (isset($_SESSION['csrfAdminDeleteCommentToken']) AND isset($csrfAdminDeleteCommentToken) AND !empty($_SESSION['csrfAdminDeleteCommentToken']) AND !empty($csrfAdminDeleteCommentToken)) {
            if ($_SESSION['csrfAdminDeleteCommentToken'] == $csrfAdminDeleteCommentToken) {
                if (isset($commentId) && $commentId > 0) {
                    $success = $this->_commentManager->deleteCommentRequest($commentId);
                    if ($success === false) {
                        $_SESSION['flash']['danger'] = 'Impossible de supprimer le commentaire !';
                        AdminCommentController::manageComments();
                    } else {   
                        $_SESSION['flash']['success'] = 'Le commentaire a bien été supprimé !';
                        AdminCommentController::manageComments();
                    }
                } elseif ($commentId <= 0) {
                    $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce commentaire !';
                    AdminCommentController::manageComments();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminCommentController::manageComments();
            }
        }
    }
}