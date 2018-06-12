<?php 

use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CategoryManager;
use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Core\Session;
/**
 * Function admin
 *
 * @param accessAdminToken $accessAdminToken token to access admin's part
 * 
 * @return [type]
 */
function admin($accessAdminToken)
{
    $session = new Session();

    if (isset($_SESSION['accessAdminToken']) AND isset($accessAdminToken)  
        AND !empty($_SESSION['accessAdminToken']) AND !empty($accessAdminToken)
    ) {
        if ($_SESSION['accessAdminToken'] == $accessAdminToken) {
            if (!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ) {
                header('Location: index.php?action=noAdmin');
                exit();
            } else {
                include 'view/backend/admin.php';
            }
        } else {
            echo 'Erreur de vérification';
        }
    }
}
/**
 * Function managePosts
 * 
 * @return [type]
 */
function managePosts()
{
    $postManager = new PostManager();
    $categoryManager = new CategoryManager();
    $postsTotal = $postManager->countPosts();
    $postsPerPage = 5;
    $totalPages = ceil($postsTotal / $postsPerPage);
    $categories = $categoryManager->getCategoryRequest();

    if (isset($_GET['page']) AND !empty($_GET['page'])  
        AND ($_GET['page'] > 0 ) AND ($_GET['page'] <= $totalPages)
    ) {
        $_GET['page'] = intval($_GET['page']);
        $currentPage = $_GET['page'];
    } else {
        $currentPage = 1;
    }
    $start = ($currentPage-1)*$postsPerPage;
    $posts = $postManager->getPosts($start, $postsPerPage);
    include 'view/backend/Posts/managePosts.php';
}
/**
 * Function addPost
 * 
 * @param title            $title            the post's title we want to add
 * @param chapo            $chapo            the post's chapo we want to add
 * @param author           $author           post's writer
 * @param content          $content          the post's content we want to add
 * @param image            $image            the post's image we want to add
 * @param category         $category         the post's category we want to add
 * @param csrfAddPostToken $csrfAddPostToken the token to try to avoid csrf.
 *
 * @return [type]
 */
function addPost($title, $chapo, $author, $content, $image, $category, 
    $csrfAddPostToken
) {
    $postManager = new PostManager();
    $session = new Session();

    $file_extension = $_FILES['file_extension'];
    $file_extension_error = $_FILES['file_extension']['error'];
    $file_extension_size = $_FILES['file_extension']['size'];
    $file_extension_tmp = $_FILES['file_extension']['tmp_name'];

    if (isset($_SESSION['csrfAddPostToken']) AND isset($csrfAddPostToken) 
        AND !empty($_SESSION['csrfAddPostToken']) AND !empty($csrfAddPostToken)
    ) {
        if ($_SESSION['csrfAddPostToken'] == $csrfAddPostToken) {
            if (!empty($title) && !empty($content) && !empty($chapo)) {
                if (isset($file_extension) AND $file_extension_error == 0) {
                    if ($file_extension_size <= 1000000) {
                        $infosfichier = pathinfo($image);
                        $extension_upload = $infosfichier['extension'];
                        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                        if (in_array($extension_upload, $extensions_autorisees)) {
                            move_uploaded_file(
                                $file_extension_tmp,
                                'public/images/posts/' . basename($image)
                            );
                            echo "L'envoi a bien été effectué !";
                        }
                    }
                }
                $addedPost = $postManager->addPostRequest(
                    $title, $chapo, 
                    $author, $content, $category, $image
                );
                if ($addedPost === false) {
                    $session->nonAddedPost();
                } else {
                    $session->addedPost();
                }
            } else {
                $session->emptyContentsAdmin();
            }
        } else {
            $session->csrfPost();
        }
    }
}
/**
 * Function modifyPostPage
 * 
 * @param postId $postId the post's id
 *
 * @return [type]
 */
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
/**
 * Function modifyPost
 * 
 * @param postId              $postId              the id of the post we want to modify
 * @param title               $title               the title of the post we want to modify
 * @param chapo               $chapo               the chapo of the post we want to modify
 * @param author              $author              the author of the post we want to modify
 * @param content             $content             the content of the post we want to modify
 * @param csrfModifyPostToken $csrfModifyPostToken token to try to avoid csrf
 * 
 * @return [type]
 */
