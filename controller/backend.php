<?php 

/* ************************* RESUME *************************************

1 . PAGE D'ACCUEIL ADMINISTRATEUR.
2 . PAGE NO ADMIN. 
3 . PAGE DE GESTION DES ARTICLES.
4 . AJOUTER UN ARTICLE.
5 . PAGE DE MODIFICATION DES ARTICLES.
6 . MODIFIER UN ARTICLE.
7 . SUPPRIMER UN ARTICLE.
8 . PAGE DE GESTION DES COMMENTAIRES.
9 . VALIDER UN COMMENTAIRE.
10. SUPPRIMER UN COMMENTAIRE.

************************************************************************/
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CommentManager;

/* *********** 1 . PAGE D'ACCUEIL ADMINISTRATEUR ***********************/

function indexManagement(){

	require('view/backend/index_management.php');
}

/* *********** 2 . PAGE NO ADMIN ***************************************/

function noAdmin(){

	require('view/backend/noadmin.php');
}

/* *********** 3 . PAGE DE GESTION DES ARTICLES ************************/

function managePosts(){

	$postManager = new PostManager();
	$postsTotal = $postManager->countPosts();
	$postsPerPage = 5;
    $totalPages = ceil($postsTotal / $postsPerPage);
    if(isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page'] > 0 ) AND ($_GET['page'] <= $totalPages)){
        $_GET['page'] = intval($_GET['page']);
        $currentPage = $_GET['page'];
    }
    else {
        $currentPage = 1;
    }
    $start = ($currentPage-1)*$postsPerPage;
	$posts = $postManager->getPosts($start, $postsPerPage);
	
	require('view/backend/Posts/post_mgmt.php');
}

/* *********** 4 . AJOUTER UN ARTICLE **********************************/

function addPost($title, $chapo, $author, $content, $image){

	$postManager = new PostManager();
	$affectedPost = $postManager->addPostRequest($title, $chapo, $author, $content, $image);

	if ($affectedPost === false) {
        throw new Exception('Impossible d\'ajouter l\'article');
    }
    else {
        header('Location: index.php?action=manage_posts#viewposts');
    }
}

/* *********** 5 . PAGE DE MODIFICATION DES ARTICLES *******************/

function modifyPostPage($postId){

	$postManager = new PostManager();
	$post = $postManager->getPost($postId);
	if (empty($post)) {
		$_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
        managePosts();
        exit();
	}
	require('view/backend/Posts/modifyPostView.php');
}

/* *********** 6 . MODIFIER UN ARTICLE *********************************/

function modifyPost($postId, $title, $chapo, $author, $content){

	$postManager = new PostManager();
	$success = $postManager->modifyPostRequest($postId, $title, $chapo, $author, $content);
	$post = $postManager->getPost($postId);

	if ($success === false) {
		throw new Exception('Impossible de modifier l\'article');
	}
	else {
		header('Location: index.php?action=manage_posts#viewposts');
	}
}

/* *********** 7 . SUPPRIMER UN ARTICLE ********************************/

function deletePost($postId){

	$postManager = new PostManager();
	$success = $postManager->deletePostRequest($postId);

	if ($success === false) {
		throw new Exception('Impossible de supprimer l\'article');
	}
	else {
		header('Location: index.php?action=manage_posts#viewposts');
	}
}

/* *********** 8 . PAGE DE GESTION DES COMMENTAIRES ********************/

function manageComments(){

	$commentManager = new CommentManager();
	$nbCount = $commentManager->countCommentBackRequest();
	$submittedcomments = $commentManager->submittedCommentRequest();
	require('view/backend/Comments/comment_mgmt.php');
}

/* *********** 9 . VALIDER UN COMMENTAIRE ******************************/

function validateComment($commentId){

	$commentManager = new CommentManager();
	$validated = $commentManager->validateCommentRequest($commentId);
	if ($validated === false) {
		throw new Exception('Impossible de valider le commentaire');
	}
	else {
		header('Location: index.php?action=manage_comments');
	}
}

/* ********** 10 . SUPPRIMER UN COMMENTAIRE ****************************/

function adminDeleteComment($commentId){

    $commentManager = new CommentManager();
	$comment = $commentManager->getComment($commentId);
    $success = $commentManager->deleteCommentRequest($commentId);
    
    if ($success === false) {
        throw new Exception('Impossible de supprimer le commentaire');
    }
    else {
        header('Location: index.php?action=manage_comments');
    }
}