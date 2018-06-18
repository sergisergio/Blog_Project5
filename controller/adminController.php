<?php 
/**
 * My own blog.
 *
 * Administrator Controller
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
use \Philippe\Blog\Lib\Model\UserManager;
use \Philippe\Blog\Lib\Model\PostManager;
use \Philippe\Blog\Lib\Model\CategoryManager;
use \Philippe\Blog\Lib\Model\CommentManager;
use \Philippe\Blog\Lib\Core\Session;
/**
 * Enter the admin part
 *
 * @param int $accessAdminToken token to access admin's part
 * 
 * @return int
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
                include 'App/backend/admin.php';
            }
        } else {
            echo 'Erreur de vérification';
        }
    }
}
/**
 * Show the Post management's part
 * 
 * @return mixed
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
    include 'App/backend/Modules/Posts/managePosts.php';
}
/**
 * Add a post
 * 
 * @param string $title            the post's title we want to add
 * @param string $chapo            the post's chapo we want to add
 * @param string $author           post's writer
 * @param string $content          the post's content we want to add
 * @param string $image            the post's image we want to add
 * @param string $category         the post's category we want to add
 * @param string $csrfAddPostToken the token to try to avoid csrf.
 *
 * @return mixed
 */
function addPost($title, $chapo, $author, $content, $image, $category, $csrfAddPostToken) 
{
    $postManager = new PostManager();
    $_SESSION['csrfAddPostToken'] = $csrfAddPostToken; 
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
                    $_SESSION['flash']['danger'] = 'impossible d\'ajouter l\'article !';
                    managePosts();
                } else {
                    $_SESSION['flash']['success'] = 'L\'article a bien été ajouté !';
                    managePosts();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Un ou plusieurs champs ne sont pas remplis !';
                errors();
            }
        } else {
            $_SESSION['flash']['danger'] = 'Erreur de vérification !';
            header('Location: index.php?action=manage_posts');
            exit();
        }
    }
}
/**
 * Function modifyPostPage
 * 
 * @param int $postId the post's id
 *
 * @return int
 */
function modifyPostPage($postId)
{
    $postManager = new PostManager();
    $post = $postManager->getPost($postId);
    $session = new Session();

    if (empty($post) || $postId <= 0) {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
        managePosts();
    }
    include 'App/backend/Modules/Posts/modifyPostPage.php';
}
/**
 * Modify a post
 * 
 * @param int    $postId              the id of the post we want to modify
 * @param string $title               the title of the post we want to modify
 * @param string $chapo               the chapo of the post we want to modify
 * @param string $author              the author of the post we want to modify
 * @param string $content             the content of the post we want to modify
 * @param string $csrfModifyPostToken token to try to avoid csrf
 * 
 * @return mixed
 */
