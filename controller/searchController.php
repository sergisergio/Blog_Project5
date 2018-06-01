<?php

use \Philippe\Blog\Model\Entities\PostEntity;
use \Philippe\Blog\Model\PostManager;

/* ***************** SEARCH *****************/
	function search($search)
	{
	    if (isset($search) && $search != NULL) {
	        $postManager = new PostManager();
	        $posts1 = $postManager->getPosts(0, 5);
	        $countSearchResults = $postManager->countSearchRequest($search);
	        $nbResults = $countSearchResults->rowCount();
	        $searchResults = $postManager->searchRequest($search);

	        require('view/frontend/pages/searchresults.php');
	    }
	}