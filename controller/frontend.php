<?php

/* Je charge les fichiers model pour que les fonctions soient en mémoire*/
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');
/* L'instruction require_once est identique à require mis à part que PHP vérifie si le fichier a déjà été inclus, et si c'est le cas, ne l'inclut pas une deuxième fois. */


                                    /* **********************************************************************
                                    *                              PAGE D'ACCUEIL                           *
                                    ************************************************************************/
/* fonction qui fait appel à la page d'accueil */
function home()
{
    require('view/frontend/home.php');
}

                                    /* **********************************************************************
                                     *                              CONNEXION                                *
                                     ************************************************************************/
/* fonction qui fait appel à la page de connexion */
function connexion()
{
	require('view/frontend/connexion.php');
}

                                    /* **********************************************************************
                                    *                              INSCRIPTION                              *
                                    ************************************************************************/
/* fonction qui fait appel à la page d'inscription */
function registration()
{
	require('view/frontend/registration.php');
}

                                    /* **********************************************************************
                                    *                           TOUS LES BLOG POSTS                         *
                                    ************************************************************************/
/* fonction qui fait appel à l'instance $postmanager qui utilise la fonction getPosts et va donc récupérer tous les articles : le résultat est mémorisé dans la variable posts et la page blog est affichée. */
function listPosts()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$posts = $postManager->getPosts();
	require('view/frontend/blog.php');
}

                                    /* **********************************************************************
                                    *                          AFFICHER UN SEUL BLOG POST                   *
                                    ************************************************************************/
/* fonction qui fait appel à 2 instances. L'instance $postmanager utilise la fonction getpost pour récupérer un article en fonction de son identifiant. L'instance $commentmanager utilise la fonction getcomments pour récupérer les commentaires en fonction de l'identifiant de l'article. Puis la page blog_post est affichée. */
function listPost()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    

    require('view/frontend/blog_post.php');
}

                                    /* **********************************************************************
                                    *                          AJOUTER UN COMMENTAIRE                       *
                                    ************************************************************************/
/* fonction qui fait appel à l'instance$commentmanager qui va utiliser la fonction postcomment afin d'ajouter un commentaire dans la base de données. 3 paramètres sont utilisés : postId, pseudo et contenu . Une fois ajouté, on retourne à la même page. */
function addComment($postId, $memberPseudo, $content)
{
	$commentManager = new \Philippe\Blog\Model\CommentManager();
	$affectedLines = $commentManager->postComment($postId, $memberPseudo, $content);

	if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
    }
}

                                    /* **********************************************************************
                                    *              AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE            *
                                    ************************************************************************/
/* fonction qui fait appel à 2 instances. L'instance $commentmanager utilise la fonction getcomment qui va récupérer un commentaire en fonction de son identifiant et l'instance $postmanager récupère l'article en fonction de son identifiant. Puis on affiche la page de modification du commentaire */
/* A Revoir */
function modifyCommentPage($commentId)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();

	$comment = $commentManager->getComment($commentId);
	$post = $postManager->getPost($comment['post_id']);

	require('view/frontend/modifyView.php');
}

                                    /* **********************************************************************
                                    *                          SUPPRIMER UN COMMENTAIRE                     *
                                    ************************************************************************/
function deletedCommentPage($commentId)
{

    $commentManager = new \Philippe\Blog\Model\CommentManager();

    $comment = $commentManager->getComment($commentId);
    
    $success = $commentManager->deleteComment($commentId);
    
    

    if ($success === false) {
        throw new Exception('Impossible de supprimer le commentaire');
    }
    else {
        header('Location: index.php?action=blogpost&id=' . $comment['post_id'] . '#comments');
    }
}

                                    /* **********************************************************************
                                    *                          MODIFIER UN COMMENTAIRE                      *
                                    ************************************************************************/
/* fonction qui utilise une seule instance $commentmanager mais 2 fonctions. L'instance utilise la fonction getComment pour récupérer le commentaire en fonction de son identifiant, puis la fonction modifycomment qui va nous permettre de mettre à jour le commentaire dans la base de données. Une fois modifié, on retourne à la page de l'article en question... */
function modifyComment($commentId, $memberPseudo, $content)
{
    $commentManager = new \Philippe\Blog\Model\CommentManager();

    $success = $commentManager->modifyComment($commentId, $memberPseudo, $content);
    $comment = $commentManager->getComment($commentId);

    if ($success === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=blogpost&id=' . $comment['post_id'] . '#comments');
    }
}