function modifyPost($postId, $title, $chapo, $author, $content, $csrfModifyPostToken)
{
    $postManager = new PostManager();
    $_SESSION['csrfModifyPostToken'] = $csrfModifyPostToken; 
    if (isset($_SESSION['csrfModifyPostToken']) AND isset($csrfModifyPostToken)
        AND !empty($_SESSION['csrfModifyPostToken']) AND !empty($csrfModifyPostToken)
    ) {
        if ($_SESSION['csrfModifyPostToken'] == $csrfModifyPostToken) {
            if (isset($postId) && $postId > 0) {
                if (!empty($title) && !empty($content) && !empty($chapo)) {
                    $postManager->getPost($postId);
                    $modify = $postManager->modifyPostRequest($postId, $title, $chapo, $author, $content);
                    if ($modify === false) {
                        $_SESSION['flash']['danger'] = 'Impossible de modifier l\'article';
                        modifyPostPage($postId);
                    } else {
                        $_SESSION['flash']['success'] = 'L\'article a bien été modifié !';
                        header('Location: index.php?action=manage_posts');
                        exit();
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Veuillez remplir les champs !';
                    modifyPostPage($postId);
                }
            } else {
                $_SESSION['flash']['danger'] = 'Pas d\'identifiant d\'article envoyé !';
                modifyPostPage($postId);
            }
        } else {
            $_SESSION['flash']['danger'] = 'Erreur de vérification !';
            modifyPostPage($postId);
        }
    }
}
/**
 * Delete a post
 * 
 * @param int    $postId              the post's id
 * @param string $csrfDeletePostToken token to try to avoid csrf
 * 
 * @return mixed
 */
function deletePost($postId, $csrfDeletePostToken)
{
    $postManager = new PostManager();
    $_SESSION['csrfDeletePostToken'] = $csrfDeletePostToken;
    if (isset($_SESSION['csrfDeletePostToken']) AND isset($csrfDeletePostToken)
        AND !empty($_SESSION['csrfDeletePostToken']) AND !empty($csrfDeletePostToken)
    ) {
        if ($_SESSION['csrfDeletePostToken'] == $csrfDeletePostToken) {
            if (isset($postId) && $postId > 0) {
                $postManager->getPost($postId);
                $delete = $postManager->deletePostRequest($postId);
                if ($delete === false) {
                    $_SESSION['flash']['danger'] = 'Impossible de supprimer l\'article';
                    header('Location: index.php?action=manage_posts');
                } else {
                    $_SESSION['flash']['success'] = 'L\'article a bien été supprimé !';
                    header('Location: index.php?action=manage_posts');
                }
            } elseif ($postId <= 0) {
                $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
                managePosts();
            }
        } else {
            $_SESSION['flash']['danger'] = 'Erreur de vérification !';
            managePosts();
        }
    }
}
/**
 * Show the comment management's part
 * 
 * @return mixed
 */
function manageComments()
{
    $commentManager = new CommentManager();
    $nbCount = $commentManager->countCommentBackRequest();
    $submittedComment = $commentManager->submittedCommentRequest();
    include 'App/backend/Modules/Comments/manageComments.php';
}
/**
 * Validate a comment
 * 
 * @param int    $commentId                the comment's id
 * @param string $csrfValidateCommentToken the token to try to avoid csrf
 * 
 * @return mixed
 */
function validateComment($commentId, $csrfValidateCommentToken)
{
    $commentManager = new CommentManager();
    $validated = $commentManager->validateCommentRequest($commentId);
    $_SESSION['csrfValidateCommentToken'] = $csrfValidateCommentToken;
    if (isset($_SESSION['csrfValidateCommentToken'])  
        AND isset($csrfValidateCommentToken)
        AND !empty($_SESSION['csrfValidateCommentToken']) AND !empty($csrfValidateCommentToken)
    ) {
        if ($_SESSION['csrfValidateCommentToken'] == $csrfValidateCommentToken) {
            if (isset($commentId) && $commentId > 0) {
                if ($validated === false) {
                    $_SESSION['flash']['danger'] = 'Impossible de valider le commentaire';
                    header('Location: index.php?action=manage_comments');
                    exit();
                } else {
                    $_SESSION['flash']['success'] = 'Le commentaire a bien été validé !';
                    header('Location: index.php?action=manage_comments');
                    exit();
                }
            } elseif ($commentId <= 0) {
                $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce commentaire !';
                manageComments();
            }
        } else {
            $_SESSION['flash']['danger'] = 'Erreur de vérification !';
            manageComments();
        }
    }
}
/**
 * Delete a comment
 * 
 * @param int    $commentId                   the comment's id
 * @param string $csrfAdminDeleteCommentToken the token to try to avoid csrf
 * 
 * @return mixed
 */
function adminDeleteComment($commentId, $csrfAdminDeleteCommentToken)
{
    $commentManager = new CommentManager();
    $commentManager->getComment($commentId);
    $_SESSION['csrfAdminDeleteCommentToken'] = $csrfAdminDeleteCommentToken;
    if (isset($_SESSION['csrfAdminDeleteCommentToken']) AND isset($csrfAdminDeleteCommentToken)
        AND !empty($_SESSION['csrfAdminDeleteCommentToken']) AND !empty($csrfAdminDeleteCommentToken)
    ) {
        if ($_SESSION['csrfAdminDeleteCommentToken'] == $csrfAdminDeleteCommentToken) {
            if (isset($commentId) && $commentId > 0) {
                $success = $commentManager->deleteCommentRequest($commentId);
                if ($success === false) {
                    $_SESSION['flash']['danger'] = 'Impossible de supprimer le commentaire !';
                    header('Location: index.php?action=manage_comments');
                    exit();
                } else {   
                    $_SESSION['flash']['success'] = 'Le commentaire a bien été supprimé !';
                    header('Location: index.php?action=manage_comments');
                    exit();
                }
            } elseif ($commentId <= 0) {
                $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce commentaire !';
                manageComments();
            }
        } else {
            $_SESSION['flash']['danger'] = 'Erreur de vérification !';
            manageComments();
        }
    }
}
/**
 * Show the user management's part
 * 
 * @return mixed
 */
function manageUsers()
{
    $userManager = new UserManager();
    $users = $userManager->getUsers();
    include 'App/backend/Modules/Users/user_mgmt.php';
}
/**
 * Give admin Rights to a user
 * 
 * @param int    $userId                   the user's id
 * @param string $csrfGiveAdminRightsToken the token to try to avoid csrf
 * 
 * @return mixed
 */
function giveAdminRights($userId, $csrfGiveAdminRightsToken)
{
    $userManager = new UserManager();
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
            $_SESSION['flash']['danger'] = 'Erreur de vérification !';
            manageUsers();
        }
    }
}
/**
 * Cancel admin Rights to a user
 * 
 * @param int    $userId                     the user's id
 * @param string $csrfCancelAdminRightsToken the token to try to avoid csrf
 * 
 * @return mixed
 */
function stopAdminRights($userId, $csrfCancelAdminRightsToken)
{
    $userManager = new UserManager();
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
            $_SESSION['flash']['danger'] = 'Erreur de vérification !';
            manageUsers();
        }
    }
}
/**
 * Delete a user
 * 
 * @param int    $userId              the user's id
 * @param string $csrfDeleteUserToken the token to try to avoid csrf.
 * 
 * @return mixed
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
            $_SESSION['flash']['danger'] = 'Erreur de vérification !';
            manageUsers();
        }
    }
}
/**
 * Add a category
 * 
 * @param string $category             the post's category
 * @param string $csrfAddCategoryToken the token to try to avoid csrf
 *
 * @return mixed
 */
function addCategory($category, $csrfAddCategoryToken)
{
    $categoryManager = new CategoryManager();
    $_SESSION['csrfAddCategoryToken'] = $csrfAddCategoryToken; 
    if (isset($_SESSION['csrfAddCategoryToken']) AND isset($csrfAddCategoryToken)
        AND !empty($_SESSION['csrfAddCategoryToken']) AND !empty($csrfAddCategoryToken)
    ) {
        
        if ($_SESSION['csrfAddCategoryToken'] == $csrfAddCategoryToken) {
            if (!empty($category)) {
                $categoryManager->addCategoryRequest($category);
                if ($categoryManager === false) {
                    $_SESSION['flash']['danger'] = 'Impossible d\'ajouter cette catégorie !';
                    managePosts();
                } else {
                    $_SESSION['flash']['success'] = 'La catégorie a bien été ajoutée !';
                    managePosts();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Le champ est vide !';
                managePosts();
            }
        } else {
            $_SESSION['flash']['danger'] = 'Erreur de vérification !';
            header('Location: index.php?action=manage_posts');
            exit();
        }
    }    
}