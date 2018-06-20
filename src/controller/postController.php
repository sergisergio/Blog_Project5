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
namespace Philippe\Blog\Src\Controller;

use \Philippe\Blog\Src\Entities\PostEntity;
use \Philippe\Blog\Src\Entities\CommentEntity;
use \Philippe\Blog\Src\Entities\UserEntity;
use \Philippe\Blog\Src\Entities\CategoryEntity;
use \Philippe\Blog\Src\Model\UserManager;
use \Philippe\Blog\Src\Model\PostManager;
use \Philippe\Blog\Src\Model\CategoryManager;
use \Philippe\Blog\Src\Model\CommentManager;
use \Philippe\Blog\Src\Core\Session;

class PostController
{
    private $_postmanager;
    private $_userManager;
    private $_categoryManager;
    private $_commentManager;
    private $_logController;

    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_postManager = new PostManager();
        $this->_userManager = new UserManager();
        $this->_categoryManager = new CategoryManager();
        $this->_commentManager = new CommentManager();
        $this->_logController = new LogController();
    }

    /**
     * Show all blog posts
     * 
     * @return mixed
     */
    public function listPosts()
    {
        $postsTotal = $this->_postManager->countPosts();
        $postsPerPage = 5;
        $totalPages = ceil($postsTotal / $postsPerPage);

        if (isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page'] > 0 ) AND ($_GET['page'] <= $totalPages)) {
            $_GET['page'] = intval($_GET['page']);
            $currentPage = $_GET['page'];
        } else {
            $currentPage = 1;
        }
        $start = ($currentPage-1)*$postsPerPage;
        $posts = $this->_postManager->getPosts($start, $postsPerPage);
        $postsAside = $this->_postManager->getPosts(0, 5);
        $categories = $this->_categoryManager->getCategoryRequest();

        include 'views/frontend/Modules/Blog/blog.php';
    }
    /**
     * Show only one blog post
     * 
     * @param int $postId the post's id
     * 
     * @return mixed
     */
    public function listPost($postId)
    {
        $post = $this->_postManager->getPost($postId);
        $postsAside = $this->_postManager->getPosts(0, 5);
        $isPost = $this->_postManager->checkExistPost($postId);
        $categories = $this->_categoryManager->getCategoryRequest();

        if (isset($postId) && $postId > 0) {
            if ($isPost == false) {
                $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
                $this->_logController->errors();
            } else {
                $comment = $this->_commentManager->getComments($postId);
                $user = $this->_userManager->getUser($postId);
                $nbCount = $this->_commentManager->countCommentRequest($postId);
                include 'views/frontend/Modules/Blog/blog_post.php';
            }
        } else {
            $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
            $this->_logController->errors();
        }
    }
}