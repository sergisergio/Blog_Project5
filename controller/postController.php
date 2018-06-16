<?php
/**
 * My own blog.
 *
 * Post Controller
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
use \Philippe\Blog\Lib\Entities\PostEntity;
use \Philippe\Blog\Lib\Entities\CommentEntity;
use \Philippe\Blog\Lib\Entities\UserEntity;
use \Philippe\Blog\Lib\Entities\CategoryEntity;
use \Philippe\Blog\Lib\Model\UserManager;
use \Philippe\Blog\Lib\Model\PostManager;
use \Philippe\Blog\Lib\Model\CategoryManager;
use \Philippe\Blog\Lib\Model\CommentManager;
use \Philippe\Blog\Lib\Core\Session;

/**
 * Show all blog posts
 * 
 * @return mixed
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

    include 'App/frontend/Modules/Blog/blog.php';
}
/**
 * Show only one blog post
 * 
 * @param int $postId the post's id
 * 
 * @return mixed
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
            $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
            errors();
        } else {
            $comment = $commentManager->getComments($postId);
            $user = $userManager->getUser($postId);
            $nbCount = $commentManager->countCommentRequest($postId);
            include 'App/frontend/Modules/Blog/blog_post.php';
        }
    } else {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
        errors();
    }
}