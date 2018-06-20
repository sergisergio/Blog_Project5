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

class CategoryController
{
    private $_postManager;
    private $_categoryManager;

    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_postManager = new PostManager();
        $this->_categoryManager = new CategoryManager();
    }
    /**
     * Function categoryResults
     * 
     * @param int $categoryId the category's id
     * 
     * @return int
     */
    public function categoryResults($categoryId)
    {
        $postsAside = $this->_postManager->getPosts(0, 5);
        $categories = $this->_categoryManager->getCategoryRequest();
        $cResults = $this->_postManager->categoryResultsRequest($categoryId);
        include 'views/frontend/Modules/Blog/Categories/categoryresults.php';
    }
}