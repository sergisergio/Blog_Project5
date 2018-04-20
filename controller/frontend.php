<?php

/* ************************* RESUME *************************************

1 . Page d'accueil
2 . Page de connexion
3 . Page d'inscription
4 . Inscription
5 . Connexion
6 . Déconnexion
7 . Doublon pseudo
8 . Doublon Email
9 . Confirmation inscription
10 . Tous les Blog Posts
11 . Afficher un seul Blog Post
12 . Ajouter un commentaire
13 . Afficher la page pour modifier un commentaire
14 . Supprimer un commentaire
15 . Modifier un commentaire
************************************************************************/

/* Je charge les fichiers model pour que les fonctions soient en mémoire*/
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');
/* L'instruction require_once est identique à require mis à part que PHP vérifie si le fichier a déjà été inclus, et si c'est le cas, ne l'inclut pas une deuxième fois. */


/* **********************************************************************
*                         1 .  PAGE D'ACCUEIL                           *
************************************************************************/
/* fonction qui fait appel à la page d'accueil */
function home()
{
    require('view/frontend/home.php');
}
/* **********************************************************************
*                         2 . PAGE CONNEXION                            *
************************************************************************/
/* fonction qui fait appel à la page de connexion */
function loginPage()
{
	require('view/frontend/login.php');
}
/* **********************************************************************
*                          3 . PAGE INSCRIPTION                         *
************************************************************************/
/* fonction qui fait appel à la page d'inscription */
function signupPage()
{
    
	require('view/frontend/signup.php');
}
/* **********************************************************************
*                          4 . INSCRIPTION                              *
************************************************************************/

function addUser($pseudo, $email, $passe)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $users = $userManager->addUserRequest($pseudo, $email, $passe);
     if ($users === false) {
        throw new Exception('Inscription impossible !');
    } 
    
    else {
        echo '<div class="alert alert-success">' . 'Un email de confirmation vous a été envoyé pour valider votre compte !' . '</div>' . '<br />';
        // header('Location: index.php?action=confirmRegistration');
    } 
}
/* **********************************************************************
*                          5 . CONNEXION                                *
************************************************************************/

function login($pseudo,$passe) {
    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->loginRequest($pseudo,$passe);
    
         if(!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['passe'])) {
            if(password_verify($_POST['passe'], $user['password'])) {
                $_SESSION['pseudo'] = $user;
                // header('Location:view/frontend/blog.php');
                echo '<div class="alert alert-success">' . 'Vous êtes connecté' . '</div>' . '<br />';
                
            }
            else {
                echo '<div class="alert alert-danger">' . 'Mauvais identifiant ou mot de passe' . '</div>' . '<br />';
            }
        }
    else {
        echo '<div class="alert alert-danger">' . 'Veuillez remplir tous les champs !' . '</div>' . '<br />';
    }
    
    
        
    
}
/* **********************************************************************
*                          6 . DECONNEXION                              *
************************************************************************/

function logoff($pseudo,$passe) {
    $userManager = new \Philippe\Blog\Model\UserManager();
    $users = $userManager->logoffRequest($pseudo,$passe);
}

/* **********************************************************************
*                          7 . DOUBLON PSEUDO                           *
************************************************************************/

function checkExistPseudo($pseudo) {
    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->existPseudo($pseudo);

     if ($user) {
        // throw new Exception('Ce pseudo est déjà pris');
        echo '<div class="alert alert-danger">' . 'Ce pseudo est déjà utilisé' . '</div>';
    }
    /* else {
        header('Location: index.php?action=confirmRegistration');
    } */
}

/* **********************************************************************
*                            8 . DOUBLON MAIL                           *
************************************************************************/

function checkExistMail($email) {
    $userManager = new \Philippe\Blog\Model\UserManager();
    $usermail = $userManager->existMail($email);

     if ($usermail) {
        // throw new Exception('Cet email est déjà pris');
        echo '<div class="alert alert-danger">' . 'Cet email est déjà utilisé' . '</div>';
    }
    /* else {
        header('Location: index.php?action=confirmRegistration');
    } */
}

/* **********************************************************************
*                   9 . CONFIRMATION INSCRIPTION                        *
************************************************************************/
/* fonction qui fait appel à la page d'inscription */
function confirmRegistration($userId, $userToken)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->getUser($userId);
    
    /*var_dump($user);
    var_dump($userToken);
    die();*/
    
    if ($user &&  $user['confirmation_token'] == $userToken) {
        echo 'Votre compte a bien été validé';
        // update champ active à 1
        
        header('Location : http://projet5.philippetraon.com/index.php?action=blog');
    }
    else {
        echo 'Ce token n\'est plus valide';
    }
    require('view/frontend/confirmRegistration.php');
}

/* **********************************************************************
*                      10 . TOUS LES BLOG POSTS                         *
************************************************************************/
/* fonction qui fait appel à l'instance $postmanager qui utilise la fonction getPosts et va donc récupérer tous les articles : le résultat est mémorisé dans la variable posts et la page blog est affichée. */
function listPosts()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$posts = $postManager->getPosts();
	require('view/frontend/blog.php');
}

/* **********************************************************************
*                     11 . AFFICHER UN SEUL BLOG POST                   *
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
*                     12 . AJOUTER UN COMMENTAIRE                       *
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
*         13 . AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE            *
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
*                     14 . SUPPRIMER UN COMMENTAIRE                     *
************************************************************************/
function deletedComment($commentId)
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
*                     15 . MODIFIER UN COMMENTAIRE                      *
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

/* **********************************************************************
*             16. AFFICHER LA PAGE MODIFICATION MOT DE PASSE            *
************************************************************************/

function forgetPassword()
{
    require('view/frontend/forget.php');
}