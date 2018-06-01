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
    function admin()
    {
        include 'view/backend/admin.php';
    }
/* *********** 2 . MANAGE POSTS PAGE **************/
    function managePosts()
    {
        $postManager = new PostManager();
        $postsTotal = $postManager->countPosts();
        $postsPerPage = 5;
        $totalPages = ceil($postsTotal / $postsPerPage);

        if(isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page'] > 0 ) AND ($_GET['page'] <= $totalPages)) 
        {
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
    function addPost($title, $chapo, $author, $content, $image)
    {
        $postManager = new PostManager();
        $session = new Session();
        $file_extension = $_FILES['file_extension'];
        $file_extension_error = $_FILES['file_extension']['error'];
        $file_extension_size = $_FILES['file_extension']['size'];
        $file_extension_tmp = $_FILES['file_extension']['tmp_name'];

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

            $affectedPost = $postManager->addPostRequest($title, $chapo, $author, $content, $image);

            if ($affectedPost === false) 
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
    function modifyPost($postId, $title, $chapo, $author, $content)
    {
        $postManager = new PostManager();
        $session = new Session();

        if (isset($postId) && $postId > 0) 
        {
            if (!empty($title) && !empty($content) && !empty($chapo)) 
            {
                $post = $postManager->getPost($postId);
                $success = $postManager->modifyPostRequest($postId, $title, $chapo, $author, $content);

                if ($success === false) 
                {
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
/* *********** 6 . DELETE A POST ******************/
    function deletePost($postId)
    {
        $postManager = new PostManager();
        $session = new Session();
        $success = $postManager->deletePostRequest($postId);
        $session = new Session();

        if (isset($postId) && $postId > 0) 
        {
            if ($success === false) 
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
/* *********** 7 . MANAGE COMMENTS PAGE ***********/
    function manageComments()
    {
        $commentManager = new CommentManager();
        $nbCount = $commentManager->countCommentBackRequest();
        $submittedComment = $commentManager->submittedCommentRequest();
        include 'view/backend/Comments/manageComments.php';
    }
/* *********** 8 . VALIDATE A COMMENT *************/
    function validateComment($commentId)
    {
        $commentManager = new CommentManager();
        $validated = $commentManager->validateCommentRequest($commentId);
        $session = new Session();
        if (isset($commentId) && $commentId > 0) 
        {
            if ($validated === false) 
            {
                $session->nonValidatedcomment();
            }
            else 
            {
                $session->validatedcomment();
            }
        }
        elseif ($commentId <= 0) 
        {
            $session->noIdCommentAdmin();
        }
    }
/* *********** 9 . DELETE A COMMENT ***************/
    function adminDeleteComment($commentId)
    {
        $commentManager = new CommentManager();
        $comment = $commentManager->getComment($commentId);
        $success = $commentManager->deleteCommentRequest($commentId);
        $session = new Session();

        if (isset($commentId) && $commentId > 0) 
        {
            if ($success === false) 
            {
                $session->adminNonDeletedComment();
            }
            else 
            {
                $session->admindeletedComment();
            }
        }
        elseif ($commentId <= 0) 
        {
            $session->noIdCommentAdmin();
        }
    }
/* ********** 10 . GET USERS **********************/
    function manageUsers(){
        $userManager = new \Philippe\Blog\Model\UserManager();
        $req = $userManager->getUsers();
        require('view/backend/Users/user_mgmt.php');
    }
/* ********** 11 . GIVE RIGHTS ADMIN **************/
    function giveAdminRights($userId){

        $userManager = new \Philippe\Blog\Model\UserManager();
        $adminRights = $userManager->giveAdminRightsRequest($userId);
        
        if ($adminRights === false) {
            throw new Exception('Impossible de donner les droits admin');
        }
        else {
            header('Location: index.php?action=manage_users');
        }
    }
/* ********** 12 . CANCEL RIGHTS ADMIN ************/
    function stopAdminRights($userId){

        $userManager = new \Philippe\Blog\Model\UserManager();
        $adminRights = $userManager->stopAdminRightsRequest($userId);
        
        if ($adminRights === false) {
            throw new Exception('Impossible de retirer les droits admin');
        }
        else {
            header('Location: index.php?action=manage_users');
        }
    }
/* ********** 13 . DELETE A USER ******************/
    function deleteUser($userId){

        $userManager = new \Philippe\Blog\Model\UserManager();
        $affectedUser = $userManager->deleteUserRequest($userId);
        if ($affectedUser === false){
            throw new Exception('Impossible de supprimer ce membre');
        }
        else {
            header('Location: index.php?action=manage_users');
        }
    }