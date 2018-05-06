<?php

/* ************************* RESUME *************************************

1 . Page d'accueil
2 . Page de connexion
3 . Page d'inscription
4 . Page de profil
5 . Inscription
6 . Connexion
7 . Se souvenir de moi
8 . Déconnexion
9 . Doublon pseudo
10 . Doublon Email
11 . Confirmation inscription
12 . passer user en actif
13 . Tous les Blog Posts
14 . Afficher un seul Blog Post
15 . Ajouter un commentaire
16 . Afficher la page pour modifier un commentaire
17 . Supprimer un commentaire
18 . Modifier un commentaire
************************************************************************/

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');
/* L'instruction require_once est identique à require mis à part que PHP vérifie si le fichier a déjà été inclus, et si c'est le cas, ne l'inclut pas une deuxième fois. */

/* **********************************************************************
*                         1 .  PAGE D'ACCUEIL                           *
************************************************************************/

function home()
{
    require('view/frontend/home.php');
}

/* **********************************************************************
*                         2 . PAGE CONNEXION                            *
************************************************************************/

function loginPage()
{
	require('view/frontend/login.php');
}

/* **********************************************************************
*                          3 . PAGE INSCRIPTION                         *
************************************************************************/

function signupPage()
{
    
	require('view/frontend/signup.php');
}

/* **********************************************************************
*                          4 . PAGE PROFIL                         *
************************************************************************/

function profilePage()
{
    
    require('view/frontend/profile.php');
}

/* **********************************************************************
*                          5 . INSCRIPTION                              *
************************************************************************/

function addUser($pseudo, $email, $passe)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $users = $userManager->addUserRequest($pseudo, $email, $passe);
     if ($users === false) {
        echo '<div class="alert alert-danger">' . 'Inscription impossible !' . '</div>' . '<br />';
    } 
    
    else {
        echo '<div class="alert alert-success">' . 'Un email de confirmation vous a été envoyé pour valider votre compte !' . '</div>' . '<br />';
        // header('Location: index.php?action=confirmRegistration');
    } 
}

/* **********************************************************************
*                          6 . CONNEXION                                *
************************************************************************/

function login($pseudo,$passe) {
    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->loginRequest($pseudo,$passe);
    
    if(!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['passe'])) {

        if(password_verify($_POST['passe'], $user['password'])) {
            if ($user['is_active'] == 1) {
            
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['prenom'] = $user['first_name'];
            $_SESSION['nom'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['autorisation'] = $user['authorization'];
            $_SESSION['avatar'] = $user['avatar'];
            $_SESSION['registration_date'] = $user['registration_date'];
            echo '<div class="alert alert-success">' . 'Bienvenue ' . $_SESSION['pseudo'] . ' : Vous êtes à présent connecté' . '</div>' . '<br />';
            $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
               // echo '<div class="alert alert-success">' . 'Vous êtes connecté' . '</div>' . '<br />';
            echo "<script>document.location.replace('index.php?action=blog');</script>";
            exit();
             
            }
            else {
                echo '<div class="alert alert-danger">' . 'Vous devez activer votre compte via le lien de confirmation dans le mail envoyé !' . '</div>' . '<br />';
            }
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
*                 7 . SE SOUVENIR DE MOI                                *
************************************************************************/

function remember($rememberToken) {
    $userManager = new \Philippe\Blog\Model\UserManager();
    $users = $userManager->rememberRequest($rememberToken);
}

/* **********************************************************************
*                          8 . DECONNEXION                              *
************************************************************************/

function logout() {
    $userManager = new \Philippe\Blog\Model\UserManager();
    $users = $userManager->logoutRequest();
    echo '<div class="alert alert-success">' . ' A bientôt !' . '</div>' . '<br />';
}

/* **********************************************************************
*                          9 . DOUBLON PSEUDO                           *
************************************************************************/

function checkExistPseudo($pseudo) {
    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->existPseudo($pseudo);

     if ($user) {
        echo '<div class="alert alert-danger">' . 'Ce pseudo est déjà utilisé' . '</div>';
    }
    /* else {
        header('Location: index.php?action=confirmRegistration');
    } */
}

/* **********************************************************************
*                            10 . DOUBLON MAIL                           *
************************************************************************/

function checkExistMail($email) {
    $userManager = new \Philippe\Blog\Model\UserManager();
    $usermail = $userManager->existMail($email);

     if ($usermail) {
        echo '<div class="alert alert-danger">' . 'Cet email est déjà utilisé' . '</div>';
    }
    /* else {
        header('Location: index.php?action=confirmRegistration');
    } */
}

/* **********************************************************************
*                   11 . CONFIRMATION INSCRIPTION                        *
************************************************************************/

function confirmRegistration($userId, $userToken)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $user = $userManager->getUser($userId);
     
    if ($user &&  $user['confirmation_token'] == $userToken) {
        
         require('view/frontend/login.php');
         echo '<script>alert ("Votre inscription a bien été prise en compte ! Vous pouvez vous connecter !") ;</script>';
        // update champ active à 1
         $userManager->setActiveRequest($userId);
    }
    else {
        echo '<script>alert ("Ce token n est plus valide ! Veuillez réessayer !");</script>';
         require('view/frontend/signup.php');
    }
    
}

/* **********************************************************************
*                    12 . PASSER USER EN ACTIF.                         *
************************************************************************/

function setActiveUser($userId)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $activeUser = $userManager->setActiveRequest($userId);
}

/* **********************************************************************
*                      13 . TOUS LES BLOG POSTS                         *
************************************************************************/

function listPosts()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$posts = $postManager->getPosts();
    $posts1 = $postManager->getPosts();
    require('view/frontend/blog.php');

}

