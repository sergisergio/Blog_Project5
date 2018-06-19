<?php
/**
 * My own blog.
 *
 * Search Controller
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
use \Philippe\Blog\Src\Model\CategoryManager;

class searchController 
{
    /**
     * Function search
     * 
     * @param string $search          search
     * @param string $csrfSearchToken the token to try to avoid csrf
     * 
     * @return string
     */
    function search($search, $csrfSearchToken)
    {
        $postManager = new PostManager();
        $categoryManager = new CategoryManager();
        $_SESSION['csrfSearchToken'] = $csrfSearchToken;
        if (isset($search) && $search != null) {
            if (isset($_SESSION['csrfSearchToken']) AND isset($csrfSearchToken) AND !empty($_SESSION['csrfSearchToken']) AND !empty($csrfSearchToken)) {
                if ($_SESSION['csrfSearchToken'] == $csrfSearchToken) {
                    $posts1 = $postManager->getPosts(0, 5);
                    $postsAside = $postManager->getPosts(0, 5);
                    $categories = $categoryManager->getCategoryRequest();
                    $countSearchResults = $postManager->countSearchRequest($search);
                    $nbResults = $countSearchResults->rowCount();
                    $searchResults = $postManager->searchRequest($search);
                    include 'views/frontend/Modules/Blog/Search/searchresults.php';
                } else {
                    echo "Erreur de vérification";
                }
            }
        }
    }
}