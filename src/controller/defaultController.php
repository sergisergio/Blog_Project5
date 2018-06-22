<?php
/**
 * My own blog.
 *
 * Default Controller
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
 *  Class DefaultController
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class DefaultController
{
    /**
     * Get Homepage
     * 
     * @return mixed
     */
    public function home()
    {
    	$accessAdminToken = md5(time()*rand(1, 1000));
        include 'views/frontend/modules/home/index.php';
    }
}

