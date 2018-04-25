<?php 

/* ************************* RESUME *************************************

1 . Page de connexion administrateur
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

/* Je charge les fichiers model pour que les fonctions soient en mémoire*/
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

/* **********************************************************************
*                1 . PAGE DE CONNEXION ADMINISTRATEUR                   *
************************************************************************/
/* fonction qui fait appel à la page de connexion administrateur*/
function loginAdminPage()
{

	require('view/backend/index.php');
}

function loginAdmin($pseudo, $passe) {
	$userManager = new \Philippe\Blog\Model\UserManager();
	$access = $userManager->getAuthorization($pseudo);

	// Si authorization = 1 Alors Accès OK Sinon Accès pas ok
	if(password_verify($_POST['passe'], $access['password'])) {
		if ($access['authorization'] == 1) {
			// créer une session userId et vérifier l'autorisation : si celle-ci est OK, on reste sur la page sinon redirection vers page non connecté.
			header('Location : view/backend/index_management.php');
			exit;
			// require('view/backend/index_management.php');
		}
		else {
			echo '<div class="alert alert-danger">' . 'Vous n\'avez pas les droits pour accéder à la partie administrateur' . '</div>';
		}
	}
	else {
		echo '<div class="alert alert-danger">' . 'identifiant ou mot de passe incorrect' . '</div>';
	}
}


/* **********************************************************************
*                2 . PAGE D'ACCUEIL ADMINISTRATEUR                      *
************************************************************************/
/* fonction qui fait appel à la page de gestion administrateur */
function indexManagement()
{
	require('view/backend/index_management.php');
}
/* **********************************************************************
*                3 . PAGE DE GESTION DES ARTICLES                       *
************************************************************************/
/* fonction qui fait appel à la page de gestion des articles */
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
/* fonction qui fait appel à la page de modification de gestion des articles */
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
/* fonction qui fait appel à la page de gestion des commentaires */
function manageComments()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$posts = $postManager->getPosts();
	require('view/backend/Comments/comment_mgmt.php');
}
/* **********************************************************************
*                     9 . AJOUTER UN COMMENTAIRE                        *
************************************************************************/
/* fonction qui fait appel à l'instance$commentmanager qui va utiliser la fonction postcomment afin d'ajouter un commentaire dans la base de données. 3 paramètres sont utilisés : postId, pseudo et contenu . Une fois ajouté, on retourne à la même page. */
function adminAddComment($postId, $author, $content)
{
	$commentManager = new \Philippe\Blog\Model\CommentManager();
	$affectedLines = $commentManager->postComment($postId, $author, $content);

	if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=adminViewPost&id=' . $postId . '#viewcomments');
    }
}
/* **********************************************************************
*            10 . AFFICHER LES COMMENTAIRES D'UN ARTICLE                *
************************************************************************/
/* fonction qui fait appel à 2 instances. L'instance $postmanager utilise la fonction getpost pour récupérer un article en fonction de son identifiant. L'instance $commentmanager utilise la fonction getcomments pour récupérer les commentaires en fonction de l'identifiant de l'article. Puis la page blog_post est affichée. */
function AdminViewPost()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    

    require('view/backend/Comments/modifyCommentPage.php');
}
/* **********************************************************************
*          11 . AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE           *
************************************************************************/
function AdminModifyCommentPage($commentId)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();

	$comment = $commentManager->getComment($commentId);
	$post = $postManager->getPost($comment['post_id']);

	require('view/backend/Comments/modifyComment.php');
}
/* **********************************************************************
*                    12 . MODIFIER UN COMMENTAIRE                       *
************************************************************************/
/* fonction qui utilise une seule instance $commentmanager mais 2 fonctions. L'instance utilise la fonction getComment pour récupérer le commentaire en fonction de son identifiant, puis la fonction modifycomment qui va nous permettre de mettre à jour le commentaire dans la base de données. Une fois modifié, on retourne à la page de l'article en question... */
function adminModifyComment($commentId, $author, $content)
{
    $commentManager = new \Philippe\Blog\Model\CommentManager();

    $success = $commentManager->modifyComment($commentId, $author, $content);
    $comment = $commentManager->getComment($commentId);

    if ($success === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=adminViewPost&id=' . $comment['post_id']  . '#viewcomments');
    }
}
/* **********************************************************************
*                    13 . SUPPRIMER UN COMMENTAIRE                      *
************************************************************************/
 
function adminDeleteComment($commentId)
{

    $commentManager = new \Philippe\Blog\Model\CommentManager();
    $comment = $commentManager->getComment($commentId);
    $success = $commentManager->deleteCommentRequest($commentId);
    
    

    if ($success === false) {
        throw new Exception('Impossible de supprimer le commentaire');
    }
    else {
        header('Location: index.php?action=adminViewPost&id=' . $comment['post_id'] . '#viewcomments');
    }
}
/* **********************************************************************
*                    14 . PAGE DE GESTION DES MEMBRES                   *
************************************************************************/
/* fonction qui fait appel à la page de gestion des membres */
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

									
