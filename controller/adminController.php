<?php 
/* **************** SUM UP *************************
1 . HOME. 
2 . MANAGE POSTS PAGE.
3 . ADD A POST.
4 . MODIFY POST PAGE.
5 . MODIFY A POST.
6 . DELETE A POST.
7 . MANAGE COMMENTS PAGE.
8 . VALIDATE A COMMENT.
9 . DELETE A COMMENT.
10 . GET USERS.
11 . GIVE RIGHTS ADMIN.
12 . CANCEL RIGHTS ADMIN.
13 . DELETE A USER.
******************* END SUM UP ********************/

use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Core\Session;
/* *********** 1 . HOME ***************************/
function admin($accessAdminToken)
{
    $session = new Session();

    if (isset($_SESSION['accessAdminToken']) AND isset($accessAdminToken) AND !empty($_SESSION['accessAdminToken']) AND !empty($accessAdminToken)) 
    {
        if ($_SESSION['accessAdminToken'] == $accessAdminToken) 
        {
            if(!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ) {
                header('Location: index.php?action=noAdmin');
                exit();
            }
            else
            {
                include 'view/backend/admin.php';
            }
        }
        else
        {
            echo 'Erreur de vérification';
        }
    }
}
/* *********** 2 . MANAGE POSTS PAGE **************/
function managePosts()
{
    $postManager = new PostManager();
    $postsTotal = $postManager->countPosts();
    $postsPerPage = 5;
    $totalPages = ceil($postsTotal / $postsPerPage);

    if(isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page'] > 0 ) AND ($_GET['page'] <= $totalPages)) {
        $_GET['page'] = intval($_GET['page']);
        $currentPage = $_GET['page'];
    }
    else 
    {
        $currentPage = 1;
    }

    $start = ($currentPage-1)*$postsPerPage;
    $posts = $postManager->getPosts($start, $postsPerPage);
    include 'view/backend/Posts/managePosts.php';
}
/* *********** 3 . ADD A POST *********************/
function addPost($title, $chapo, $author, $content, $image, $csrfAddPostToken)
{
    $postManager = new PostManager();
    $session = new Session();
    $file_extension = $_FILES['file_extension'];
    $file_extension_error = $_FILES['file_extension']['error'];
    $file_extension_size = $_FILES['file_extension']['size'];
    $file_extension_tmp = $_FILES['file_extension']['tmp_name'];

    if (isset($_SESSION['csrfAddPostToken']) AND isset($csrfAddPostToken) AND !empty($_SESSION['csrfAddPostToken']) AND !empty($csrfAddPostToken)) 
    {
        if ($_SESSION['csrfAddPostToken'] == $csrfAddPostToken) 
        {
            if (!empty($title) && !empty($content) && !empty($chapo)) 
            {
                if (isset($file_extension) AND $file_extension_error == 0) 
                {
                    if ($file_extension_size <= 1000000) 
                    {
                        $infosfichier = pathinfo($image);
                        $extension_upload = $infosfichier['extension'];
                        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

                        if (in_array($extension_upload, $extensions_autorisees)) 
                        {
                            // On peut valider le fichier et le stocker définitivement
                            move_uploaded_file($file_extension_tmp, 'public/images/posts/' . basename($image));
                            echo "L'envoi a bien été effectué !";
                        }
                    }
                }

                $addedPost = $postManager->addPostRequest($title, $chapo, $author, $content, $image);

                if ($addedPost === false) 
                {
                    $session->nonAddedPost();
                }
                else 
                {
                    $session->addedPost();
                }
            }
            else 
            {
                $session->emptyContentsAdmin();
            }
        }
        else
        {
            $session->csrfPost();
        }
    }
}
/* *********** 4 . MODIFY POST PAGE ***************/
function modifyPostPage($postId)
{
    $postManager = new PostManager();
    $post = $postManager->getPost($postId);
    $session = new Session();

    if (empty($post) || $postId <= 0) {
        $session->noIdPostAdmin();
    }
    include 'view/backend/Posts/modifyPostPage.php';
}
/* *********** 5 . MODIFY A POST. *****************/
function modifyPost($postId, $title, $chapo, $author, $content, $csrfModifyPostToken)
{
    $postManager = new PostManager();
    $session = new Session();
    if (isset($_SESSION['csrfModifyPostToken']) AND isset($csrfModifyPostToken) AND !empty($_SESSION['csrfModifyPostToken']) AND !empty($csrfModifyPostToken)) 
    {
        if ($_SESSION['csrfModifyPostToken'] == $csrfModifyPostToken) 
        {
            if (isset($postId) && $postId > 0) {
                if (!empty($title) && !empty($content) && !empty($chapo)) {
                    $post = $postManager->getPost($postId);
                    $modify = $postManager->modifyPostRequest($postId, $title, $chapo, $author, $content);

                    if ($modify === false) {
                        $session->nonModifiedPost($postId);
                    }
                    else 
                    {
                        $session->modifiedPost();
                    }
                }
                else 
                {
                    $session->emptyContentModifiedPost($postId);
                }
            }
            else 
            {
                $session->noIdModifiedPost($postId);
            }
        }
        else
        {
            $session->csrfModifyPost($postId);
        }
    }
}
/* *********** 6 . DELETE A POST ******************/
function deletePost($postId, $csrfDeletePostToken)
{
    $postManager = new PostManager();
    $session = new Session();
    $_SESSION['csrfDeletePostToken'] = $csrfDeletePostToken;
    if (isset($_SESSION['csrfDeletePostToken']) AND isset($csrfDeletePostToken) AND !empty($_SESSION['csrfDeletePostToken']) AND !empty($csrfDeletePostToken)) 
    {
        if ($_SESSION['csrfDeletePostToken'] == $csrfDeletePostToken) 
        {
            if (isset($postId) && $postId > 0) 
            {
                $post = $postManager->getPost($postId);
                $delete = $postManager->deletePostRequest($postId);
                if ($delete === false) 
                {
                    $session->nonDeletedPost();
                }
                else 
                {
                    $session->deletedPost();
                }
            }
            elseif ($postId <= 0) 
            {
                $session->noIdPostAdmin();
            }
        }
        else
        {
            $session->deletePostCsrfError();
        }
    }
}
/* *********** 7 . MANAGE COMMENTS PAGE ***********/
function manageComments()
{
    $commentManager = new CommentManager();
    $nbCount = $commentManager->countCommentBackRequest();
    $submittedComment = $commentManager->submittedCommentRequest();
    include 'view/backend/Comments/manageComments.php';
}
/* *********** 8 . VALIDATE A COMMENT *************/
function validateComment($commentId, $csrfValidateCommentToken)
{
    $commentManager = new CommentManager();
    $validated = $commentManager->validateCommentRequest($commentId);
    $session = new Session();
    $_SESSION['csrfValidateCommentToken'] = $csrfValidateCommentToken;
    if (isset($_SESSION['csrfValidateCommentToken']) AND isset($csrfValidateCommentToken) AND !empty($_SESSION['csrfValidateCommentToken']) AND !empty($csrfValidateCommentToken)) 
    {
        if ($_SESSION['csrfValidateCommentToken'] == $csrfValidateCommentToken) 
        {
            if (isset($commentId) && $commentId > 0) {
                if ($validated === false) {
                    $session->nonValidatedcomment();
                }
                else 
                {
                    $session->validatedcomment();
                }
            }
            elseif ($commentId <= 0) {
                $session->noIdCommentAdmin();
            }
        }
        else
        {
            $session->validateCommentCsrfError();
        }
    }
}
/* *********** 9 . DELETE A COMMENT ***************/
function adminDeleteComment($commentId, $csrfAdminDeleteCommentToken)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($commentId);
    $session = new Session();
    $_SESSION['csrfAdminDeleteCommentToken'] = $csrfAdminDeleteCommentToken;
    if (isset($_SESSION['csrfAdminDeleteCommentToken']) AND isset($csrfAdminDeleteCommentToken) AND !empty($_SESSION['csrfAdminDeleteCommentToken']) AND !empty($csrfAdminDeleteCommentToken)) 
    {
        if ($_SESSION['csrfAdminDeleteCommentToken'] == $csrfAdminDeleteCommentToken) 
        {
            if (isset($commentId) && $commentId > 0) {
                if ($success === false) {
                    $session->adminNonDeletedComment();
                }
                else 
                {   
                    $success = $commentManager->deleteCommentRequest($commentId);
                    $session->admindeletedComment();
                }
            }
            elseif ($commentId <= 0) {
                $session->noIdCommentAdmin();
            }
        }
        else
        {
            $session->adminDeleteCommentCsrfError();
        }
    }
}
/* ********** 10 . GET USERS **********************/
function manageUsers()
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $users = $userManager->getUsers();
    include 'view/backend/Users/user_mgmt.php';
}
/* ********** 11 . GIVE RIGHTS ADMIN **************/
function giveAdminRights($userId, $csrfGiveAdminRightsToken)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $session = new Session();
    $_SESSION['csrfGiveAdminRightsToken'] = $csrfGiveAdminRightsToken;
    if (isset($_SESSION['csrfGiveAdminRightsToken']) AND isset($csrfGiveAdminRightsToken) AND !empty($_SESSION['csrfGiveAdminRightsToken']) AND !empty($csrfGiveAdminRightsToken)) 
    {
        if ($_SESSION['csrfGiveAdminRightsToken'] == $csrfGiveAdminRightsToken) 
        {
            if (isset($userId) && $userId > 0) {
                $adminRights = $userManager->giveAdminRightsRequest($userId);

                if ($adminRights === false) {
                    throw new Exception('Impossible de donner les droits admin');
                }
                else 
                {
                    header('Location: index.php?action=manage_users');
                }
            }
        }
        else
        {
            $session->giveAdminRightsCsrfError();
        }
    }
}
/* ********** 12 . CANCEL RIGHTS ADMIN ************/
function stopAdminRights($userId, $csrfCancelAdminRightsToken)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $session = new Session();
    $_SESSION['csrfCancelAdminRightsToken'] = $csrfCancelAdminRightsToken;
    if (isset($_SESSION['csrfCancelAdminRightsToken']) AND isset($csrfCancelAdminRightsToken) AND !empty($_SESSION['csrfCancelAdminRightsToken']) AND !empty($csrfCancelAdminRightsToken)) 
    {
        if ($_SESSION['csrfCancelAdminRightsToken'] == $csrfCancelAdminRightsToken) 
        {
            if (isset($userId) && $userId > 0) {
                $adminRights = $userManager->stopAdminRightsRequest($userId);

                if ($adminRights === false) {
                    throw new Exception('Impossible de retirer les droits admin');
                }
                else 
                {
                    header('Location: index.php?action=manage_users');
                }
            }
        }
        else
        {
            $session->cancelAdminRightsCsrfError();
        }
    }
}
/* ********** 13 . DELETE A USER ******************/
function deleteUser($userId, $csrfDeleteUserToken)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $_SESSION['csrfDeleteUserToken'] = $csrfDeleteUserToken;
    if (isset($_SESSION['csrfDeleteUserToken']) AND isset($csrfDeleteUserToken) AND !empty($_SESSION['csrfDeleteUserToken']) AND !empty($csrfDeleteUserToken)) 
    {
        if ($_SESSION['csrfDeleteUserToken'] == $csrfDeleteUserToken) 
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                $affectedUser = $userManager->deleteUserRequest($userId);

                if ($affectedUser === false) {
                    throw new Exception('Impossible de supprimer ce membre');
                }
                else {
                    header('Location: index.php?action=manage_users');
                }
            }
        }
        else
        {
            $session->deleteUserCsrfError();
        }
    }
}