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
function modifyPost($postId)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$post = $postManager->getPost($_GET['id']);
	require('view/backend/modifyPostView.php');
}
function addedPost($title, $intro, $memberPseudo, $content)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$affectedPost = $postManager->addPost($title, $intro, $memberPseudo, $content);

	if ($affectedPost === false) {
        throw new Exception('Impossible d\'ajouter l\'article');
    }
    else {
        header('Location: index.php?action=manage_posts');
    }

}
function modifiedPost($postId, $title, $intro, $memberPseudo, $content)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$success = $postManager->modifyPost($postId, $title, $intro, $memberPseudo, $content);
	$post = $postManager->getPost($_GET['id']);

	if ($success === false) {
		throw new Exception('Impossible de modifier l\'article');
	}
	else {
		header('Location: index.php?action=manage_posts');
	}
}
function deletedPost($postId)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$success = $postManager->deletePost($_GET['id']);

	if ($success === false) {
		throw new Exception('Impossible de supprimer l\'article');
	}
	else {
		header('Location: index.php?action=manage_posts');
	}
}