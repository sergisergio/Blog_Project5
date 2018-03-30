<?php

/* Je charge les fichiers model pour que les fonctions soient en mémoire*/
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
function addComment($postId, $memberPseudo, $content)
{
	$commentManager = new \Philippe\Blog\Model\CommentManager();
	$affectedLines = $commentManager->postComment($postId, $memberPseudo, $content);

	if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=blogpost&id=' . $postId);
    }
}
function modifyCommentPage($commentId)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();

	$comment = $commentManager->getComment($commentId);
	$post = $postManager->getPost($comment['post_id']);

	require('view/frontend/modifyView.php');
}
function modifyComment($commentId, $memberPseudo, $content)
{
    $commentManager = new \Philippe\Blog\Model\CommentManager();

    $success = $commentManager->modifyComment($commentId, $memberPseudo, $content);
    $comment = $commentManager->getComment($commentId);

    if ($success === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=blogpost&id=' . $comment['post_id']);
    }
}
