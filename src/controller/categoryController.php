<?php
/**
 * My own blog.
 *
 * Category Controller
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
namespace Philippe\Blog\Src\Controller;

use \Philippe\Blog\Src\Model\PostManager;
use \Philippe\Blog\Src\Model\CategoryManager;
use \Philippe\Blog\Src\Controller\AdminPostController;
/**
 *  Class CategoryController
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class CategoryController
{
    private $_postManager;
    private $_categoryManager;
    private $_adminPostController;

    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_postManager = new PostManager();
        $this->_categoryManager = new CategoryManager();
        $this->_adminPostController = new AdminPostController();
    }
    /**
     * Add a category
     * 
     * @param string $category             the post's category
     * @param string $csrfAddCategoryToken the token to try to avoid csrf
     *
     * @return mixed
     */
    public function addCategory($category, $csrfAddCategoryToken)
    {
        $_SESSION['csrfAddCategoryToken'] = $csrfAddCategoryToken;
        if (isset($_SESSION['csrfAddCategoryToken']) AND isset($csrfAddCategoryToken) AND !empty($_SESSION['csrfAddCategoryToken']) AND !empty($csrfAddCategoryToken)) {
            $userCategory = $this->_categoryManager->existCategory($category);
            if ($userCategory) {
                $_SESSION['flash']['danger'] = 'Cette catégorie a déjà été ajoutée !';
                $this->_adminPostController->managePosts();
            } elseif ($_SESSION['csrfAddCategoryToken'] == $csrfAddCategoryToken) {
                if (!empty($category)) {
                    $this->_categoryManager->addCategoryRequest($category);
                    if ($this->_categoryManager === false) {
                        $_SESSION['flash']['danger'] = 'Impossible d\'ajouter cette catégorie !';
                        $this->_adminPostController->managePosts();
                    } else {
                        $_SESSION['flash']['success'] = 'La catégorie a bien été ajoutée !';
                        $this->_adminPostController->managePosts();
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Le champ est vide !';
                    $this->_adminPostController->managePosts();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                $this->_adminPostController->managePosts();
            }
        } 
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
        $accessAdminToken = md5(time()*rand(1, 1000));
        $csrfSearchToken = md5(time()*rand(1, 1000));
        $postsAside = $this->_postManager->getPosts(0, 5);
        $categories = $this->_categoryManager->getCategoryRequest();
        $cResults = $this->_postManager->categoryResultsRequest($categoryId);
        include 'views/frontend/modules/blog/categories/categoryresults.php';
    }
}