<?php

use \Philippe\Blog\Model\Entities\PostEntity;
use \Philippe\Blog\Model\Entities\CommentEntity;
use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Core\Session;

/* **************** AJOUTER UN COMMENTAIRE **************/
function addComment($postId, $author, $content)
{
    $commentManager = new CommentManager();
    $session = new Session();

    if (isset($postId) && $postId > 0) {
        if (!empty($content)) {
            $affectedLines = $commentManager->postComment($postId, $author, $content);
            $session->addedComment();
            header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
            exit();
            if ($affectedLines === false) {
                $session->needsRegister();
                header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
                exit();
            }
        }
        else {
            $session->emptyContent();
            header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
            exit();
        }
    }
    else {
        $sessionManager->noIdPost();
    }
}
/* **************** PAGE POUR MODIFIER UN COMMENTAIRE ***/
function modifyCommentPage($commentId, $postId)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $userManager = new UserManager();
    $session = new Session();
    $comment = $commentManager->getComment($commentId);
    $post = $postManager->getPost($comment->getPostId());
    $posts1 = $postManager->getPosts(0, 5);
    if (empty($comment) || $commentId <= 0 ) {
        $session->noIdComment();
    }
    elseif (isset($commentId) && $commentId > 0) {
        if (($_SESSION['pseudo'] != $comment->getAuthor()) && ($_SESSION['autorisation'] == 0)) {
            $session->noRightsComments();
        }
        else {
            include 'view/frontend/pages/modifyCommentPage.php';
        }
    }
}
/* **************** SUPPRIMER UN COMMENTAIRE ************/
function deleteComment($commentId, $postId)
{

    $commentManager = new CommentManager();
    $session = new SessionManager();
    $success = $commentManager->deleteCommentRequest($commentId);
    if ($success === false) {
        throw new Exception('Impossible de supprimer le commentaire');
    }
    elseif (isset($commentId) && $commentId > 0) {
        $comment = $commentManager->getComment($commentId);
        $success = $commentManager->deleteCommentRequest($commentId);
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
    }
    elseif (empty($comment) || $commentId <= 0 ) {
        $session->noIdComment();
    }
}
/* **************** MODIFIER UN COMMENTAIRE *************/
function modifyComment($commentId, $author, $content, $postId)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($commentId);
    $session = new SessionManager();
    
    if (isset($commentId) && $commentId > 0) {
        if (!empty($content)) {
            $success = $commentManager->modifyCommentRequest($commentId, $author, $content);
            $session->addedComment();
            header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
            if ($success === false) {
                throw new Exception('Impossible de modifier le commentaire !');
            }
        }
        else {
            $session->emptyContent();
            header('Location: index.php?action=modifyCommentPage&id=' . $_GET['id']);
            exit();
        }
    }
    elseif (empty($comment) || $commentId <= 0 ) {
        $session->noIdComment();
    }
}