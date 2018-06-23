<?php 
/**
 * My own blog.
 *
 * Administrator Controller
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

use \Philippe\Blog\Src\Controller\ErrorsController;
/**
 *  Class AdminController
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class AdminController
{
    private $_errorsController;

    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_errorsController = new ErrorsController();
    }
    /**
     * Enter the admin part (security with a token and also authorization in database).
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
}