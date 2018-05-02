<?php 

/* ************************* RESUME *************************************

2 . Page d'accueil administrateur
3 . Page de gestion des articles
4 . Ajouter un article
5 . Afficher la page de modification des articles
6 . Modifier un article
7 . Supprimer un article
8 . Page de gestion des commentaires
9 . Ajouter un commentaire
10 . Afficher les commentaires d'un article
11 . Afficher la page pour modifier un commentaire
12 . Modifier un commentaire
13 . Supprimer un commentaire
14 . Page de gestion des membres
15 . Supprimer un membre
16 . Afficher la page de modification d'un membre
17 . Modifier un membre
************************************************************************/

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

/* **********************************************************************
*                2 . PAGE D'ACCUEIL ADMINISTRATEUR                      *
************************************************************************/

function indexManagement()
{
	require('view/backend/index_management.php');
}

/* **********************************************************************
*                2 . PAGE No ADMIN                      *
************************************************************************/

function noAdmin()
{
	require('view/backend/noadmin.php');
}

/* **********************************************************************
*                3 . PAGE DE GESTION DES ARTICLES                       *
************************************************************************/

function managePosts()
{	
	$postManager = new \Philippe\Blog\Model\PostManager();
	$posts = $postManager->getPosts();
	require('view/backend/Posts/post_mgmt.php');
}

/* **********************************************************************
*                       4 . AJOUTER UN ARTICLE                          *
************************************************************************/

function addPost($title, $intro, $author, $content)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$affectedPost = $postManager->addPostRequest($title, $intro, $author, $content);

	if ($affectedPost === false) {
        throw new Exception('Impossible d\'ajouter l\'article');
    }
    else {
        header('Location: index.php?action=manage_posts#viewposts');
    }
}

/* **********************************************************************
*          5 . AFFICHER LA PAGE DE MODIFICATION DES ARTICLES            *
************************************************************************/

function modifyPostPage($postId)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$post = $postManager->getPost($_GET['id']);
	require('view/backend/Posts/modifyPostView.php');
}

/* **********************************************************************
*                    6 . MODIFIER UN ARTICLE                            *
************************************************************************/

function modifyPost($postId, $title, $intro, $author, $content)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$success = $postManager->modifyPostRequest($postId, $title, $intro, $author, $content);
	$post = $postManager->getPost($_GET['id']);

	if ($success === false) {
		throw new Exception('Impossible de modifier l\'article');
	}
	else {
		header('Location: index.php?action=manage_posts#viewposts');
	}
}

/* **********************************************************************
*                      7 .SUPPRIMER UN ARTICLE                          *
************************************************************************/

function deletePost($postId)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$success = $postManager->deletePostRequest($_GET['id']);

	if ($success === false) {
		throw new Exception('Impossible de supprimer l\'article');
	}
	else {
		header('Location: index.php?action=manage_posts#viewposts');
	}
}

/* **********************************************************************
*                8 . PAGE DE GESTION DES COMMENTAIRES                   *
************************************************************************/

function manageComments()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$posts = $postManager->getPosts();
	require('view/backend/Comments/comment_mgmt.php');
}

/* **********************************************************************
*            10 . AFFICHER LES COMMENTAIRES D'UN ARTICLE                *
************************************************************************/

function AdminViewPost()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    
    require('view/backend/Comments/modifyCommentPage.php');
}

/* **********************************************************************
*                    14 . PAGE DE GESTION DES MEMBRES                   *
************************************************************************/

function manageUsers()
{
	$userManager = new \Philippe\Blog\Model\UserManager();
	$req = $userManager->getUsers();
	require('view/backend/Users/user_mgmt.php');
}

/* **********************************************************************
*                     15 .SUPPRIMER UN MEMBRE                           *
************************************************************************/

function deleteUser($userId)
{
	$userManager = new \Philippe\Blog\Model\UserManager();
	$affectedUser = $userManager->deleteUserRequest($_GET['id']);
	//require('view/backend/Users/user_mgmt.php');
    if ($affectedUser === false){
        throw new Exception('Impossible de supprimer ce membre');
	}
	else {
		header('Location: index.php?action=manage_users');
	}
}

/* **********************************************************************
*        16 . AFFICHER LA PAGE DE MODIFICATION D'UN MEMBRE              *
************************************************************************/

function modifyUserPage($userId)
{
	$userManager = new \Philippe\Blog\Model\UserManager();
	$req = $userManager->getUser($_GET['id']);
	require('view/backend/Users/modifyUserView.php');
}

/* **********************************************************************
*                      17 . MODIFIER UN MEMBRE                          *
************************************************************************/

function modifyUser($userId)
{
	$userManager = new \Philippe\Blog\Model\UserManager();
	$success = $userManager->modifyUserRequest($_GET['id']);
	if ($success === false) {
		throw new Exception('Impossible de modifier le membre');
	}
	else {
		header('Location: index.php?action=manage_posts');
	}
}