<?php

use \Philippe\Blog\Model\Entities\PostEntity;
use \Philippe\Blog\Model\Entities\CommentEntity;
use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Model\SessionManager;

/* ***************** TOUS LES BLOG POSTS *****************/
function listPosts()
{
    $postManager = new PostManager();
    $postsTotal = $postManager->countPosts();
    $postsPerPage = 5;
    $totalPages = ceil($postsTotal / $postsPerPage);

    if(isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page'] > 0 ) AND ($_GET['page'] <= $totalPages)) {
        $_GET['page'] = intval($_GET['page']);
        $currentPage = $_GET['page'];
    }
    else {
        $currentPage = 1;
    }
    $start = ($currentPage-1)*$postsPerPage;
    $posts = $postManager->getPosts($start, $postsPerPage);
    $posts1 = $postManager->getPosts(0, 5);

    include 'view/frontend/pages/blog.php';
}
/* **************** AFFICHER UN SEUL BLOG POST **********/
function listPost($postId)
{

    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $userManager = new UserManager();
    $sessionManager = new SessionManager();

    $post = $postManager->getPost($postId);
    $posts1 = $postManager->getPosts(0, 5);

    if (isset($postId) && $postId > 0 && (!empty($post))) {
        
        $comments = $commentManager->getComments($postId);
        $user = $userManager->getUser($postId);
        $nbCount = $commentManager->countCommentRequest($postId);
        include 'view/frontend/pages/blog_post.php';
    }   
    else {
        $sessionManager->noIdPost();
    }
}