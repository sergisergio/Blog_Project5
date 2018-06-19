<?php
/**
 * My own blog.
 *
 * Errors Controller
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Src\Controller;

class ErrorsController
{
    /**
     * Function errors
     * 
     * @return mixed
     */
    public function errors()
    {
        include 'views/frontend/Modules/Blog/Errors/errors.php';
    }
    /**
     * Function noAdmin
     * 
     * @return mixed
     */
    public function noAdmin()
    {
        include 'views/frontend/Modules/Blog/Errors/noadmin.php';
    }
}