/* **********************************************************************
*                     14 . AFFICHER UN SEUL BLOG POST                   *
************************************************************************/

function listPost()
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();
    $userManager = new \Philippe\Blog\Model\UserManager();

    $posts1 = $postManager->getPosts();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    $user = $userManager->getUser($_GET['id']);
    $count = $commentManager->countCommentRequest();
    
    require('view/frontend/blog_post.php');
}

/* **********************************************************************
*                     15 . AJOUTER UN COMMENTAIRE                       *
************************************************************************/

function addComment($postId, $author, $content)
{
	$commentManager = new \Philippe\Blog\Model\CommentManager();
	$affectedLines = $commentManager->postComment($postId, $author, $content);

	if ($affectedLines === false) {
        echo '<div class="alert alert-danger">' . 'Vous devez être inscrit pour ajouter un commentaires' . '</div>';
    }
    else {
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
    }
}

/* **********************************************************************
*         16 . AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE            *
************************************************************************/

function modifyCommentPage($commentId)
{
	$postManager = new \Philippe\Blog\Model\PostManager();
	$commentManager = new \Philippe\Blog\Model\CommentManager();

	$comment = $commentManager->getComment($commentId);
	$post = $postManager->getPost($comment['post_id']);

	require('view/frontend/modifyView.php');
}

/* **********************************************************************
*                     17 . SUPPRIMER UN COMMENTAIRE                     *
************************************************************************/
function deleteComment($commentId)
{

    $commentManager = new \Philippe\Blog\Model\CommentManager();

    $comment = $commentManager->getComment($commentId);
    
    $success = $commentManager->deleteCommentRequest($commentId);
    
    if ($success === false) {
        throw new Exception('Impossible de supprimer le commentaire');
    }
    else {
        header('Location: index.php?action=blogpost&id=' . $comment['post_id'] . '#comments');
    }
}

/* **********************************************************************
*                     18 . MODIFIER UN COMMENTAIRE                      *
************************************************************************/

function modifyComment($commentId, $author, $content)
{
    $commentManager = new \Philippe\Blog\Model\CommentManager();

    $success = $commentManager->modifyCommentRequest($commentId, $author, $content);
    $comment = $commentManager->getComment($commentId);

    if ($success === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=blogpost&id=' . $comment['post_id'] . '#comments');
    }
}

/* **********************************************************************
*             19. AFFICHER LA PAGE MOT DE PASSE OUBLIE                  *
************************************************************************/

function forgetPasswordPage()
{
    require('view/frontend/forget.php');
}

/* **********************************************************************
*             20. AFFICHER LA PAGE MODIFICATION MOT DE PASSE            *
************************************************************************/

function forgetPassword($email)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $forgetPassword = $userManager->forgetPasswordRequest($email);

}

/* **********************************************************************
*                  21. SUPPRIMER MON COMPTE                             *
************************************************************************/

function deleteAccount($userId)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $deleteAccount = $userManager->deleteAccountRequest($userId);

}