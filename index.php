<?php
session_start();

/* ************* RESUME **********************/
/* ******************************************
*              UTILISATEUR                  *
*********************************************
1 . PAGE D'ACCUEIL DU BLOG.
2 . PAGE QUI AFFICHE UN BLOG POST.
3 . AJOUTER UN COMMENTAIRE.
4 . AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE.
5 . SUPPRIMER UN COMMENTAIRE.
6 . MODIFIER UN COMMENTAIRE.
7 . PAGE DE CONNEXION UTILISATEUR.
8 . CONNEXION UTILISATEUR.
9 . DECONNEXION UTILISATEUR. 
10. PAGE INSCRIPTION UTILISATEUR.
11. INSCRIPTION UTILISATEUR.
12. CONFIRMATION INSCRIPTION UTILISATEUR.
13. PAS LES DROITS ADMINISTRATEUR
14. CONTACT
/* ******************************************
*              ADMINISTRATEUR               *
*********************************************
1 . AFFICHER PAGE D'ACCUEIL ADMINISTRATEUR.
2 . AFFICHER LA RUBRIQUE ARTICLES.
3 . AFFICHER LA RUBRIQUE COMMENTAIRES.
4 . AJOUTER UN ARTICLE.
5 . AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE.
6 . MODIFIER UN ARTICLE.
7 . SUPPRIMER UN ARTICLE.
8 . VALIDER UN COMMENTAIRE.
9 . SUPPRIMER UN COMMENTAIRE.
/* ******************************************
*              PAR DEFAUT                   *
*********************************************
1 . PAGE D'ACCUEIL DU SITE.
************ FIN RESUME **********************/

require 'controller/frontend.php';
require 'controller/backend.php';
try {
    if (isset($_GET['action'])) {
/**********************************************
*                  FRONT-END                  *
**********************************************/
        /* 1 . BLOG POSTS ****************************/
        if ($_GET['action'] == 'blog') {
            listPosts();
        }
        /* 2 . UN BLOG POST **************************/
        elseif ($_GET['action'] == 'blogpost') {
            listPost($_GET['id']);
        }
        /* 3 . AJOUTER UN COMMENTAIRE ****************/
        elseif ($_GET['action'] == 'addcomment') {
            addComment($_GET['id'], $_SESSION['id'], $_POST['content']);
        }
        /* 4 . PAGE POUR MODIFIER UN COMMENTAIRE *****/
        elseif ($_GET['action'] == 'modifyCommentPage') {
            modifyCommentPage($_GET['id']);
        }
        /* 5 . SUPPRIMER UN COMMENTAIRE **************/
        elseif ($_GET['action'] == 'deleteComment') {
            deleteComment($_GET['id']);
        }
        /* 6 . MODIFIER UN COMMENTAIRE ***************/
        elseif ($_GET['action'] == 'modifyComment') {
            modifyComment($_GET['id'], $_SESSION['id'], $_POST['content']);
        }
        /* 7 . PAGE CONNEXION UTILISATEUR ************/
        elseif ($_GET['action'] == 'loginPage') {
            loginPage();
        }
        /* 8 . CONNEXION UTILISATEUR *****************/
        elseif ($_GET['action'] == 'login') {
            login($_POST['pseudo'], $_POST['passe'], $_SERVER['REMOTE_ADDR']);
        }
        /* 9 . DECONNEXION UTILISATEUR ***************/
        elseif ($_GET['action'] == 'logout') {
            logout();
        }
        /* 10. PAGE INSCRIPTION UTILISATEUR **********/
        elseif ($_GET['action'] == 'signupPage') {
             signupPage();
        }
        /* 11. INSCRIPTION UTILISATEUR ***************/
        elseif ($_GET['action'] == 'addUser') {
             addUser($_POST['pseudo'], $_POST['email'], $_POST['passe'], $_POST['passe2']); 
        }
        /* 12. CONFIRMATION INSCRIPTION UTILISATEUR **/
        elseif ($_GET['action'] == 'confirmRegistration') {
            confirmRegistration($_GET['id'], $_GET['token']); 
        }
        /* 13 . PAS LES DROITS ADMINISTRATEUR ********/
        elseif ($_GET['action'] == 'noAdmin') {
            noAdmin();
        }
        /* 14 . CONTACT ******************************/
        elseif ($_GET['action'] == 'contact') {
            contact($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
        }
        /* 15 . SEARCH ******************************/
        elseif ($_GET['action'] == 'search') {
            search($_POST['search']);
        }
        /* ********************************************
        *           ADMINISTRATEUR                    *
        **********************************************/
        /* 1 . PAGE D'ACCUEIL ADMINISTRATEUR *********/
        elseif ($_GET['action'] == 'admin') {
            admin();
        }
        /* 2 . AFFICHER LA RUBRIQUE ARTICLES *********/
        elseif ($_GET['action'] == 'manage_posts') {
            managePosts();
        }
        /* 3 . AFFICHER LA RUBRIQUE COMMENTAIRES *****/
        elseif ($_GET['action'] == 'manage_comments') {
            manageComments();
        }
        /* 4 . AJOUTER UN ARTICLE ********************/
        elseif ($_GET['action'] == 'addpost') {
            addPost($_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content'], $_FILES['file_extension']['name']);
        }
        /* 5 . PAGE POUR MODIFIER UN ARTICLE *********/
        elseif ($_GET['action'] == 'modifyPostPage') {
                modifyPostPage($_GET['id']);
        }
        /* 6 . MODIFIER UN ARTICLE *******************/
        elseif ($_GET['action'] == 'modifyPost') {
            modifyPost($_GET['id'], $_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content']);
        }       
        /* 7 . EFFACER UN ARTICLE ********************/
        elseif ($_GET['action'] == 'deletePost') {
                deletePost($_GET['id']);
        }
        /* 8 . VALIDER UN COMMENTAIRE ****************/
        elseif ($_GET['action'] == 'validateComment') {
                validateComment($_GET['id']);
        } 
        /* 9 . SUPPRIMER UN COMMENTAIRE **************/
        elseif ($_GET['action'] == 'adminDeleteComment') {
                adminDeleteComment($_GET['id']);
        }
    }
    /* ********************************************
    *                    PAR DEFAUT               *
    **********************************************/
    /* 1 . PAGE D'ACCUEIL ************************/
    else {
        home();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}