<?php 
/* ************************* RESUME *************************************
1 . HOME. 
2 . MANAGE POSTS PAGE.
3 . ADD A POST.
4 . MODIFY POST PAGE.
5 . MODIFY A POST.
6 . DELETE A POST.
7 . MANAGE COMMENTS PAGE.
8 . VALIDATE A COMMENT.
9 . DELETE A COMMENT.
************************************************************************/

require "vendor/autoload.php";
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Model\SessionManager;
// use \Philippe\Blog\Model\MailManager;
// use \Philippe\Blog\Model\SecurityManager;
/* *********** 1 . HOME ***********************/
function admin()
{
    include 'view/backend/admin.php';
}
/* *********** 2 . MANAGE POSTS PAGE ************************/
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
    else {
        $currentPage = 1;
    }
    $start = ($currentPage-1)*$postsPerPage;
    $posts = $postManager->getPosts($start, $postsPerPage);
    include 'view/backend/Posts/managePosts.php';
}
/* *********** 3 . ADD A POST **********************************/
function addPost($title, $chapo, $author, $content, $image)
{
    $postManager = new PostManager();
    $file_extension = $_FILES['file_extension'];
    $file_extension_error = $_FILES['file_extension']['error'];
    $file_extension_size = $_FILES['file_extension']['size'];
    $file_extension_tmp = $_FILES['file_extension']['tmp_name'];
    if (!empty($title) && !empty($content) && !empty($chapo)) {
        // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
        if (isset($file_extension) AND $file_extension_error == 0) {
            // Testons si le fichier n'est pas trop gros
            if ($file_extension_size <= 1000000) {
                $infosfichier = pathinfo($image);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees)) {
                    // On peut valider le fichier et le stocker définitivement
                    move_uploaded_file($file_extension_tmp, 'public/images/posts/' . basename($image));
                    echo "L'envoi a bien été effectué !";
                }
            }
        }
        $affectedPost = $postManager->addPostRequest($title, $chapo, $author, $content, $image);
        if ($affectedPost === false) {
            throw new Exception('Impossible d\'ajouter l\'article');
        }
        else {
            header('Location: index.php?action=manage_posts#viewposts');
        }
    }
    else {
        $_SESSION['flash']['danger'] = 'Tous les champs ne sont pas remplis !';
        managePosts();
        exit();
    }
}
/* *********** 4 . MODIFY POST PAGE *******************/
function modifyPostPage($postId)
{
    $postManager = new PostManager();
    $post = $postManager->getPost($postId);
    if (empty($post) || $postId <= 0) {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
        managePosts();
        exit();
    }
    include 'view/backend/Posts/modifyPostPage.php';
}
/* *********** 5 . MODIFY A POST. *********************************/
function modifyPost($postId, $title, $chapo, $author, $content)
{
    $postManager = new PostManager();;
    if (isset($postId) && $postId > 0) {
        if (!empty($title) && !empty($content) && !empty($chapo)) {
            $post = $postManager->getPost($postId);
            $success = $postManager->modifyPostRequest($postId, $title, $chapo, $author, $content);
            if ($success === false) {
                throw new Exception('Impossible de modifier l\'article');
            }
            else {
                header('Location: index.php?action=manage_posts#viewposts');
            }
        }
        else {
            $_SESSION['flash']['danger'] = 'Veuillez remplir les champs !';
            modifyPostPage($postId);
            exit();
        }
    }
    else {
        $_SESSION['flash']['danger'] = 'Pas d\'identifiant d\'article envoyé !';
        modifyPostPage($_GET['id']);
        exit();
    }
}

/* *********** 6 . DELETE A POST ********************************/
function deletePost($postId)
{

    $postManager = new PostManager();
    $success = $postManager->deletePostRequest($postId);
    if (isset($postId) && $postId > 0) {
        if ($success === false) {
            throw new Exception('Impossible de supprimer l\'article');
        }
        else {
            header('Location: index.php?action=manage_posts#viewposts');
        }
    }
    elseif ($postId <= 0) {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
        managePosts();
        exit();
    }
}
/* *********** 7 . MANAGE COMMENTS PAGE ********************/
function manageComments()
{
    $commentManager = new CommentManager();
    $nbCount = $commentManager->countCommentBackRequest();
    $submittedcomments = $commentManager->submittedCommentRequest();
    include 'view/backend/Comments/manageComments.php';
}
/* *********** 8 . VALIDATE A COMMENT ******************************/
function validateComment($commentId)
{
    $commentManager = new CommentManager();
    $validated = $commentManager->validateCommentRequest($commentId);
    if (isset($commentId) && $commentId > 0) {
        if ($validated === false) {
            throw new Exception('Impossible de valider le commentaire');
        }
        else {
            header('Location: index.php?action=manage_comments');
        }
    }
    elseif ($commentId <= 0) {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce commentaire !';
        manageComments();
        exit();
    }
}
/* ********** 9 . DELETE A COMMENT ****************************/
function adminDeleteComment($commentId)
{

    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($commentId);
    $success = $commentManager->deleteCommentRequest($commentId);
    if (isset($commentId) && $commentId > 0) {
        if ($success === false) {
            throw new Exception('Impossible de supprimer le commentaire');
        }
        else {
            header('Location: index.php?action=manage_comments');
        }
    }
    elseif ($commentId <= 0) {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
        manageComments();
        exit();
    }
}