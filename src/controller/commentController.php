<?php
/**
 * My own blog.
 *
 * Comment Controller
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
use \Philippe\Blog\Src\Model\PostManager;
use \Philippe\Blog\Src\Model\CategoryManager;
/**
 *  Class CommentController
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class CommentController
{
    private $_commentManager;
    private $_errorsController;
    private $_postManager;
    private $_categoryManager;

    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_commentManager = new CommentManager();
        $this->_errorsController = new ErrorsController();
        $this->_postManager = new PostManager();
        $this->_categoryManager = new CategoryManager();
    }
    /**
     * Function addComment
     * 
     * @param int    $postId              the post's id
     * @param string $author              the author
     * @param string $content             the content
     * @param string $csrfAddCommentToken the token to tryto avoid csrf
     *
     * @return mixed
     */
    public function addComment($postId, $author, $content, $csrfAddCommentToken)
    {
        $_SESSION['csrfAddCommentToken'] = $csrfAddCommentToken;
        if (isset($postId) && $postId > 0) {
            if (!empty($content)) {
                if (isset($_SESSION['csrfAddCommentToken']) AND isset($csrfAddCommentToken) AND !empty($_SESSION['csrfAddCommentToken']) AND !empty($csrfAddCommentToken)) {
                    if ($_SESSION['csrfAddCommentToken'] == $csrfAddCommentToken) {
                        $addedComment = $this->_commentManager->postComment($postId, $author, $content);
                        $_SESSION['flash']['success'] = 'Votre commentaire sera validé dans les plus brefs délais !';
                        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
                        exit();
                        if ($addedComment === false) {
                            $_SESSION['flash']['danger'] = 'Vous devez être inscrit pour ajouter un commentaire !';
                            header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
                            exit();
                        }
                    } else {
                        echo "Erreur de vérification";
                    }
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
                exit();
            }
        } else {
            $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
            $this->_errorsController->errors();
        }
    }
    /**
     * Function modifyCommentPage
     * 
     * @param int $commentId the comment's id
     * @param int $postId    the post's id
     * 
     * @return mixed
     */
    public function modifyCommentPage($commentId, $postId)
    {
        $comment = $this->_commentManager->getComment($commentId);
        $post = $this->_postManager->getPost($comment->getPost_id());
        $postsAside = $this->_postManager->getPosts(0, 5);
        $isComment = $this->_commentManager->checkExistComment($commentId);
        $isPost = $this->_postManager->checkExistPost($postId);
        $categories = $this->_categoryManager->getCategoryRequest();

        if (empty($comment) || $commentId <= 0 ) {
            $_SESSION['flash']['danger'] = 'Cet identifiant ne correspond à aucun commentaire !';
            $this->_errorsController->errors();
        } elseif ($isComment == false) {
            $_SESSION['flash']['danger'] = 'Cet identifiant ne correspond à aucun commentaire !';
            $this->_errorsController->errors();
        } elseif ($isPost == false) {
            $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
            $this->_errorsController->errors();
        } elseif (isset($commentId) && $commentId > 0) {
            if (($_SESSION['pseudo'] != $comment->getAuthor()) && ($_SESSION['autorisation'] == 0)) {
                $_SESSION['flash']['danger'] = 'Vous pouvez seulement modifier vos propres commentaires !';
                $this->_errorsController->errors();
            } else {
                $accessAdminToken = md5(time()*rand(1, 1000));
                $csrfSearchToken = md5(time()*rand(1, 1000));
                $csrfModifyCommentToken = md5(time()*rand(1, 1000));
                include 'views/frontend/modules/blog/comments/modifyCommentPage.php';
            }
        }
    }
    /**
     * Function deleteComment
     * 
     * @param int    $commentId              the comment's id
     * @param int    $postId                 the post's id
     * @param string $csrfDeleteCommentToken the token to try to avoid csrf
     * 
     * @return mixed
     */
    public function deleteComment($commentId, $postId, $csrfDeleteCommentToken)
    {
        $_SESSION['csrfDeleteCommentToken'] = $csrfDeleteCommentToken;
        if (isset($_SESSION['csrfDeleteCommentToken']) AND isset($csrfDeleteCommentToken) AND !empty($_SESSION['csrfDeleteCommentToken']) AND !empty($csrfDeleteCommentToken)) {
            if ($_SESSION['csrfDeleteCommentToken'] == $csrfDeleteCommentToken) {
                if (isset($commentId) && $commentId > 0) {
                    $comment = $this->_commentManager->getComment($commentId);
                    $deletedComment = $this->_commentManager->deleteCommentRequest($commentId);         
                    if ($deletedComment === false) {
                        $_SESSION['flash']['danger'] = 'Impossible de supprimer le commentaire !';
                        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
                        exit();
                    } else {
                        $_SESSION['flash']['success'] = 'Le commentaire a bien été supprimé !';
                        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
                        exit();
                    }
                } elseif (empty($comment) || $commentId <= 0 ) {
                    $_SESSION['flash']['danger'] = 'Cet identifiant ne correspond à aucun commentaire !';
                    errors();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
                exit();
            }
        }
    }
    /**
     * Function modifyComment
     * 
     * @param int    $commentId              the comment's id
     * @param string $author                 the author
     * @param string $content                the content
     * @param int    $postId                 the post's id
     * @param string $csrfModifyCommentToken the token to try to avoid csrf
     * 
     * @return mixed
     */
    public function modifyComment($commentId, $author, $content, $postId, $csrfModifyCommentToken)
    {
        $comment = $this->_commentManager->getComment($commentId);

        $_SESSION['csrfModifyCommentToken'] = $csrfModifyCommentToken; 
        if (isset($commentId) && $commentId > 0) {
            if (!empty($content)) {
                if (isset($_SESSION['csrfModifyCommentToken']) AND isset($csrfModifyCommentToken) AND !empty($_SESSION['csrfModifyCommentToken']) AND !empty($csrfModifyCommentToken)) {
                    if ($_SESSION['csrfModifyCommentToken'] == $csrfModifyCommentToken) {
                        $modifiedComment = $this->_commentManager->modifyCommentRequest($commentId, $author, $content);
                        if ($modifiedComment === false) {
                            $_SESSION['flash']['danger'] = 'Impossible de modifier le commentaire !';
                            header('Location: index.php?action=modifyCommentPage&id=' . $commentId);
                            exit();
                        } else {
                            $_SESSION['flash']['success'] = 'Votre commentaire sera validé dans les plus brefs délais !';
                            header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
                            exit();
                        }
                    } else {
                        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                        header('Location: index.php?action=modifyCommentPage&id=' . $commentId);
                    }
                }
            } else {
                $_SESSION['flash']['danger'] = 'Le champ est vide !';
                header('Location: index.php?action=modifyCommentPage&id=' . $commentId);
                exit();
            }
        } elseif (empty($comment) || $commentId <= 0) {
            $_SESSION['flash']['danger'] = 'Cet identifiant ne correspond à aucun commentaire !';
            $this->_errorsController->errors();
        }
    }
}