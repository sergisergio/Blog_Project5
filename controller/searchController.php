<?php

use \Philippe\Blog\Model\Entities\PostEntity;
use \Philippe\Blog\Model\PostManager;

/* ***************** SEARCH *****************/
function search($search, $csrfSearchToken)
{
    $postManager = new PostManager();
    $_SESSION['csrfSearchToken'] = $csrfSearchToken;
    if (isset($search) && $search != null) {
        if (isset($_SESSION['csrfSearchToken']) AND isset($csrfSearchToken) AND !empty($_SESSION['csrfSearchToken']) AND !empty($csrfSearchToken)) {
            if ($_SESSION['csrfSearchToken'] == $csrfSearchToken) {
                
                $posts1 = $postManager->getPosts(0, 5);
                $countSearchResults = $postManager->countSearchRequest($search);
                $nbResults = $countSearchResults->rowCount();
                $searchResults = $postManager->searchRequest($search);

                include 'view/frontend/pages/searchresults.php';
            }
            else
            {
                echo "Erreur de vérification";
            }
        }
    }
}