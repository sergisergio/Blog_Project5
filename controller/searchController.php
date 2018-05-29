<?php

require "vendor/autoload.php";
use \Philippe\Blog\Model\Entities\PostEntity;
use \Philippe\Blog\Model\Entities\CommentEntity;
use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Model\SessionManager;
use \Philippe\Blog\Model\SecurityManager;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function search($search)
{
    if (isset($search) && $search != NULL) {
        $postManager = new PostManager();
        $posts1 = $postManager->getPosts(0, 5);
        $countSearchResults = $postManager->countSearchRequest($search);
        $nbResults = $countSearchResults->rowCount();
        $results = $postManager->searchRequest($search);
        require('view/frontend/pages/searchresults.php');
    }
}