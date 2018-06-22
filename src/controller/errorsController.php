<?php
/**
 * My own blog.
 *
 * Errors Controller
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
/**
 *  Class ErrorsController
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class ErrorsController
{
    /**
     * Function errors
     * 
     * @return mixed
     */
    public function errors()
    {
        include 'views/frontend/modules/blog/errors/errors.php';
    }
    /**
     * Function noAdmin
     * 
     * @return mixed
     */
    public function noAdmin()
    {
        include 'views/frontend/modules/blog/errors/noadmin.php';
    }
}