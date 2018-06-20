<?php
/**
 * My own blog.
 *
 * Default Controller
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Src\Controller;
/**
 * Show the homepage
 * 
 * @return mixed
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
        include 'views/frontend/Modules/Home/index.php';
    }
}

