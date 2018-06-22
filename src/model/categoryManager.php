<?php
/**
 * My own blog.
 *
 * Category manager
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
namespace Philippe\Blog\Src\Model;

require_once "src/model/manager.php";
use \Philippe\Blog\Src\Entities\CategoryEntity;
/**
 *  Class CategoryManager
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class CategoryManager extends Manager
{
    private $category;
    /**
     * Add a category
     * 
     * @param string $category category
     *
     * @return string 
     */
    public function addCategoryRequest($category)
    {
        $dbProjet5 = $this->dbConnect();
        $addCategory = $dbProjet5->prepare('INSERT INTO Category(category) VALUES(:category)');
        $addCategory->bindParam(':category', $category);
        $addCategory->execute();
        $data = $addCategory->fetch();
        $addedCategory = new CategoryEntity($data);
        return $addedCategory;
    }
    /**
     * Get a category
     * 
     * @return mixed
     */
    public function getCategoryRequest()
    {
        $dbProjet5 = $this->dbConnect();
        $getCategory = $dbProjet5->prepare('SELECT category_id, category FROM Category');
        $getCategory->execute();
        $categories = [];
        while ($data = $getCategory->fetch()) {
            $categories[] = new CategoryEntity($data);
        }
        $getCategory->closeCursor();
        return $categories;
    }
    /**
     * Find Posts where category is ...
     * 
     * @return mixed
     */
    public function categoryPost()
    {
        $dbProjet5 = $this->dbConnect();
        $categoryPost = $dbProjet5->prepare('SELECT * FROM Category WHERE category_id = :id');
        $categoryPost->bindParam(':id', $categoryId);
        $categoryPost->execute();
        $cPost = $categoryPost->fetch();
        return $cPost;
    }
    /**
     * Function existCategory
     * 
     * @param string $category category
     * 
     * @return string
     */
    public function existCategory($category)
    {
        $dbProjet5 = $this->dbConnect();
        $existCategory = $dbProjet5->prepare('SELECT category FROM Category WHERE category = :category');
        $existCategory->bindParam(':category', $category);
        $existCategory->execute();
        $userCategory = $existCategory->fetch();
        return $userCategory;
    }
}