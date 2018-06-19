<?php
/**
 * My own blog
 *
 * Router
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
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

class Router 
{
	private $defaultController;
	private $adminController;
	private $postController;
	private $commentController;
	private $logController;
	private $registerController;
	private $contactController;
	private $errorsController;
	private $searchController;
	private $profileController;
	private $categoryController;

	public function __construct() {
		$this->defaultController = new defaultController();
		$this->postController = new postController();
		$this->commentController = new commentController();
		$this->logController = new logController();
		$this->registerController = new registerController();
		$this->contactController = new contactController();
		$this->searchController = new searchController();
		$this->profileController = new profileController();
		$this->errorsController = new errorsController();
		$this->categoryController = new categoryController();
		$this->adminController = new adminController();
	}

	public function run()
	{
		try {
		    if (isset($_GET['action'])) {
		        if ($_GET['action'] == 'blog') {
		            $this->postController->listPosts();
		        } elseif ($_GET['action'] == 'blogpost') {
		            $this->postController->listPost($_GET['id']);
		        } elseif ($_GET['action'] == 'addcomment') {
		            $this->commentController->addComment($_GET['id'], $_SESSION['id'], $_POST['content'], $_POST['token']);
		        } elseif ($_GET['action'] == 'modifyCommentPage') {
		            $this->commentController->modifyCommentPage($_GET['id'], $_GET['postId']);
		        } elseif ($_GET['action'] == 'deleteComment') {
		            $this->commentController->deleteComment($_GET['id'], $_GET['postId'], $_GET['token']);
		        } elseif ($_GET['action'] == 'modifyComment') {
		            $this->commentController->modifyComment($_GET['id'], $_SESSION['id'], $_POST['content'], $_GET['postId'], $_POST['token']);
		        } elseif ($_GET['action'] == 'loginPage') {
		            $this->logController->loginPage();
		        } elseif ($_GET['action'] == 'login') {
		            $this->logController->login($_POST['pseudo'], $_POST['passe'], $_SERVER['REMOTE_ADDR'], $_POST['token'], $_POST['remember']);
		        } elseif ($_GET['action'] == 'logout') {
		            $this->logController->logout();
		        } elseif ($_GET['action'] == 'forgetPasswordPage') {
		            $this->logController->forgetPasswordPage();
		        } elseif ($_GET['action'] == 'forgetPassword') {
		            $this->logController->forgetPassword($_POST['email'], $_POST['token']);
		        } elseif ($_GET['action'] == 'changePasswordPage') {
		            $this->logController->changePasswordPage($_GET['id'], $_GET['token']);
		        } elseif ($_GET['action'] == 'changePassword') {
		            $this->logController->changePassword($_POST['userId'], $_POST['passe'], $_POST['token']);
		        } elseif ($_GET['action'] == 'signupPage') {
		            $this->registerController->signupPage();
		        } elseif ($_GET['action'] == 'addUser') {
		            $this->registerController->addUser($_POST['pseudo'], $_POST['email'], $_POST['passe'], $_POST['passe2'], $_POST['token']); 
		        } elseif ($_GET['action'] == 'confirmRegistration') {
		            $this->registerController->confirmRegistration($_GET['id'], $_GET['token']); 
		        } elseif ($_GET['action'] == 'contact') {
		            $this->contactController->contact($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'], $_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
		        } elseif ($_GET['action'] == 'search') {
		            $this->searchController->search($_POST['search'], $_POST['token']);
		        } elseif ($_GET['action'] == 'profilePage') {
		            $this->profileController->profilePage($_SESSION['id']);
		        } elseif ($_GET['action'] == 'deleteAccount') {
		            $this->profileController->deleteAccount($_SESSION['id'], $_POST['token']);   
		        } elseif ($_GET['action'] == 'modifyProfile') {
		            $this->profileController->modifyProfile($_POST['userId'], $_FILES['avatar']['name'], $_POST['first_name'], $_POST['name'], $_POST['email'], $_POST['description'], $_POST['token']);
		        } elseif ($_GET['action'] == 'publicProfile') {
		            if (isset($_GET['id'])) {
		                $this->profileController->publicProfile($_GET['id']);
		            }
		        } elseif ($_GET['action'] == 'noAdmin') {
		            $this->errorsController->noAdmin();
		        } elseif ($_GET['action'] == 'categoryresults') {
		            $this->categoryController->categoryResults($_GET['id']);
		        } elseif ($_GET['action'] == 'admin') {
		            $this->adminController->admin($_GET['token']);
		        } elseif ($_GET['action'] == 'manage_posts') {
		            $this->adminController->managePosts();
		        } elseif ($_GET['action'] == 'manage_comments') {
		            $this->adminController->manageComments();
		        } elseif ($_GET['action'] == 'addpost') {
		            $this->adminController->addPost($_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content'], $_FILES['file_extension']['name'], $_POST['category'], $_POST['token']);
		        } elseif ($_GET['action'] == 'modifyPostPage') {
		            $this->adminController->modifyPostPage($_GET['id']);
		        } elseif ($_GET['action'] == 'modifyPost') {
		            $this->adminController->modifyPost($_GET['id'], $_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content'], $_POST['token']);
		        } elseif ($_GET['action'] == 'deletePost') {
		            $this->adminController->deletePost($_GET['id'], $_GET['token']);
		        } elseif ($_GET['action'] == 'validateComment') {
		            $this->adminController->validateComment($_GET['id'], $_GET['token']);
		        } elseif ($_GET['action'] == 'adminDeleteComment') {
		            $this->adminController->adminDeleteComment($_GET['id'], $_GET['token']);
		        } elseif ($_GET['action'] == 'manage_users') {
		            $this->adminController->manageUsers();
		        } elseif ($_GET['action'] == 'giveAdminRights') {
		            $this->adminController->giveAdminRights($_GET['id'], $_GET['token']);
		        } elseif ($_GET['action'] == 'cancelAdminRights') {
		            $this->adminController->stopAdminRights($_GET['id'], $_GET['token']);
		        } elseif ($_GET['action'] == 'deleteUser') {
		            $this->adminController->deleteUser($_GET['id'], $_GET['token']);
		        } elseif ($_GET['action'] == 'addcategory') {
		            $this->adminController->addCategory($_POST['category'], $_POST['token']);
		        }
	    	} else { 
	        	$this->defaultController->home();
	    	}
		} catch(Exception $e) {
	    	echo 'Erreur : ' . $e->getMessage();
		}
	}
}