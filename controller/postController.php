<?php

use \Philippe\Blog\Model\Entities\PostEntity;
use \Philippe\Blog\Model\Entities\CommentEntity;
use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\Entities\CategoryEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CategoryManager;
use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Core\Session;

/**
 * Function listsPosts
 * 
 * @return [type]
 */
function listPosts()
{
    $postManager = new PostManager();
    $categoryManager = new CategoryManager();
    $postsTotal = $postManager->countPosts();
    $postsPerPage = 5;
    $totalPages = ceil($postsTotal / $postsPerPage);

    if (isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page'] > 0 ) AND ($_GET['page'] <= $totalPages)) {
        $_GET['page'] = intval($_GET['page']);
        $currentPage = $_GET['page'];
    } else {
        $currentPage = 1;
    }
    $start = ($currentPage-1)*$postsPerPage;
    $posts = $postManager->getPosts($start, $postsPerPage);
    $postsAside = $postManager->getPosts(0, 5);
    $categories = $categoryManager->getCategoryRequest();

    include 'view/frontend/pages/blog.php';
}
/**
 * Function listPost
 * 
 * @param postId $postId the post's id
 * 
 * @return [type]
 */
function listPost($postId)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $userManager = new UserManager();
    $categoryManager = new CategoryManager();
    $session = new Session();

    $post = $postManager->getPost($postId);
    $postsAside = $postManager->getPosts(0, 5);
    $isPost = $postManager->checkExistPost($postId);
    $categories = $categoryManager->getCategoryRequest();

    if (isset($postId) && $postId > 0) {
        if ($isPost == false) {
            $session->noIdPost();
        } else {
            $comment = $commentManager->getComments($postId);
            $user = $userManager->getUser($postId);
            $nbCount = $commentManager->countCommentRequest($postId);
            include 'view/frontend/pages/blog_post.php';
        }
    } else {
        $session->noIdPost();
    }
}