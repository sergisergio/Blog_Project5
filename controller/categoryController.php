<?php

use \Philippe\Blog\Model\Entities\PostEntity;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\Entities\CategoryEntity;
use \Philippe\Blog\Model\CategoryManager;

/**
 * Function categoryResults
 * 
 * @param categoryId $categoryId the category's id
 * 
 * @return [type]
 */
function categoryResults($categoryId)
{
    $postManager = new PostManager();
    $categoryManager = new CategoryManager();
    $postsAside = $postManager->getPosts(0, 5);
    $categories = $categoryManager->getCategoryRequest();
    $cResults = $postManager->categoryResultsRequest($categoryId);
    include 'view/frontend/pages/categoryresults.php';
}