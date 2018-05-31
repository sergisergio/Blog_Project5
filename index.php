<?php
session_start();
require "vendor/autoload.php";
/* ************* SUM UP **********************/
/* ******************************************
*              USER                         *
*********************************************
1 . BLOG POSTS.
2 . ONLY ONE BLOG POST.
3 . ADD A COMMENT.
4 . MODIFY COMMENT PAGE.
5 . DELETE A COMMENT.
6 . MODIFY A COMMENT.
7 . CONNECTION PAGE.
8 . CONNECTION.
9 . DISCONNECTION. 
10. REGISTRATION PAGE.
11. REGISTRATION.
12. CONFIRM REGISTRATION.
13. CONTACT.
14. SEARCH.
15. PROFILE PAGE.
16. DELETE ACCOUNT.
17. MODIFY PROFILE.
18. PUBLIC PROFILE.
/* ******************************************
*              ADMIN.                       *
*********************************************
1 . ADMIN HOME PAGE.
2 . GET POSTS.
3 . GET COMMENTS.
4 . ADD A POST.
5 . MODIFY POST PAGE.
6 . MODIFY A POST.
7 . DELETE A POST.
8 . VALIDATE A COMMENT.
9 . DELETE A COMMENT.
/* ******************************************
*              PAR DEFAUT                   *
*********************************************
1 . HOME PAGE.
************ END SUM UP **********************/

require 'controller/defaultController.php';
require 'controller/adminController.php';
require 'controller/postController.php';
require 'controller/commentController.php';
require 'controller/logController.php';
require 'controller/registerController.php';
require 'controller/contactController.php';
require 'controller/errorsController.php';
require 'controller/searchController.php';
require 'controller/profileController.php';
try {
    if (isset($_GET['action'])) {
/**********************************************
*                  FRONT-END                  *
**********************************************/
/* 1 . BLOG POSTS ****************************/
        if ($_GET['action'] == 'blog') {
            listPosts();
        }
/* 2 . ONLY ONE BLOG POST ********************/
        elseif ($_GET['action'] == 'blogpost') {
            listPost($_GET['id']);
        }
/* 3 . ADD A COMMENT *************************/
        elseif ($_GET['action'] == 'addcomment') {
            addComment($_GET['id'], $_SESSION['id'], $_POST['content']);
        }
/* 4 . MODIFY COMMENT PAGE *******************/
        elseif ($_GET['action'] == 'modifyCommentPage') {
            modifyCommentPage($_GET['id'], $_GET['postId']);

        }
/* 5 . DELETE A COMMENT **********************/
        elseif ($_GET['action'] == 'deleteComment') {
            deleteComment($_GET['id'], $_GET['postId']);
        }
/* 6 . MODIFY A COMMENT **********************/
        elseif ($_GET['action'] == 'modifyComment') {
            modifyComment($_GET['id'], $_SESSION['id'], $_POST['content'], $_GET['postId']);
            
        }
/* 7 . CONNECTION PAGE ***********************/
        elseif ($_GET['action'] == 'loginPage') {
            loginPage();
        }
/* 8 . CONNECTION ****************************/
        elseif ($_GET['action'] == 'login') {
            login($_POST['pseudo'], $_POST['passe'], $_SERVER['REMOTE_ADDR']);
        }
/* 9 . DISCONNECTION *************************/
        elseif ($_GET['action'] == 'logout') {
            logout();
        }
/* 10. REGISTRATION PAGE *********************/
        elseif ($_GET['action'] == 'signupPage') {
             signupPage();
        }
/* 11. REGISTRATION **************************/
        elseif ($_GET['action'] == 'addUser') {
             addUser($_POST['pseudo'], $_POST['email'], $_POST['passe'], $_POST['passe2']); 
        }
/* 12. CONFIRM REGISTRATION ******************/
        elseif ($_GET['action'] == 'confirmRegistration') {
            confirmRegistration($_GET['id'], $_GET['token']); 
        }
/* 13. CONTACT *******************************/
        elseif ($_GET['action'] == 'contact') {
            contact($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
        }
/* 14. SEARCH ********************************/
        elseif ($_GET['action'] == 'search') {
            search($_POST['search']);
        }
/* 15 . PROFILE PAGE *************************/
        
        elseif ($_GET['action'] == 'profilePage') {
            profilePage($_SESSION['id']);
        }
/* 16 . DELETE ACCOUNT ***********************/

        elseif ($_GET['action'] == 'deleteAccount') {
            if (isset($_SESSION['id'])) {
                  deleteAccount($_SESSION['id']); 
            }
            else {
                $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet utilisateur !';
                profilePage();
                exit();
            }
        }
/* 17 . MODIFY PROFILE ***********************/

        elseif ($_GET['action'] == 'modifyProfile') {
            /*if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['flash']['danger'] = 'Votre email n\'est pas valide !';
                    profilePage();
                    exit();
            }
            else {
                // checkExistMail($_POST['email']);*/
                //if ($_POST['email'] == $_SESSION['email']) {
                
            modifyProfile($_POST['userId'], $_FILES['avatar']['name'], $_POST['first_name'], $_POST['name'], $_POST['email'], $_POST['description']);
        }
/* 18 . PUBLIC PROFILE ***********************/

        elseif ($_GET['action'] == 'publicProfile') {
            if (isset($_GET['id'])) {
                publicProfile($_GET['id']);
            }
        }

/* ********************************************
*           ADMINISTRATEUR                    *
**********************************************/
/* 1 . ADMIN HOME PAGE ***********************/
        elseif ($_GET['action'] == 'admin') {
            admin();
        }
/* 2 . GET POSTS *****************************/
        elseif ($_GET['action'] == 'manage_posts') {
            managePosts();
        }
/* 3 . GET COMMENTS **************************/
        elseif ($_GET['action'] == 'manage_comments') {
            manageComments();
        }
/* 4 . ADD A POST ****************************/
        elseif ($_GET['action'] == 'addpost') {
            addPost($_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content'], $_FILES['file_extension']['name']);
        }
/* 5 . MODIFY POST PAGE **********************/
        elseif ($_GET['action'] == 'modifyPostPage') {
                modifyPostPage($_GET['id']);
        }
/* 6 . MODIFY A POST *************************/
        elseif ($_GET['action'] == 'modifyPost') {
            modifyPost($_GET['id'], $_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content']);
        }       
/* 7 . DELETE A POST *************************/
        elseif ($_GET['action'] == 'deletePost') {
                deletePost($_GET['id']);
        }
/* 8 . VALIDATE A COMMENT ********************/
        elseif ($_GET['action'] == 'validateComment') {
                validateComment($_GET['id']);
        } 
/* 9 . DELETE A COMMENT **********************/
        elseif ($_GET['action'] == 'adminDeleteComment') {
                adminDeleteComment($_GET['id']);
        }
    }
/* ********************************************
*                    PAR DEFAUT               *
**********************************************/
/* 1 . HOME PAGE *****************************/
    else {
        home();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}