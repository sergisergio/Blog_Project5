<?php 

/* Je charge les fichiers model pour que les fonctions soient en mémoire*/
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');


									/* **********************************************************************
                                    *                    PAGE DE CONNEXION ADMINISTRATEUR                   *
                                    ************************************************************************/
/* fonction qui fait appel à la page de connexion administrateur*/
function connexionAdmin()
{
	require('view/backend/index.php');
}

									/* **********************************************************************
                                    *                    PAGE D'ACCUEIL ADMINISTRATEUR                      *
                                    ************************************************************************/
/* fonction qui fait appel à la page de gestion administrateur */
function indexManagement()
{
	require('view/backend/index_management.php');
}

									/* **********************************************************************
                                    *                    PAGE DE GESTION DES ARTICLES                       *
                                    ************************************************************************/
/* fonction qui fait appel à la page de gestion des articles */
function managePosts()
{	
	$postManager = new \Philippe\Blog\Model\PostManager();
	$posts = $postManager->getPosts();
	require('view/backend/Posts/post_mgmt.php');
}

									/* **********************************************************************
                                    *                           AJOUTER UN ARTICLE                          *
                                    ************************************************************************/
function addedPost($title, $intro, $memberPseudo, $content)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$affectedPost = $postManager->addPost($title, $intro, $memberPseudo, $content);

	if ($affectedPost === false) {
        throw new Exception('Impossible d\'ajouter l\'article');
    }
    else {
        header('Location: index.php?action=manage_posts#viewposts');
    }
}
						
									/* **********************************************************************
                                    *              AFFICHER LA PAGE DE MODIFICATION DES ARTICLES            *
                                    ************************************************************************/
/* fonction qui fait appel à la page de modification de gestion des articles */
function modifyPostPage($postId)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$post = $postManager->getPost($_GET['id']);
	require('view/backend/Posts/modifyPostView.php');
}

									/* **********************************************************************
                                    *                        MODIFIER UN ARTICLE                            *
                                    ************************************************************************/
function modifyPost($postId, $title, $intro, $memberPseudo, $content)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$success = $postManager->modifyPost($postId, $title, $intro, $memberPseudo, $content);
	$post = $postManager->getPost($_GET['id']);

	if ($success === false) {
		throw new Exception('Impossible de modifier l\'article');
	}
	else {
		header('Location: index.php?action=manage_posts#viewposts');
	}
}

									/* **********************************************************************
                                    *                         SUPPRIMER UN ARTICLE                          *
                                    ************************************************************************/
function deletedPost($postId)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$success = $postManager->deletePost($_GET['id']);

	if ($success === false) {
		throw new Exception('Impossible de supprimer l\'article');
	}
	else {
		header('Location: index.php?action=manage_posts#viewposts');
	}
}

									/* **********************************************************************
                                    *                    PAGE DE GESTION DES COMMENTAIRES                   *
                                    ************************************************************************/
/* fonction qui fait appel à la page de gestion des commentaires */
function manageComments()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$posts = $postManager->getPosts();
	require('view/backend/Comments/comment_mgmt.php');
}

									/* **********************************************************************
                                    *                         AJOUTER UN COMMENTAIRE                        *
                                    ************************************************************************/
/* fonction qui fait appel à l'instance$commentmanager qui va utiliser la fonction postcomment afin d'ajouter un commentaire dans la base de données. 3 paramètres sont utilisés : postId, pseudo et contenu . Une fois ajouté, on retourne à la même page. */
function adminAddComment($postId, $memberPseudo, $content)
{
	$commentManager = new \Philippe\Blog\Model\CommentManager();
	$affectedLines = $commentManager->postComment($postId, $memberPseudo, $content);

	if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=adminListPost&id=' . $postId . '#viewcomments');
    }
}

									/* **********************************************************************
                                    *                 AFFICHER LES COMMENTAIRES D'UN ARTICLE                *
                                    ************************************************************************/
/* fonction qui fait appel à 2 instances. L'instance $postmanager utilise la fonction getpost pour récupérer un article en fonction de son identifiant. L'instance $commentmanager utilise la fonction getcomments pour récupérer les commentaires en fonction de l'identifiant de l'article. Puis la page blog_post est affichée. */
function AdminListPost()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    

    require('view/backend/Comments/modifyCommentView.php');
}

									/* **********************************************************************
                                    *               AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE           *
                                    ************************************************************************/
function AdminModifyCommentPage($commentId)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();

	$comment = $commentManager->getComment($commentId);
	$post = $postManager->getPost($comment['post_id']);

	require('view/backend/Comments/tomodifyCommentView.php');
}

									/* **********************************************************************
                                    *                         MODIFIER UN COMMENTAIRE                       *
                                    ************************************************************************/
/* fonction qui utilise une seule instance $commentmanager mais 2 fonctions. L'instance utilise la fonction getComment pour récupérer le commentaire en fonction de son identifiant, puis la fonction modifycomment qui va nous permettre de mettre à jour le commentaire dans la base de données. Une fois modifié, on retourne à la page de l'article en question... */
function adminModifyComment($commentId, $memberPseudo, $content)
{
    $commentManager = new \Philippe\Blog\Model\CommentManager();

    $success = $commentManager->modifyComment($commentId, $memberPseudo, $content);
    $comment = $commentManager->getComment($commentId);

    if ($success === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=adminListPost&id=' . $comment['post_id']  . '#viewcomments');
    }
}

									/* **********************************************************************
                                    *                         SUPPRIMER UN COMMENTAIRE                      *
                                    ************************************************************************/
 
function adminDeletedCommentPage($commentId)
{

    $commentManager = new \Philippe\Blog\Model\CommentManager();

    $comment = $commentManager->getComment($commentId);
    
    $success = $commentManager->deleteComment($commentId);
    
    

    if ($success === false) {
        throw new Exception('Impossible de supprimer le commentaire');
    }
    else {
        header('Location: index.php?action=adminListPost&id=' . $comment['post_id'] . '#viewcomments');
    }
}

									/* **********************************************************************
                                    *                    PAGE DE GESTION DES MEMBRES                   *
                                    ************************************************************************/
/* fonction qui fait appel à la page de gestion des membres */
function manageUsers()
{
	$userManager = new \Philippe\Blog\Model\UserManager();
	$req = $userManager->getUsers();
	require('view/backend/Users/user_mgmt.php');
}

									/* **********************************************************************
                                    *                         SUPPRIMER UN MEMBRE                           *
                                    ************************************************************************/


function deletedUser()
{
	$userManager = new \Philippe\Blog\Model\UserManager();
	$req = $userManager->getUsers();
	require('view/backend/Users/user_mgmt.php');
}
									
									/* **********************************************************************
                                    *             AFFICHER LA PAGE DE MODIFICATION D'UN MEMBRE              *
                                    ************************************************************************/
function modifyUser()
{
	$userManager = new \Philippe\Blog\Model\UserManager();
	$req = $userManager->getUser($_GET['id']);
	require('view/backend/Users/modifyUserView.php');
}
									
									/* **********************************************************************
                                    *                           MODIFIER UN MEMBRE                          *
                                    ************************************************************************/
function modifiedUser()
{
	$userManager = new \Philippe\Blog\Model\UserManager();
	$success = $userManager->modifyUser($_GET['id']);
	if ($success === false) {
		throw new Exception('Impossible de modifier le membre');
	}
	else {
		header('Location: index.php?action=manage_posts');
	}
}

									
