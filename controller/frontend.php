<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function home()
{
    require('view/frontend/home.php');
}
function blog()
{
	require('view/frontend/blog.php');
}
function connexion()
{
	require('view/frontend/connexion.php');
}
function registration()
{
	require('view/frontend/registration.php');
}
function listPosts()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$posts = $postManager->getPosts();
	require('view/frontend/blog.php');
}
function listPost()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    

    require('view/frontend/blog_post.php');
}
