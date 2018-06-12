<?php
session_start();
require "vendor/autoload.php";

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
        if ($_GET['action'] == 'blog') {
            listPosts();
        } elseif ($_GET['action'] == 'blogpost') {
            listPost($_GET['id']);
        } elseif ($_GET['action'] == 'addcomment') {
            addComment(
                $_GET['id'], $_SESSION['id'], $_POST['content'],
                $_POST['token']
            );
        } elseif ($_GET['action'] == 'modifyCommentPage') {
            modifyCommentPage($_GET['id'], $_GET['postId']);
        } elseif ($_GET['action'] == 'deleteComment') {
            deleteComment($_GET['id'], $_GET['postId'], $_GET['token']);
        } elseif ($_GET['action'] == 'modifyComment') {
            modifyComment(
                $_GET['id'], $_SESSION['id'], $_POST['content'],
                $_GET['postId'], $_POST['token']
            );
        } elseif ($_GET['action'] == 'loginPage') {
            loginPage();
        } elseif ($_GET['action'] == 'login') {
            login(
                $_POST['pseudo'], $_POST['passe'], $_SERVER['REMOTE_ADDR'],
                $_POST['token'], $_POST['remember']
            );
        } elseif ($_GET['action'] == 'logout') {
            logout();
        } elseif ($_GET['action'] == 'signupPage') {
             signupPage();
        } elseif ($_GET['action'] == 'addUser') {
            addUser(
                $_POST['pseudo'], $_POST['email'], $_POST['passe'],
                $_POST['passe2'], $_POST['token']
            ); 
        } elseif ($_GET['action'] == 'confirmRegistration') {
            confirmRegistration($_GET['id'], $_GET['token']); 
        } elseif ($_GET['action'] == 'contact') {
            contact(
                $_POST['name'], $_POST['email'], $_POST['subject'],
                $_POST['message'], $_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']
            );
        } elseif ($_GET['action'] == 'search') {
            search($_POST['search'], $_POST['token']);
        } elseif ($_GET['action'] == 'profilePage') {
            profilePage($_SESSION['id']);
        } elseif ($_GET['action'] == 'deleteAccount') {
                  deleteAccount($_SESSION['id'], $_POST['token']);   
        } elseif ($_GET['action'] == 'modifyProfile') {
            modifyProfile(
                $_POST['userId'], $_FILES['avatar']['name'],
                $_POST['first_name'], $_POST['name'], $_POST['email'],
                $_POST['description'], $_POST['token']
            );
        } elseif ($_GET['action'] == 'publicProfile') {
            if (isset($_GET['id'])) {
                publicProfile($_GET['id']);
            }
        } elseif ($_GET['action'] == 'forgetPasswordPage') {
            forgetPasswordPage();
        } elseif ($_GET['action'] == 'forgetPassword') {
                forgetPassword($_POST['email'], $_POST['token']);
        } elseif ($_GET['action'] == 'changePasswordPage') {
                changePasswordPage($_GET['id'], $_GET['token']);
        } elseif ($_GET['action'] == 'changePassword') {
            changePassword($_POST['userId'], $_POST['passe'], $_POST['token']);
        } elseif ($_GET['action'] == 'noAdmin') {
            noAdmin();
        } elseif ($_GET['action'] == 'categoryresults') {
            categoryResults($_GET['id']);
        } elseif ($_GET['action'] == 'admin') {
            admin($_GET['token']);
        } elseif ($_GET['action'] == 'manage_posts') {
            managePosts();
        } elseif ($_GET['action'] == 'manage_comments') {
            manageComments();
        } elseif ($_GET['action'] == 'addpost') {
            addPost(
                $_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content'],
                $_FILES['file_extension']['name'], $_POST['category'], $_POST['token']
            );
        } elseif ($_GET['action'] == 'modifyPostPage') {
                modifyPostPage($_GET['id']);
        } elseif ($_GET['action'] == 'modifyPost') {
            modifyPost(
                $_GET['id'], $_POST['title'], $_POST['chapo'],
                $_SESSION['id'], $_POST['content'], $_POST['token']
            );
        } elseif ($_GET['action'] == 'deletePost') {
            deletePost($_GET['id'], $_GET['token']);
        } elseif ($_GET['action'] == 'validateComment') {
            validateComment($_GET['id'], $_GET['token']);
        } elseif ($_GET['action'] == 'adminDeleteComment') {
            adminDeleteComment($_GET['id'], $_GET['token']);
        } elseif ($_GET['action'] == 'manage_users') {
            manageUsers();
        } elseif ($_GET['action'] == 'giveAdminRights') {
            giveAdminRights($_GET['id'], $_GET['token']);
        } elseif ($_GET['action'] == 'cancelAdminRights') {
            stopAdminRights($_GET['id'], $_GET['token']);
        } elseif ($_GET['action'] == 'deleteUser') {
            deleteUser($_GET['id'], $_GET['token']);
        } elseif ($_GET['action'] == 'addcategory') {
            addCategory($_POST['category'], $_POST['token']);
        }
    } else {
        home();
    }
} catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}