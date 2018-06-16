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
use \Philippe\Blog\Lib\Entities\PostEntity;
use \Philippe\Blog\Lib\Model\PostManager;
use \Philippe\Blog\Lib\Entities\CategoryEntity;
use \Philippe\Blog\Lib\Model\CategoryManager;

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
    include 'App/frontend/Modules/Blog/Categories/categoryresults.php';
}