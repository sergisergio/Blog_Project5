<?php

use \Philippe\Blog\Model\Entities\PostEntity;
use \Philippe\Blog\Model\Entities\CommentEntity;
use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Core\Session;

/* **************** ADD A COMMENT **************/
function addComment($postId, $author, $content, $csrfAddCommentToken)
{
    $commentManager = new CommentManager();
    $session = new Session();
    

    if (isset($postId) && $postId > 0) 
    {
        if (!empty($content)) 
        {
            if (isset($_SESSION['csrfAddCommentToken']) AND isset($csrfAddCommentToken) AND !empty($_SESSION['csrfAddCommentToken']) AND !empty($csrfAddCommentToken)) 
            {
                if ($_SESSION['csrfAddCommentToken'] == $csrfAddCommentToken) 
                {
                    $addedComment = $commentManager->postComment($postId, $author, $content);
                    $session->addedComment($postId);
                    if ($affectedLines === false) 
                    {
                        $session->needsRegister($postId);
                    }
                }
                else 
                {
                    echo "Erreur de vérification";
                }
            }
        }
        else 
        {
            $session->csrfAddPost($postId);
        }
    }
    else 
    {
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
    $postsAside = $postManager->getPosts(0, 5);
    $isComment = $commentManager->checkExistComment($commentId);
    $isPost = $postManager->checkExistPost($postId);

    if (empty($comment) || $commentId <= 0 ) {
        $session->noIdComment();
    }
    elseif ($isComment == false){
        $session->noIdComment();
    }
    elseif ($isPost == false){
        $session->noIdPost();
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
function deleteComment($commentId, $postId, $csrfDeleteCommentToken)
{
    $commentManager = new CommentManager();
    $session = new Session();
    $_SESSION['csrfDeleteCommentToken'] = $csrfDeleteCommentToken;
    if (isset($_SESSION['csrfDeleteCommentToken']) AND isset($csrfDeleteCommentToken) AND !empty($_SESSION['csrfDeleteCommentToken']) AND !empty($csrfDeleteCommentToken)) 
    {
        if ($_SESSION['csrfDeleteCommentToken'] == $csrfDeleteCommentToken) 
        {
            if (isset($commentId) && $commentId > 0) 
            {
                $comment = $commentManager->getComment($commentId);
                $deletedComment = $commentManager->deleteCommentRequest($commentId);         
                if ($deletedComment === false) 
                {
                    $session->nonDeletedComment($postId);
                }
                else
                {
                    $session->deletedComment($postId);
                }
            }
            elseif (empty($comment) || $commentId <= 0 ) 
            {
                $session->noIdComment();
            }
        }
        else 
        {
            $session->csrfDeleteComment($postId);
        }
    }
}
/* **************** MODIFY A COMMENT ***********/
function modifyComment($commentId, $author, $content, $postId, $csrfModifyCommentToken)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($commentId);
    $session = new Session();

    if (isset($commentId) && $commentId > 0) 
    {
        if (!empty($content)) 
        {
            if (isset($_SESSION['csrfModifyCommentToken']) AND isset($csrfModifyCommentToken) AND !empty($_SESSION['csrfModifyCommentToken']) AND !empty($csrfModifyCommentToken)) 
            {
                if ($_SESSION['csrfModifyCommentToken'] == $csrfModifyCommentToken) 
                {
                    $modifiedComment = $commentManager->modifyCommentRequest($commentId, $author, $content);
                    if ($modifiedComment === false) 
                    {
                        $session->modifyCommentError($commentId);
                    }
                    else
                    {
                        $session->addedComment($postId);
                    }
                }
                else 
                {
                    $session->csrfModifyCommentError($commentId);
                }
            }
        }
        else 
        {
            $session->emptyContent();
        }
    }
    elseif (empty($comment) || $commentId <= 0) 
    {
        $session->noIdComment();
    }
}