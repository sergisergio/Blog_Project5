<?php
/**
 * My own blog
 *
 * Router
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
use Philippe\Blog\Src\Controller\DefaultController;
use Philippe\Blog\Src\Controller\PostController;
use Philippe\Blog\Src\Controller\CommentController;
use Philippe\Blog\Src\Controller\LogController;
use Philippe\Blog\Src\Controller\RegisterController;
use Philippe\Blog\Src\Controller\ContactController;
use Philippe\Blog\Src\Controller\SearchController;
use Philippe\Blog\Src\Controller\ProfileController;
use Philippe\Blog\Src\Controller\ErrorsController;
use Philippe\Blog\Src\Controller\CategoryController;
use Philippe\Blog\Src\Controller\AdminController;
use Philippe\Blog\Src\Controller\AdminPostController;
use Philippe\Blog\Src\Controller\AdminCommentController;
use Philippe\Blog\Src\Controller\AdminUserController;
/**
 *  Class Router
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class Router
{
    private $_defaultController;
    private $_adminController;
    private $_adminPostController;
    private $_adminCommentController;
    private $_adminUserController;
    private $_postController;
    private $_commentController;
    private $_logController;
    private $_registerController;
    private $_contactController;
    private $_errorsController;
    private $_searchController;
    private $_profileController;
    private $_categoryController;

    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_defaultController = new DefaultController();
        $this->_postController = new PostController();
        $this->_commentController = new CommentController();
        $this->_logController = new LogController();
        $this->_registerController = new RegisterController();
        $this->_contactController = new ContactController();
        $this->_searchController = new SearchController();
        $this->_profileController = new ProfileController();
        $this->_errorsController = new ErrorsController();
        $this->_categoryController = new CategoryController();
        $this->_adminController = new AdminController();
        $this->_adminPostController = new AdminPostController();
        $this->_adminCommentController = new AdminCommentController();
        $this->_adminUserController = new AdminUserController();
    }
    /**
     * Function run
     * 
     * @return mixed
     */
    public function run()
    {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'blog') {
                    $this->_postController->listPosts();
                } elseif ($_GET['action'] == 'blogpost') {
                    $this->_postController->listPost($_GET['id']);
                } elseif ($_GET['action'] == 'addcomment') {
                    $this->_commentController->addComment($_GET['id'], $_SESSION['id'], $_POST['content'], $_POST['token']);
                } elseif ($_GET['action'] == 'modifyCommentPage') {
                    $this->_commentController->modifyCommentPage($_GET['id'], $_GET['postId']);
                } elseif ($_GET['action'] == 'deleteComment') {
                    $this->_commentController->deleteComment($_GET['id'], $_GET['postId'], $_GET['token']);
                } elseif ($_GET['action'] == 'modifyComment') {
                    $this->_commentController->modifyComment($_GET['id'], $_SESSION['id'], $_POST['content'], $_GET['postId'], $_POST['token']);
                } elseif ($_GET['action'] == 'loginPage') {
                    $this->_logController->loginPage();
                } elseif ($_GET['action'] == 'login') {
                    $this->_logController->login($_POST['pseudo'], $_POST['passe'], $_SERVER['REMOTE_ADDR'], $_POST['token']);
                } elseif ($_GET['action'] == 'logout') {
                    $this->_logController->logout();
                } elseif ($_GET['action'] == 'forgetPasswordPage') {
                    $this->_logController->forgetPasswordPage();
                } elseif ($_GET['action'] == 'forgetPassword') {
                    $this->_logController->forgetPassword($_POST['email'], $_POST['token']);
                } elseif ($_GET['action'] == 'changePasswordPage') {
                    $this->_logController->changePasswordPage($_GET['id'], $_GET['token']);
                } elseif ($_GET['action'] == 'changePassword') {
                    $this->_logController->changePassword($_POST['userId'], $_POST['passe'], $_POST['token']);
                } elseif ($_GET['action'] == 'signupPage') {
                    $this->_registerController->signupPage();
                } elseif ($_GET['action'] == 'addUser') {
                    $this->_registerController->addUser($_POST['pseudo'], $_POST['email'], $_POST['passe'], $_POST['passe2'], $_POST['token']); 
                } elseif ($_GET['action'] == 'confirmRegistration') {
                    $this->_registerController->confirmRegistration($_GET['id'], $_GET['token']); 
                } elseif ($_GET['action'] == 'contact') {
                    $this->_contactController->contact($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'], $_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
                } elseif ($_GET['action'] == 'search') {
                    $this->_searchController->search($_POST['search'], $_POST['token']);
                } elseif ($_GET['action'] == 'profilePage') {
                    $this->_profileController->profilePage($_SESSION['id']);
                } elseif ($_GET['action'] == 'deleteAccount') {
                    $this->_profileController->deleteAccount($_SESSION['id'], $_POST['token']);   
                } elseif ($_GET['action'] == 'modifyProfile') {
                    $this->_profileController->modifyProfile($_POST['userId'], $_FILES['avatar']['name'], $_POST['first_name'], $_POST['name'], $_POST['email'], $_POST['description'], $_POST['token']);
                } elseif ($_GET['action'] == 'publicProfile') {
                    $this->_profileController->publicProfile($_GET['id']);
                } elseif ($_GET['action'] == 'noAdmin') {
                    $this->_errorsController->noAdmin();
                } elseif ($_GET['action'] == 'categoryresults') {
                    $this->_categoryController->categoryResults($_GET['id']);
                } elseif ($_GET['action'] == 'admin') {
                    $this->_adminController->admin($_GET['token']);
                } elseif ($_GET['action'] == 'manage_posts') {
                    $this->_adminPostController->managePosts();
                } elseif ($_GET['action'] == 'manage_comments') {
                    $this->_adminCommentController->manageComments();
                } elseif ($_GET['action'] == 'addpost') {
                    $this->_adminPostController->addPost($_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content'], $_FILES['file_extension']['name'], $_POST['category'], $_POST['token']);
                } elseif ($_GET['action'] == 'modifyPostPage') {
                    $this->_adminPostController->modifyPostPage($_GET['id']);
                } elseif ($_GET['action'] == 'modifyPost') {
                    $this->_adminPostController->modifyPost($_GET['id'], $_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content'], $_POST['token']);
                } elseif ($_GET['action'] == 'deletePost') {
                    $this->_adminPostController->deletePost($_GET['id'], $_GET['token']);
                } elseif ($_GET['action'] == 'validateComment') {
                    $this->_adminCommentController->validateComment($_GET['id'], $_GET['token']);
                } elseif ($_GET['action'] == 'adminDeleteComment') {
                    $this->_adminCommentController->adminDeleteComment($_GET['id'], $_GET['token']);
                } elseif ($_GET['action'] == 'manage_users') {
                    $this->_adminUserController->manageUsers();
                } elseif ($_GET['action'] == 'giveAdminRights') {
                    $this->_adminController->giveAdminRights($_GET['id'], $_GET['token']);
                } elseif ($_GET['action'] == 'cancelAdminRights') {
                    $this->_adminUserController->stopAdminRights($_GET['id'], $_GET['token']);
                } elseif ($_GET['action'] == 'deleteUser') {
                    $this->_adminUserController->deleteUser($_GET['id'], $_GET['token']);
                } elseif ($_GET['action'] == 'addcategory') {
                    $this->_categoryController->addCategory($_POST['category'], $_POST['token']);
                }
            } else { 
                $this->_defaultController->home();
            }
        } catch(Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}