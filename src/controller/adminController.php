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
namespace Philippe\Blog\Src\Controller;

use \Philippe\Blog\Src\Model\UserManager;
use \Philippe\Blog\Src\Model\PostManager;
use \Philippe\Blog\Src\Model\CategoryManager;
use \Philippe\Blog\Src\Model\CommentManager;
use \Philippe\Blog\Src\Core\Session;
use \Philippe\Blog\Src\Controller\ErrorsController;
use \Exception;

class AdminController
{
    private $_errorsController;
    private $_postManager;
    private $_categoryManager;
    private $_commentManager;
    private $_userManager;

    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_errorsController = new ErrorsController();
        $this->_postManager = new PostManager();
        $this->_categoryManager = new CategoryManager();
        $this->_commentManager = new CommentManager();
        $this->_userManager = new UserManager();
    }
    /**
     * Enter the admin part
     *
     * @param int $accessAdminToken token to access admin's part
     * 
     * @return int
     */
    public function admin($accessAdminToken)
    {
        $_SESSION['accessAdminToken'] = $accessAdminToken;
        if (isset($_SESSION['accessAdminToken']) AND isset($accessAdminToken) AND !empty($_SESSION['accessAdminToken']) AND !empty($accessAdminToken)) {
            if ($_SESSION['accessAdminToken'] == $accessAdminToken) {
                if (!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ) {
                    $this->_errorsController->noAdmin();
                } else {
                    include 'views/backend/admin.php';
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
    public function managePosts()
    {
        $postsTotal = $this->_postManager->countPosts();
        $postsPerPage = 5;
        $totalPages = ceil($postsTotal / $postsPerPage);
        $categories = $this->_categoryManager->getCategoryRequest();

        if (isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page'] > 0 ) AND ($_GET['page'] <= $totalPages)) {
            $_GET['page'] = intval($_GET['page']);
            $currentPage = $_GET['page'];
        } else {
            $currentPage = 1;
        }
        $start = ($currentPage-1)*$postsPerPage;
        $posts = $this->_postManager->getPosts($start, $postsPerPage);
        include 'views/backend/modules/posts/managePosts.php';
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
    public function addPost($title, $chapo, $author, $content, $image, $category, $csrfAddPostToken) 
    {
        $_SESSION['csrfAddPostToken'] = $csrfAddPostToken; 
        $file_extension = $_FILES['file_extension'];
        $file_extension_error = $_FILES['file_extension']['error'];
        $file_extension_size = $_FILES['file_extension']['size'];
        $file_extension_tmp = $_FILES['file_extension']['tmp_name'];

        if (isset($_SESSION['csrfAddPostToken']) AND isset($csrfAddPostToken) AND !empty($_SESSION['csrfAddPostToken']) AND !empty($csrfAddPostToken)) {
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
                    $addedPost = $this->_postManager->addPostRequest($title, $chapo, $author, $content, $category, $image);
                    if ($addedPost === false) {
                        $_SESSION['flash']['danger'] = 'impossible d\'ajouter l\'article !';
                        AdminController::managePosts();
                    } else {
                        $_SESSION['flash']['success'] = 'L\'article a bien été ajouté !';
                        AdminController::managePosts();
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Un ou plusieurs champs ne sont pas remplis !';
                    AdminController::managePosts();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminController::managePosts();
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
    public function modifyPostPage($postId)
    {
        $post = $this->_postManager->getPost($postId);
        $isPost = $this->_postManager->checkExistPost($postId);

        if (empty($isPost) || $postId <= 0 ) {
            $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
            AdminController::managePosts();
        }
        include 'views/backend/modules/posts/modifyPostPage.php';
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
    public function modifyPost($postId, $title, $chapo, $author, $content, $csrfModifyPostToken)
    {
        $_SESSION['csrfModifyPostToken'] = $csrfModifyPostToken; 
        if (isset($_SESSION['csrfModifyPostToken']) AND isset($csrfModifyPostToken)
            AND !empty($_SESSION['csrfModifyPostToken']) AND !empty($csrfModifyPostToken)
        ) {
            if ($_SESSION['csrfModifyPostToken'] == $csrfModifyPostToken) {
                if (isset($postId) && $postId > 0) {
                    if (!empty($title) && !empty($content) && !empty($chapo)) {
                        $this->_postManager->getPost($postId);
                        $modify = $this->_postManager->modifyPostRequest($postId, $title, $chapo, $author, $content);
                        if ($modify === false) {
                            $_SESSION['flash']['danger'] = 'Impossible de modifier l\'article';
                            AdminController::modifyPostPage($postId);
                        } else {
                            $_SESSION['flash']['success'] = 'L\'article a bien été modifié !';
                            AdminController::managePosts();
                        }
                    } else {
                        $_SESSION['flash']['danger'] = 'Veuillez remplir les champs !';
                        AdminController::modifyPostPage($postId);
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Pas d\'identifiant d\'article envoyé !';
                    AdminController::modifyPostPage($postId);
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminController::modifyPostPage($postId);
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
    public function deletePost($postId, $csrfDeletePostToken)
    {
        $_SESSION['csrfDeletePostToken'] = $csrfDeletePostToken;
        if (isset($_SESSION['csrfDeletePostToken']) AND isset($csrfDeletePostToken)
            AND !empty($_SESSION['csrfDeletePostToken']) AND !empty($csrfDeletePostToken)
        ) {
            if ($_SESSION['csrfDeletePostToken'] == $csrfDeletePostToken) {
                if (isset($postId) && $postId > 0) {
                    $this->_postManager->getPost($postId);
                    $delete = $this->_postManager->deletePostRequest($postId);
                    if ($delete === false) {
                        $_SESSION['flash']['danger'] = 'Impossible de supprimer l\'article';
                        AdminController::managePosts();
                    } else {
                        $_SESSION['flash']['success'] = 'L\'article a bien été supprimé !';
                        AdminController::managePosts();
                    }
                } elseif ($postId <= 0) {
                    $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
                    AdminController::managePosts();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminController::managePosts();
            }
        }
    }
    /**
     * Show the comment management's part
     * 
     * @return mixed
     */
    public function manageComments()
    {
        $nbCount = $this->_commentManager->countCommentBackRequest();
        $submittedComment = $this->_commentManager->submittedCommentRequest();
        include 'views/backend/modules/comments/manageComments.php';
    }
    /**
     * Validate a comment
     * 
     * @param int    $commentId                the comment's id
     * @param string $csrfValidateCommentToken the token to try to avoid csrf
     * 
     * @return mixed
     */
    public function validateComment($commentId, $csrfValidateCommentToken)
    {
        $validated = $this->_commentManager->validateCommentRequest($commentId);
        $_SESSION['csrfValidateCommentToken'] = $csrfValidateCommentToken;
        if (isset($_SESSION['csrfValidateCommentToken']) AND isset($csrfValidateCommentToken) AND !empty($_SESSION['csrfValidateCommentToken']) AND !empty($csrfValidateCommentToken)) {
            if ($_SESSION['csrfValidateCommentToken'] == $csrfValidateCommentToken) {
                if (isset($commentId) && $commentId > 0) {
                    if ($validated === false) {
                        $_SESSION['flash']['danger'] = 'Impossible de valider le commentaire';
                        AdminController::manageComments();
                    } else {
                        $_SESSION['flash']['success'] = 'Le commentaire a bien été validé !';
                        AdminController::manageComments();
                    }
                } elseif ($commentId <= 0) {
                    $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce commentaire !';
                    AdminController::manageComments();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminController::manageComments();
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
    public function adminDeleteComment($commentId, $csrfAdminDeleteCommentToken)
    {
        $this->_commentManager->getComment($commentId);
        $_SESSION['csrfAdminDeleteCommentToken'] = $csrfAdminDeleteCommentToken;
        if (isset($_SESSION['csrfAdminDeleteCommentToken']) AND isset($csrfAdminDeleteCommentToken) AND !empty($_SESSION['csrfAdminDeleteCommentToken']) AND !empty($csrfAdminDeleteCommentToken)) {
            if ($_SESSION['csrfAdminDeleteCommentToken'] == $csrfAdminDeleteCommentToken) {
                if (isset($commentId) && $commentId > 0) {
                    $success = $this->_commentManager->deleteCommentRequest($commentId);
                    if ($success === false) {
                        $_SESSION['flash']['danger'] = 'Impossible de supprimer le commentaire !';
                        AdminController::manageComments();
                    } else {   
                        $_SESSION['flash']['success'] = 'Le commentaire a bien été supprimé !';
                        AdminController::manageComments();
                    }
                } elseif ($commentId <= 0) {
                    $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce commentaire !';
                    AdminController::manageComments();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminController::manageComments();
            }
        }
    }
    /**
     * Show the user management's part
     * 
     * @return mixed
     */
    public function manageUsers()
    {
        $users = $this->_userManager->getUsers();
        include 'views/backend/modules/users/user_mgmt.php';
    }
    /**
     * Give admin Rights to a user
     * 
     * @param int    $userId                   the user's id
     * @param string $csrfGiveAdminRightsToken the token to try to avoid csrf
     * 
     * @return mixed
     */
    public function giveAdminRights($userId, $csrfGiveAdminRightsToken)
    {
        $_SESSION['csrfGiveAdminRightsToken'] = $csrfGiveAdminRightsToken;
        if (isset($_SESSION['csrfGiveAdminRightsToken']) AND isset($csrfGiveAdminRightsToken) AND !empty($_SESSION['csrfGiveAdminRightsToken']) AND !empty($csrfGiveAdminRightsToken)
        ) {
            if ($_SESSION['csrfGiveAdminRightsToken'] == $csrfGiveAdminRightsToken) {
                if (isset($userId) && $userId > 0) {
                    $adminRights = $this->_userManager->giveAdminRightsRequest($userId);

                    if ($adminRights === false) {
                        throw new Exception('Impossible de donner les droits admin');
                    } else {
                        AdminController::manageUsers();
                    }
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminController::manageUsers();
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
    public function stopAdminRights($userId, $csrfCancelAdminRightsToken)
    {
        $_SESSION['csrfCancelAdminRightsToken'] = $csrfCancelAdminRightsToken;
        if (isset($_SESSION['csrfCancelAdminRightsToken']) AND isset($csrfCancelAdminRightsToken) AND !empty($_SESSION['csrfCancelAdminRightsToken']) AND !empty($csrfCancelAdminRightsToken)
        ) {
            if ($_SESSION['csrfCancelAdminRightsToken'] == $csrfCancelAdminRightsToken) {
                if (isset($userId) && $userId > 0) {
                    $adminRights = $this->_userManager->stopAdminRightsRequest($userId);

                    if ($adminRights === false) {
                        throw new Exception('Impossible de retirer les droits admin');
                    } else {
                        AdminController::manageUsers();
                    }
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminController::manageUsers();
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
    public function deleteUser($userId, $csrfDeleteUserToken)
    {
        $_SESSION['csrfDeleteUserToken'] = $csrfDeleteUserToken;
        if (isset($_SESSION['csrfDeleteUserToken']) AND isset($csrfDeleteUserToken) AND !empty($_SESSION['csrfDeleteUserToken']) AND !empty($csrfDeleteUserToken)
        ) {
            if ($_SESSION['csrfDeleteUserToken'] == $csrfDeleteUserToken) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $affectedUser = $this->_userManager->deleteUserRequest($userId);

                    if ($affectedUser === false) {
                        throw new Exception('Impossible de supprimer ce membre');
                    } else {
                        AdminController::manageUsers();
                    }
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminController::manageUsers();
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
    public function addCategory($category, $csrfAddCategoryToken)
    {
        $_SESSION['csrfAddCategoryToken'] = $csrfAddCategoryToken; 
        if (isset($_SESSION['csrfAddCategoryToken']) AND isset($csrfAddCategoryToken) AND !empty($_SESSION['csrfAddCategoryToken']) AND !empty($csrfAddCategoryToken)
        ) {
            
            if ($_SESSION['csrfAddCategoryToken'] == $csrfAddCategoryToken) {
                if (!empty($category)) {
                    $this->_categoryManager->addCategoryRequest($category);
                    if ($this->_categoryManager === false) {
                        $_SESSION['flash']['danger'] = 'Impossible d\'ajouter cette catégorie !';
                        AdminController::managePosts();
                    } else {
                        $_SESSION['flash']['success'] = 'La catégorie a bien été ajoutée !';
                        AdminController::managePosts();
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Le champ est vide !';
                    AdminController::managePosts();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminController::managePosts();
            }
        }    
    }
}