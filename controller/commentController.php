<?php

use \Philippe\Blog\Model\Entities\PostEntity;
use \Philippe\Blog\Model\Entities\CommentEntity;
use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Model\SessionManager;

/* **************** AJOUTER UN COMMENTAIRE **************/
function addComment($postId, $author, $content)
{
    $commentManager = new CommentManager();
    $sessionManager = new SessionManager();

    if (isset($postId) && $postId > 0) {
        if (!empty($content)) {
            $affectedLines = $commentManager->postComment($postId, $author, $content);
            $sessionManager->addedComment();
            header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
            exit();
            if ($affectedLines === false) {
                $sessionManager->needsRegister();
                header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
                exit();
            }
        }
        else {
            $sessionManager->emptyContent();
            header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
            exit();
        }
    }
    else {
        $sessionManager->noIdPost();
    }
}
/* **************** PAGE POUR MODIFIER UN COMMENTAIRE ***/
function modifyCommentPage($commentId)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $userManager = new UserManager();
    $sessionManager = new SessionManager();
    $comment = $commentManager->getComment($commentId);
    $post = $postManager->getPost($comment['post_id']);
    $posts1 = $postManager->getPosts(0, 5);
    if (empty($comment) || $commentId <= 0 ) {
        $sessionManager->noIdComment();
    }
    elseif (isset($commentId) && $commentId > 0) {
        if (($_SESSION['pseudo'] != $comment['author']) && ($_SESSION['autorisation'] == 0)) {
            $sessionManager->noRightsComments();
        }
        else {
            include 'view/frontend/pages/modifyCommentPage.php';
        }
    }
}
/* **************** SUPPRIMER UN COMMENTAIRE ************/
function deleteComment($commentId)
{

    $commentManager = new CommentManager();
    $sessionManager = new SessionManager();
    if ($success === false) {
        throw new Exception('Impossible de supprimer le commentaire');
    }
    elseif (isset($commentId) && $commentId > 0) {
        $comment = $commentManager->getComment($commentId);
        $success = $commentManager->deleteCommentRequest($commentId);
        header('Location: index.php?action=blogpost&id=' . $comment['post_id'] . '#comments');
    }
    elseif (empty($comment) || $commentId <= 0 ) {
        $sessionManager->noIdComment();
    }
}
/* **************** MODIFIER UN COMMENTAIRE *************/
function modifyComment($commentId, $author, $content)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($commentId);
    $sessionManager = new SessionManager();
    if (isset($commentId) && $commentId > 0) {
        if (!empty($content)) {
            $success = $commentManager->modifyCommentRequest($commentId, $author, $content);
            $sessionManager->addedComment();
            header('Location: index.php?action=blog');
            if ($success === false) {
                throw new Exception('Impossible de modifier le commentaire !');
            }
        }
        else {
            $sessionManager->emptyContent();
            header('Location: index.php?action=modifyCommentPage&id=' . $_GET['id']);
            exit();
        }
    }
    elseif (empty($comment) || $commentId <= 0 ) {
        $sessionManager->noIdComment();
    }
}