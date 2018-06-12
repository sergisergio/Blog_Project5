<?php
session_start();
require "vendor/autoload.php";
//require_once 'core/Cookie.php';
//reconnect_from_cookie(); 

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
19. FORGET PASSWORD PAGE.
20. FORGET PASSWORD MAIL.
21. CHANGE PASSWORD PAGE.
22. CHANGE PASSWORD.
23. DELETE USER.
24. CATEGORIES RESULTS.
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
10. GET USERS.
11. GIVE RIGHTS ADMIN.
12. CANCEL RIGHTS ADMIN.
13. DELETE USER.
14. ADD CATEGORY.
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
require 'controller/categoryController.php';
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
            addComment($_GET['id'], $_SESSION['id'], $_POST['content'], $_POST['token']);
        }
        /* 4 . MODIFY COMMENT PAGE *******************/
        elseif ($_GET['action'] == 'modifyCommentPage') {
            modifyCommentPage($_GET['id'], $_GET['postId']);

        }
        /* 5 . DELETE A COMMENT **********************/
        elseif ($_GET['action'] == 'deleteComment') {
            deleteComment($_GET['id'], $_GET['postId'], $_GET['token']);
        }
        /* 6 . MODIFY A COMMENT **********************/
        elseif ($_GET['action'] == 'modifyComment') {
            modifyComment($_GET['id'], $_SESSION['id'], $_POST['content'], $_GET['postId'], $_POST['token']);
        }
        /* 7 . CONNECTION PAGE ***********************/
        elseif ($_GET['action'] == 'loginPage') {
            loginPage();
        }
        /* 8 . CONNECTION ****************************/
        elseif ($_GET['action'] == 'login') {
            login($_POST['pseudo'], $_POST['passe'], $_SERVER['REMOTE_ADDR'], $_POST['token'], $_POST['remember']);
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
             addUser($_POST['pseudo'], $_POST['email'], $_POST['passe'], $_POST['passe2'], $_POST['token']); 
        }
        /* 12. CONFIRM REGISTRATION ******************/
        elseif ($_GET['action'] == 'confirmRegistration') {
            confirmRegistration($_GET['id'], $_GET['token']); 
        }
        /* 13. CONTACT *******************************/
        elseif ($_GET['action'] == 'contact') {
            contact($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'], $_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
        }
        /* 14. SEARCH ********************************/
        elseif ($_GET['action'] == 'search') {
            search($_POST['search'], $_POST['token']);
        }
        /* 15 . PROFILE PAGE *************************/
        elseif ($_GET['action'] == 'profilePage') {
            profilePage($_SESSION['id']);
        }
        /* 16 . DELETE ACCOUNT ***********************/
        elseif ($_GET['action'] == 'deleteAccount') {
                  deleteAccount($_SESSION['id'], $_POST['token']);   
        }
        /* 17 . MODIFY PROFILE ***********************/

        elseif ($_GET['action'] == 'modifyProfile') {
            modifyProfile($_POST['userId'], $_FILES['avatar']['name'], $_POST['first_name'], $_POST['name'], $_POST['email'], $_POST['description'], $_POST['token']);
        }
        /* 18 . PUBLIC PROFILE ***********************/
        elseif ($_GET['action'] == 'publicProfile') {
            if (isset($_GET['id'])) {
                publicProfile($_GET['id']);
            }
        }
        /* 19 . FORGET PASSWORD PAGE *****************/
        elseif ($_GET['action'] == 'forgetPasswordPage') {
            forgetPasswordPage();
        }
        /* 20 . FORGET PASSWORD MAIL *****************/
        elseif ($_GET['action'] == 'forgetPassword') {
                forgetPassword($_POST['email'], $_POST['token']);
        }
        /* 21 . CHANGE PASSWORD PAGE *****************/
        elseif ($_GET['action'] == 'changePasswordPage') {
                changePasswordPage($_GET['id'], $_GET['token']);
        }
        /* 22 . CHANGE PASSWORD **********************/
        elseif ($_GET['action'] == 'changePassword') {
            changePassword($_POST['userId'], $_POST['passe'], $_POST['token']);
        }
        /* 23 . NO ADMIN ****************************/
        elseif ($_GET['action'] == 'noAdmin') {
            noAdmin();
        }
        /* 24 . CATEGORY RESULTS ********************/
        elseif ($_GET['action'] == 'categoryresults') {
            categoryResults($_GET['id']);
        }

        /* ********************************************
        *           ADMINISTRATEUR                    *
        **********************************************/
        /* 1 . ADMIN HOME PAGE ***********************/
        elseif ($_GET['action'] == 'admin') {
            admin($_GET['token']);
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
            addPost($_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content'], $_FILES['file_extension']['name'], $_POST['category'], $_POST['token']);
        }
        /* 5 . MODIFY POST PAGE **********************/
        elseif ($_GET['action'] == 'modifyPostPage') {
                modifyPostPage($_GET['id']);
        }
        /* 6 . MODIFY A POST *************************/
        elseif ($_GET['action'] == 'modifyPost') {
            modifyPost($_GET['id'], $_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content'], $_POST['token']);
        }       
        /* 7 . DELETE A POST *************************/
        elseif ($_GET['action'] == 'deletePost') {
            deletePost($_GET['id'], $_GET['token']);
        }
        /* 8 . VALIDATE A COMMENT ********************/
        elseif ($_GET['action'] == 'validateComment') {
            validateComment($_GET['id'], $_GET['token']);
        } 
        /* 9 . DELETE A COMMENT **********************/
        elseif ($_GET['action'] == 'adminDeleteComment') {
            adminDeleteComment($_GET['id'], $_GET['token']);
        }
        /* 10. GET USERS *****************************/
        elseif ($_GET['action'] == 'manage_users') {
            manageUsers();
        }
        /* 11. GIVE RIGHTS ADMIN *********************/
        elseif ($_GET['action'] == 'giveAdminRights') {
            giveAdminRights($_GET['id'], $_GET['token']);
        }
        /* 12. CANCEL RIGHTS ADMIN *******************/
        elseif ($_GET['action'] == 'cancelAdminRights') {
            stopAdminRights($_GET['id'], $_GET['token']);
        }
        /* 13. DELETE USER ***************************/
        elseif ($_GET['action'] == 'deleteUser') {
            deleteUser($_GET['id'], $_GET['token']);
        }
        /* 14. ADD CATEGORY **************************/
        elseif ($_GET['action'] == 'addcategory') {
            addCategory($_POST['category'], $_POST['token']);
        }
    }
    /* ********************************************
    *                    PAR DEFAUT               *
    **********************************************/
    /* 1 . HOME PAGE *****************************/
    else {
        home();
    }
} catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}