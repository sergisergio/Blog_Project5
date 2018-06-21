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

class SearchController
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
     * Function search
     * 
     * @param string $search          search
     * @param string $csrfSearchToken the token to try to avoid csrf
     * 
     * @return string
     */
    public function search($search, $csrfSearchToken)
    {
        $_SESSION['csrfSearchToken'] = $csrfSearchToken;
        if (isset($search) && $search != null) {
            if (isset($_SESSION['csrfSearchToken']) AND isset($csrfSearchToken) AND !empty($_SESSION['csrfSearchToken']) AND !empty($csrfSearchToken)) {
                if ($_SESSION['csrfSearchToken'] == $csrfSearchToken) {
                    $posts1 = $this->_postManager->getPosts(0, 5);
                    $postsAside = $this->_postManager->getPosts(0, 5);
                    $categories = $this->_categoryManager->getCategoryRequest();
                    $countSearchResults = $this->_postManager->countSearchRequest($search);
                    $nbResults = $countSearchResults->rowCount();
                    $searchResults = $this->_postManager->searchRequest($search);
                    $accessAdminToken = md5(time()*rand(1, 1000));
                    include 'views/frontend/modules/blog/search/searchresults.php';
                } else {
                    echo "Erreur de vérification";
                }
            }
        }
    }
}