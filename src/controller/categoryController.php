<?php
/**
 * My own blog.
 *
 * Category Controller
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
use \Philippe\Blog\Src\Model\PostManager;
use \Philippe\Blog\Src\Entities\CategoryEntity;
use \Philippe\Blog\Src\Model\CategoryManager;

class categoryController
{
	/**
	 * Function categoryResults
	 * 
	 * @param int $categoryId the category's id
	 * 
	 * @return int
	 */
	function categoryResults($categoryId)
	{
	    $postManager = new PostManager();
	    $categoryManager = new CategoryManager();
	    $postsAside = $postManager->getPosts(0, 5);
	    $categories = $categoryManager->getCategoryRequest();
	    $cResults = $postManager->categoryResultsRequest($categoryId);
	    include 'views/frontend/Modules/Blog/Categories/categoryresults.php';
	}
}