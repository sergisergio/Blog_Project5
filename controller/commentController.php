<?php

use \Philippe\Blog\Model\Entities\PostEntity;
use \Philippe\Blog\Model\Entities\CommentEntity;
use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Core\Session;

/**
 * Function addComment
 * 
 * @param postId              $postId              the post's id
 * @param author              $author              the author
 * @param content             $content             the content
 * @param csrfAddCommentToken $csrfAddCommentToken the token to tryto avoid csrf
 *
 * @return [<description>]
 */
function addComment($postId, $author, $content, $csrfAddCommentToken)
{
    $commentManager = new CommentManager();
    $session = new Session();
    
    $_SESSION['csrfAddPostToken'] = $csrfAddPostToken; 
    if (isset($postId) && $postId > 0) {
        if (!empty($content)) {
            if (isset($_SESSION['csrfAddCommentToken']) AND isset($csrfAddCommentToken) AND !empty($_SESSION['csrfAddCommentToken']) AND !empty($csrfAddCommentToken)) {
                if ($_SESSION['csrfAddCommentToken'] == $csrfAddCommentToken) {
                    $addedComment = $commentManager->postComment($postId, $author, $content);
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
        errors();
    }
}
/**
 * Function modifyCommentPage
 * 
 * @param commentId $commentId the comment's id
 * @param postId    $postId    the post's id
 * 
 * @return [type]
 */
function modifyCommentPage($commentId, $postId)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $userManager = new UserManager();
    $session = new Session();
    $comment = $commentManager->getComment($commentId);
    $post = $postManager->getPost($comment->getPostId());
    $postsAside = $postManager->getPosts(0, 5);
    $isComment = $commentManager->checkExistComment($commentId);
    $isPost = $postManager->checkExistPost($postId);

    if (empty($comment) || $commentId <= 0 ) {
        $_SESSION['flash']['danger'] = 'Cet identifiant ne correspond à aucun commentaire !';
        errors();
    } elseif ($isComment == false) {
        $_SESSION['flash']['danger'] = 'Cet identifiant ne correspond à aucun commentaire !';
        errors();
    } elseif ($isPost == false) {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
        errors();
    } elseif (isset($commentId) && $commentId > 0) {
        if (($_SESSION['pseudo'] != $comment->getAuthor()) && ($_SESSION['autorisation'] == 0)) {
            $_SESSION['flash']['danger'] = 'Vous pouvez seulement modifier vos propres commentaires !';
            errors();
        } else {
            include 'view/frontend/pages/modifyCommentPage.php';
        }
    }
}
/**
 * Function deleteComment
 * 
 * @param commentId              $commentId              the comment's id
 * @param postId                 $postId                 the post's id
 * @param csrfDeleteCommentToken $csrfDeleteCommentToken the token to try to avoid csrf
 * 
 * @return [type]
 */
function deleteComment($commentId, $postId, $csrfDeleteCommentToken)
{
    $commentManager = new CommentManager();
    $session = new Session();
    $_SESSION['csrfDeleteCommentToken'] = $csrfDeleteCommentToken;
    if (isset($_SESSION['csrfDeleteCommentToken']) AND isset($csrfDeleteCommentToken) AND !empty($_SESSION['csrfDeleteCommentToken']) AND !empty($csrfDeleteCommentToken)) {
        if ($_SESSION['csrfDeleteCommentToken'] == $csrfDeleteCommentToken) {
            if (isset($commentId) && $commentId > 0) {
                $comment = $commentManager->getComment($commentId);
                $deletedComment = $commentManager->deleteCommentRequest($commentId);         
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
 * @param commentId              $commentId              the comment's id
 * @param author                 $author                 the author
 * @param content                $content                the content
 * @param postId                 $postId                 the post's id
 * @param csrfModifyCommentToken $csrfModifyCommentToken the token to try to avoid csrf
 * 
 * @return [type]
 */
function modifyComment($commentId, $author, $content, $postId, $csrfModifyCommentToken)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($commentId);
    $session = new Session();

    $_SESSION['csrfModifyCommentToken'] = $csrfModifyCommentToken; 
    if (isset($commentId) && $commentId > 0) {
        if (!empty($content)) {
            if (isset($_SESSION['csrfModifyCommentToken']) AND isset($csrfModifyCommentToken) AND !empty($_SESSION['csrfModifyCommentToken']) AND !empty($csrfModifyCommentToken)) {
                if ($_SESSION['csrfModifyCommentToken'] == $csrfModifyCommentToken) {
                    $modifiedComment = $commentManager->modifyCommentRequest($commentId, $author, $content);
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
        errors();
    }
}