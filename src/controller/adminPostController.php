<?php 
/**
 * My own blog.
 *
 * Administrator Post Controller
 *
 * PHP Version 7
 * 
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  GIT: $Id$ In development.
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Src\Controller;

use \Philippe\Blog\Src\Model\PostManager;
use \Philippe\Blog\Src\Model\CategoryManager;
/**
 *  Class AdminPostController
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class AdminPostController
{
    private $_postManager;
    private $_categoryManager;
    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_postManager = new PostManager();
        $this->_categoryManager = new CategoryManager();
    }
	/**
     * Show the Post management's part
     * 
     * @return mixed
     */
    public function managePosts()
    {
        if (!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ) {
            $this->_errorsController->noAdmin();
        } else {
            $csrfAddPostToken = md5(time()*rand(1, 1000)); 
            $csrfAddCategoryToken = md5(time()*rand(1, 1000));
            $csrfDeletePostToken = md5(time()*rand(1, 1000));
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
                        AdminPostController::managePosts();
                    } else {
                        $_SESSION['flash']['success'] = 'L\'article a bien été ajouté !';
                        AdminPostController::managePosts();
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Un ou plusieurs champs ne sont pas remplis !';
                    AdminPostController::managePosts();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminPostController::managePosts();
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
        if (!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ) {
            $this->_errorsController->noAdmin();
        } else {
            $post = $this->_postManager->getPost($postId);
            $isPost = $this->_postManager->checkExistPost($postId);

            if (empty($isPost) || $postId <= 0 ) {
                $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
                AdminPostController::managePosts();
            } else {
                $csrfModifyPostToken = md5(time()*rand(1, 1000));
                include 'views/backend/modules/posts/modifyPostPage.php';
            }
        }
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
                            AdminPostController::modifyPostPage($postId);
                        } else {
                            $_SESSION['flash']['success'] = 'L\'article a bien été modifié !';
                            AdminPostController::managePosts();
                        }
                    } else {
                        $_SESSION['flash']['danger'] = 'Veuillez remplir les champs !';
                        AdminPostController::modifyPostPage($postId);
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Pas d\'identifiant d\'article envoyé !';
                    AdminPostController::modifyPostPage($postId);
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminPostController::modifyPostPage($postId);
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
                        AdminPostController::managePosts();
                    } else {
                        $_SESSION['flash']['success'] = 'L\'article a bien été supprimé !';
                        AdminPostController::managePosts();
                    }
                } elseif ($postId <= 0) {
                    $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
                    AdminPostController::managePosts();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                AdminPostController::managePosts();
            }
        }
    }
}