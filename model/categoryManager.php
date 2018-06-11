<?php

namespace Philippe\Blog\Model;
require_once "model/Manager.php";

use \Philippe\Blog\Model\Entities\CategoryEntity;
class categoryManager extends Manager
{
 
    /* ************ 1 . ADD CATEGORY* *******************/
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
    /* ************ 2 . GET CATEGORIES *******************/
    public function getCategoryRequest()
    {
        $dbProjet5 = $this->dbConnect();
        $getCategory = $dbProjet5->prepare('SELECT category_id, category FROM Category');
        $getCategory->execute();
        $categories = [];
        while ($data = $getCategory->fetch()){
        	$categories[] = new CategoryEntity($data);
        }
        $getCategory->closeCursor();
        return $categories;
    }
    /* ************ 10 . SELECT CATEGORY ******************/
    public function categoryPost()
    {
        $dbProjet5 = $this->dbConnect();
        $categoryPost = $dbProjet5->prepare('SELECT * FROM Category WHERE category_id = :id');
        $categoryPost->bindParam(':id', $categoryId);
        $categoryPost->execute();
        $cPost = $categoryPost->fetch();
        return $cPost;
    }
    
}