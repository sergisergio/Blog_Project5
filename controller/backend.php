<?php 

/* Je charge les fichiers model pour que les fonctions soient en mémoire*/
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

/* fonction qui fait appel à la page de connexion administrateur*/
function connexionAdmin()
{
	require('view/backend/index.php');
}

/* fonction qui fait appel à la page de gestion administrateur */
function indexManagement()
{
	require('view/backend/index_management.php');
}

/* fonction qui fait appel à la page de gestion des articles */
function managePosts()
{	
	$postManager = new \Philippe\Blog\Model\PostManager();
	$posts = $postManager->getPosts();
	require('view/backend/post_mgmt.php');
}

/* fonction qui fait appel à la page de gestion des commentaires */
function manageComments()
{
	require('view/backend/comment_mgmt.php');
}

/* fonction qui fait appel à la page de gestion des membres */
function manageUsers()
{
	require('view/backend/user_mgmt.php');
}

/* fonction qui fait appel à la page de modification de gestion des articles */
function modifyPost()
{
	require('view/backend/modifyPostView.php');
}