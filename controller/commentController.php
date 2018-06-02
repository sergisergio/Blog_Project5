<?php

use \Philippe\Blog\Model\Entities\PostEntity;
use \Philippe\Blog\Model\Entities\CommentEntity;
use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Core\Session;

/* **************** ADD A COMMENT **************/
function addComment($postId, $author, $content)
{
    $commentManager = new CommentManager();
    $session = new Session();

    if (isset($postId) && $postId > 0) {
        if (!empty($content)) {
            $affectedLines = $commentManager->postComment($postId, $author, $content);
            $session->addedComment($postId);
                
            if ($affectedLines === false) {
                $session->needsRegister($postId);
            }
        }
        else 
        {
            $session->emptyContent($postId);
        }
    }
    else {
        $sessionManager->noIdPost();
    }
}
/* **************** MODIFY COMMENT PAGE ********/
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
/* **************** DELETE A COMMENT ***********/
function deleteComment($commentId, $postId)
{
    $commentManager = new CommentManager();
    $session = new Session();
    $success = $commentManager->deleteCommentRequest($commentId);

    if ($success === false) {
        $session->nonDeletedComment($postId);
    }
    elseif (isset($commentId) && $commentId > 0) {
        $comment = $commentManager->getComment($commentId);
        $success = $commentManager->deleteCommentRequest($commentId);
        $session->deletedComment($postId);
    }
    elseif (empty($comment) || $commentId <= 0 ) {
        $session->noIdComment();
    }
}
/* **************** MODIFY A COMMENT ***********/
function modifyComment($commentId, $author, $content, $postId)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($commentId);
    $session = new Session();
        
    if (isset($commentId) && $commentId > 0) {
        if (!empty($content)) {
            $success = $commentManager->modifyCommentRequest($commentId, $author, $content);
                

            if ($success === false) {
                $session->modifyCommentError($commentId);
            }
            else
            {
                $session->addedComment($postId);
            }
        }
        else 
        {
            $session->emptyContent();
        }
    }
    elseif (empty($comment) || $commentId <= 0 ) {
        $session->noIdComment();
    }
}