function modifyPost($postId, $title, $chapo, $author, $content, $csrfModifyPostToken)
{
    $postManager = new PostManager();
    $session = new Session();
    $_SESSION['csrfModifyPostToken'] = $csrfModifyPostToken; 
    if (isset($_SESSION['csrfModifyPostToken']) AND isset($csrfModifyPostToken)
        AND !empty($_SESSION['csrfModifyPostToken']) AND !empty($csrfModifyPostToken)
    ) {
        if ($_SESSION['csrfModifyPostToken'] == $csrfModifyPostToken) {
            if (isset($postId) && $postId > 0) {
                if (!empty($title) && !empty($content) && !empty($chapo)) {
                    $post = $postManager->getPost($postId);
                    $modify = $postManager->modifyPostRequest($postId, $title, $chapo, $author, $content);
                    if ($modify === false) {
                        $session->nonModifiedPost($postId);
                    } else {
                        $session->modifiedPost();
                    }
                } else {
                    $session->emptyContentModifiedPost($postId);
                }
            } else {
                $session->noIdModifiedPost($postId);
            }
        } else {
            $session->csrfModifyPost($postId);
        }
    }
}
/**
 * Function deletePost
 * 
 * @param postId              $postId              the post's id
 * @param csrfDeletePostToken $csrfDeletePostToken token to try to avoid csrf
 * 
 * @return [type]
 */
function deletePost($postId, $csrfDeletePostToken)
{
    $postManager = new PostManager();
    $session = new Session();
    $_SESSION['csrfDeletePostToken'] = $csrfDeletePostToken;
    if (isset($_SESSION['csrfDeletePostToken']) AND isset($csrfDeletePostToken)
        AND !empty($_SESSION['csrfDeletePostToken']) AND !empty($csrfDeletePostToken)
    ) {
        if ($_SESSION['csrfDeletePostToken'] == $csrfDeletePostToken) {
            if (isset($postId) && $postId > 0) {
                $post = $postManager->getPost($postId);
                $delete = $postManager->deletePostRequest($postId);
                if ($delete === false) {
                    $session->nonDeletedPost();
                } else {
                    $session->deletedPost();
                }
            } elseif ($postId <= 0) {
                $session->noIdPostAdmin();
            }
        } else {
            $session->deletePostCsrfError();
        }
    }
}
/**
 * Function manageComments
 * 
 * @return [type]
 */
function manageComments()
{
    $commentManager = new CommentManager();
    $nbCount = $commentManager->countCommentBackRequest();
    $submittedComment = $commentManager->submittedCommentRequest();
    include 'view/backend/Comments/manageComments.php';
}
/**
 * Function validateComment
 * 
 * @param commentId                $commentId                the comment's id
 * @param csrfValidateCommentToken $csrfValidateCommentToken the token to try to avoid csrf
 * 
 * @return [type]
 */
function validateComment($commentId, $csrfValidateCommentToken)
{
    $commentManager = new CommentManager();
    $validated = $commentManager->validateCommentRequest($commentId);
    $session = new Session();
    $_SESSION['csrfValidateCommentToken'] = $csrfValidateCommentToken;
    if (isset($_SESSION['csrfValidateCommentToken'])  
        AND isset($csrfValidateCommentToken)
        AND !empty($_SESSION['csrfValidateCommentToken']) AND !empty($csrfValidateCommentToken)
    ) {
        if ($_SESSION['csrfValidateCommentToken'] == $csrfValidateCommentToken) {
            if (isset($commentId) && $commentId > 0) {
                if ($validated === false) {
                    $session->nonValidatedcomment();
                } else {
                    $session->validatedcomment();
                }
            } elseif ($commentId <= 0) {
                $session->noIdCommentAdmin();
            }
        } else {
            $session->validateCommentCsrfError();
        }
    }
}
/**
 * Function adminDeleteComment
 * 
 * @param commentId                   $commentId                   the comment's id
 * @param csrfAdminDeleteCommentToken $csrfAdminDeleteCommentToken the token to try to avoid csrf
 * 
 * @return [type]
 */
function adminDeleteComment($commentId, $csrfAdminDeleteCommentToken)
{
    $commentManager = new CommentManager();
    $commentManager->getComment($commentId);
    $session = new Session();
    $_SESSION['csrfAdminDeleteCommentToken'] = $csrfAdminDeleteCommentToken;
    if (isset($_SESSION['csrfAdminDeleteCommentToken']) AND isset($csrfAdminDeleteCommentToken)
        AND !empty($_SESSION['csrfAdminDeleteCommentToken']) AND !empty($csrfAdminDeleteCommentToken)
    ) {
        if ($_SESSION['csrfAdminDeleteCommentToken'] == $csrfAdminDeleteCommentToken) {
            if (isset($commentId) && $commentId > 0) {
                $success = $commentManager->deleteCommentRequest($commentId);
                if ($success === false) {
                    $session->adminNonDeletedComment();
                } else {   
                    $session->admindeletedComment();
                }
            } elseif ($commentId <= 0) {
                $session->noIdCommentAdmin();
            }
        } else {
            $session->adminDeleteCommentCsrfError();
        }
    }
}
/**
 * Function manageUsers
 * 
 * @return [type]
 */
function manageUsers()
{
    $userManager = new UserManager();
    $users = $userManager->getUsers();
    include 'view/backend/Users/user_mgmt.php';
}
/**
 * Function giveAdminRights
 * 
 * @param userId                   $userId                   the user's id
 * @param csrfGiveAdminRightsToken $csrfGiveAdminRightsToken the token to try to avoid csrf
 * 
 * @return [type]
 */
function giveAdminRights($userId, $csrfGiveAdminRightsToken)
{
    $userManager = new UserManager();
    $session = new Session();
    $_SESSION['csrfGiveAdminRightsToken'] = $csrfGiveAdminRightsToken;
    if (isset($_SESSION['csrfGiveAdminRightsToken']) AND isset($csrfGiveAdminRightsToken)
        AND !empty($_SESSION['csrfGiveAdminRightsToken']) AND !empty($csrfGiveAdminRightsToken)
    ) {
        if ($_SESSION['csrfGiveAdminRightsToken'] == $csrfGiveAdminRightsToken) {
            if (isset($userId) && $userId > 0) {
                $adminRights = $userManager->giveAdminRightsRequest($userId);

                if ($adminRights === false) {
                    throw new Exception('Impossible de donner les droits admin');
                } else {
                    header('Location: index.php?action=manage_users');
                }
            }
        } else {
            $session->giveAdminRightsCsrfError();
        }
    }
}
/**
 * Function stopAdminRights
 * 
 * @param userId                     $userId                     the user's id
 * @param csrfCancelAdminRightsToken $csrfCancelAdminRightsToken the token to try to avoid csrf
 * 
 * @return [type]
 */
function stopAdminRights($userId, $csrfCancelAdminRightsToken)
{
    $userManager = new UserManager();
    $session = new Session();
    $_SESSION['csrfCancelAdminRightsToken'] = $csrfCancelAdminRightsToken;
    if (isset($_SESSION['csrfCancelAdminRightsToken']) AND isset($csrfCancelAdminRightsToken)
        AND !empty($_SESSION['csrfCancelAdminRightsToken']) AND !empty($csrfCancelAdminRightsToken)
    ) {
        if ($_SESSION['csrfCancelAdminRightsToken'] == $csrfCancelAdminRightsToken) {
            if (isset($userId) && $userId > 0) {
                $adminRights = $userManager->stopAdminRightsRequest($userId);

                if ($adminRights === false) {
                    throw new Exception('Impossible de retirer les droits admin');
                } else {
                    header('Location: index.php?action=manage_users');
                }
            }
        } else {
            $session->cancelAdminRightsCsrfError();
        }
    }
}
/**
 * Function deleteUser
 * 
 * @param userId              $userId              the user's id
 * @param csrfDeleteUserToken $csrfDeleteUserToken the token to try to avoid csrf.
 * 
 * @return [type]
 */
function deleteUser($userId, $csrfDeleteUserToken)
{
    $userManager = new UserManager();
    $_SESSION['csrfDeleteUserToken'] = $csrfDeleteUserToken;
    if (isset($_SESSION['csrfDeleteUserToken']) AND isset($csrfDeleteUserToken)
        AND !empty($_SESSION['csrfDeleteUserToken']) AND !empty($csrfDeleteUserToken)
    ) {
        if ($_SESSION['csrfDeleteUserToken'] == $csrfDeleteUserToken) {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $affectedUser = $userManager->deleteUserRequest($userId);

                if ($affectedUser === false) {
                    throw new Exception('Impossible de supprimer ce membre');
                } else {
                    header('Location: index.php?action=manage_users');
                }
            }
        } else {
            $session->deleteUserCsrfError();
        }
    }
}
/**
 * Function addCategory
 * 
 * @param category             $category             the post's category
 * @param csrfAddCategoryToken $csrfAddCategoryToken the token to try to avoid csrf
 *
 * @return [type]
 */
function addCategory($category, $csrfAddCategoryToken)
{
    $categoryManager = new CategoryManager();
    $session = new Session();
    $_SESSION['csrfAddCategoryToken'] = $csrfAddCategoryToken; 
    if (isset($_SESSION['csrfAddCategoryToken']) AND isset($csrfAddCategoryToken)
        AND !empty($_SESSION['csrfAddCategoryToken']) AND !empty($csrfAddCategoryToken)
    ) {
        
        if ($_SESSION['csrfAddCategoryToken'] == $csrfAddCategoryToken) {
            if (!empty($category)) {
                $categoryManager->addCategoryRequest($category);
                if ($categoryManager === false) {
                        $session->nonAddedCategory();
                } else {
                    $session->addedCategory();
                }
            } else {
                $session->emptyCategory();
            }
        } else {
            $session->csrfPost();
        }
    }    
}